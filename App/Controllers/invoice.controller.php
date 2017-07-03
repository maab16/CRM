<?php

namespace App\Controllers;

use Blab\Mvc\Controllers\Blab_Controller;
use Blab\Invoice\Libs\Capture\Capture;
use Blab\Mvc\Bootstrap;

class InvoiceController extends Blab_Controller
{
	function __construct($data=array()){
		
		Parent::__construct($data);
		$this->model = new \App\Models\Invoice();
	}

	public function index(){

		if(!(new \Blab\Libs\Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new \Blab\Libs\Blab_User())->data();
		}

		$params = Bootstrap::getRouter()->getParams();

		if (!empty($params[0])) {
			
			$data = $this->model->getProductByID($params[0],$user->id);

			// var_dump($data);
			// die();
		}

		$capture = new Capture([
				'envPath'=>'H:\xampp\htdocs\PhantomJS\bin', // Set Global Path for phantomjs.exe
				'viewPath'=>ROOT.DS.'App'.DS.'views'.DS.'Invoice'.DS.'views',
				'tempDir'=>ROOT.DS.'App'.DS.'views'.DS.'Invoice',
				'captureJS'=>ROOT.DS.'App'.DS.'views'.DS.'Invoice'.DS.'capture.js',// Capture javascript file path
				'capturePath'=>'http://localhost/Invoice/invoice/',//must be use http:// or https://
				'captureFileName'=>'invoice'
			]);

		$date = date('Y-m-d');
		$capture->load("invoice.php",[

				'id'=>$data->invoice_id,
				'date'=>$data->issued_date,
				'supplierName'=>$data->company,
				'supplierRegNo'=>$data->company_vat,
				'suppilerVatNo'=>$data->company_reg,
				'supplierDetails'=>$data->company_address,
				'customerName'=>$data->first_name.''.$data->last_name,
				'customerEmail'=>$data->email,
				'customerRegNo'=>167473,
				'customerVatNo'=>458234,
				'customerDetails'=>$data->user_address,
				'product_title'=>$data->product_title,
				'qty'=>$data->qty,
				'price'=>$data->price

			]);

		$capture->response('invoice');
		
	}

	public function invoice(){
		
	}

	public function update(){
		if(!(new \Blab\Libs\Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new \Blab\Libs\Blab_User())->data();
		}
		$params = Bootstrap::getRouter()->getParams();

		if (!empty($params[0])) {
			
			$this->data['products'] = $this->model->getSingleCart($params[0],$user->id);
		}
	}

	public function delete(){
		if(!(new \Blab\Libs\Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new \Blab\Libs\Blab_User())->data();
		}
		$params = Bootstrap::getRouter()->getParams();

		if (!empty($params[0])) {
			
			$this->model->deleteUserProduct($params[0],$user->id);
		}
	}

	public function delete_cart(){
		if(!(new \Blab\Libs\Blab_User())->isLoggedIn()){
			Redirect::to('/users/login/');
		}else{
			$user = (new \Blab\Libs\Blab_User())->data();
		}
		$params = Bootstrap::getRouter()->getParams();

		if (!empty($params[0])) {
			
			$this->model->deleteCart($params[0],$user->id);
		}
	}
}