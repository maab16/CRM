<?php

namespace App\Controllers;

use Blab\Mvc\Controllers\Blab_Controller;
use Blab\Mvc\Bootstrap;
use Blab\Libs\Pagination;
use Blab\Libs\Redirect;
use Blab\Libs\Blab_User;
use Blab\Libs\Permission;

class DashboardController extends BLAB_Controller
{
		
	function __construct($data=array()){
		
		Parent::__construct($data);
		$this->model = new \App\Models\Dashboard();
	}

	public function index(){

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

		$page_link  = '/dashboard/index/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total']>0) {

			$pgn = new Pagination('user_products',$this->data['total'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}

	}

	public function carts(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/');
			}
		}

		$params = Bootstrap::getRouter()->getParams();

		$page = !empty($params[0]) ? $params[0] : 1;

		$limit = 5;

		$this->data['carts'] = $this->model->getAllCarts($limit,$page);

		$this->data['total'] = $this->model->count('user_products');

		/*
		 *This Section Are used for Pagination
		 */

		// Page Link

		$page_link  = '/dashboard/carts/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total']>0) {

			$pgn = new Pagination('user_products',$this->data['total'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}
	}

	public function delete_cart(){
		if(!(new \Blab\Libs\Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/');
			}
		}
		$params = Bootstrap::getRouter()->getParams();

		if (!empty($params[0])) {
			
			$this->model->deleteCart($params[0]);
		}
	}
}