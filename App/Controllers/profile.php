<?php

namespace App\Controllers;

use Blab\Mvc\Controllers;

class Profile extends Controllers\Blab_Controller
{
	public function index(){

		echo "Here is Profile";
	}

	public function name(){

		echo "Hello Gaust";
	}

	public function view(){

		echo "Here is View";
	}
}