<?php

namespace App\Controllers;

use Blab\Mvc\Controllers as Controllers;

class HomeController extends Controllers\Blab_Controller
{
	public function __construct($data = array()){

		parent::__construct($data);
		$this->model = new \App\Models\Home_Model();
	}

	public function index(){

		//echo "OK! Home Index";
	}

	public function contact(){

		//echo "Hello Gaust";
	}

	public function view(){

		//echo "Here is View";
	}
}