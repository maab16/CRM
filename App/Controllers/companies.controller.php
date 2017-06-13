<?php

namespace App\Controllers;

use Blab\Mvc\Controllers as Controllers;
use Blab\Mvc\Bootstrap as Bootstrap;
use Blab\Libs\Input;
use Blab\Libs\Pagination;
use Blab\Libs\Blab_User;
use Blab\Libs\Permission;
use Blab\Libs\Redirect;

class CompaniesController extends Controllers\Blab_Controller
{
	public function __construct($data = array()){

		parent::__construct($data);
		$this->model = new \App\Models\Company();
	}

	public function index(){

		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/');
			}
		}


		$params = Bootstrap::getRouter()->getParams();

		$page = !empty($params[0]) ? $params[0] : 1;

		$limit = 4;

		$this->data['companies'] = $this->model->getAllCompany($limit,$page);

		$this->data['total'] = $this->model->count();

		/*
		 *This Section Are used for Pagination
		 */

		// Page Link

		$page_link  = '/companies/index/';

		// pagination($opt1=table_name,$opt2=total_items,$opt3=page_link,$opt4=display_items,$opt5=where condition)
		if ($this->data['total']>0) {

			// params tableName,totalItems,pageLink,params,where,displayItems,orderName,$orderType
				
			$pgn = new Pagination('companies',$this->data['total'],$page_link,'','',$limit,'id','desc');

			$this->data['pagination_controll'] = $pgn->getPaginationLists();

			$this->data['pagination'] = $pgn->getPaginationData();
		}
	}

	public function create(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/companies/');
			}
		}

		if (Input::exists()) {
			$this->data['company_errors'] = $this->model->createCompany($_POST);
		}
	}

	public function update(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/companies/');
			}
		}

		$params = Bootstrap::getRouter()->getParams();
		if (!empty($params[0])) {
			$this->data['company'] = $this->model->getSinglCompany($params[0]);
		}
		
		if (Input::exists()) {
			$this->data['company_errors'] = $this->model->updateCompany($_POST);
		}
	}

	public function delete(){
		if((new Blab_User())->isLoggedIn()){
			if(!(new Permission())->hasPermission('admin')){
				Redirect::to('/companies/');
			}
		}

		$params = Bootstrap::getRouter()->getParams();
		if (!empty($params[0])) {
			
			$this->model->deleteCompany($params[0]);
		}
	}
}