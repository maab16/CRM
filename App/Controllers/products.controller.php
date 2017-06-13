<?php

namespace App\Controllers;

use Blab\Mvc\Controllers as Controllers;
use Blab\Mvc\Bootstrap as Bootstrap;
use Blab\Libs\Input;
use Blab\Libs\Pagination;
use Blab\Libs\Blab_User;
use Blab\Libs\Permission;
use Blab\Libs\Redirect;

class ProductsController extends Controllers\Blab_Controller
{
	public function __construct($data = array()){

		parent::__construct($data);
		$this->model = new \App\Models\Product();
	}

	public function index(){

		if(!(new Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new Blab_User())->data();
			$this->data['user'] = $user->id;
		}

		$this->data['user_products'] = $this->model->getCartList($user->id);


		$params = Bootstrap::getRouter()->getParams();

		$page = !empty($params[0]) ? $params[0] : 1;

		$limit = 4;
		/*Get All Product*/
		$this->data['products'] = $this->model->getAllProduct($limit,$page);

		$this->data['total_products'] = $this->model->count('products');

		/*
		 *This Section Are used for Pagination
		 */

		// Page Link

		$page_link  = '/products/index/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total_products']>0) {

			$pgn = new Pagination('products',$this->data['total_products'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}
	}

	public function all(){

		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/');
			}
		}else{
			$user = (new Blab_User())->data();
			$this->data['user'] = $user->id;
		}


		$params = Bootstrap::getRouter()->getParams();

		$page = !empty($params[0]) ? $params[0] : 1;

		$limit = 5;
		/*Get All Product*/
		$this->data['products'] = $this->model->getAllProduct($limit,$page);

		$this->data['total_products'] = $this->model->count();

		/*
		 *This Section Are used for Pagination
		 */

		// Page Link

		$page_link  = '/products/all/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total_products']>0) {

			$pgn = new Pagination('products',$this->data['total_products'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}
	}

	public function create(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/products/');
			}
		}
		/*Get All Company List*/
		$this->data['companies'] = $this->model->getAllCompany();
		/*Get All Available List*/
		$this->data['availabilities'] = $this->model->getAvailabilities();
		if (Input::exists()) {
			$this->data['product_errors'] = $this->model->createProduct($_POST);
		}
	}

	public function update(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/products/');
			}
		}
		/*Get All Company List*/
		$this->data['companies'] = $this->model->getAllCompany();
		/*Get All Available List*/
		$this->data['availabilities'] = $this->model->getAvailabilities();
		/*Get Single Product*/
		$params = Bootstrap::getRouter()->getParams();
		if (!empty($params[0])) {
			$this->data['product'] = $this->model->getSingleProduct($params[0]);
		}
		
		if (Input::exists()) {
			$this->data['product_errors'] = $this->model->updateProduct($_POST);
		}
	}

	public function delete(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/products/');
			}
		}
		$params = Bootstrap::getRouter()->getParams();
		if (!empty($params[0])) {
			
			$this->model->deleteProduct($params[0]);
		}
	}


	public function carts(){

		if(!(new Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new Blab_User())->data();
		}

		/* Get Number of Users*/
		$this->data['total_users'] = $this->model->count('users');
		/* Get Number of Users*/
		$this->data['total_products'] = $this->model->count('products');
		/* Get Number of Users*/
		$this->data['total_companies'] = $this->model->count('companies');
		/* Get Number of Users*/
		$this->data['total_carts'] = $this->model->count('user_products');

		$params = Bootstrap::getRouter()->getParams();

		$page = !empty($params[0]) ? $params[0] : 1;

		$limit = 3;

		$this->data["cart"] = $this->model->getProductByUser($user->id,$limit,$page);

		$this->data['total'] = $this->model->count('user_products',array('user_products.user_id'=>$user->id));

		/*
		 *This Section Are used for Pagination
		 */

		// Page Link

		$page_link  = '/products/carts/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total']>0) {

			$pgn = new Pagination('user_products',$this->data['total'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}

	}

	public function checkout(){

			$this->data['user_info'] = $this->model->currentUserInfo();
			$user = $this->model->currentUserInfo();
			
			$this->data['checkout'] = $this->model->getAllCarts('cart',$user->query);
	}
}