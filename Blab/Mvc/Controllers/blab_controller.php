<?php

namespace Blab\Mvc\Controllers;

use Blab\Libs\Core as Core;
use Blab\Mvc\Bootstrap as Bootstrap;

class Blab_Controller extends Core
{

	/**
	* @readwrite
	*/

	protected $_parameters;

	protected $data;
	protected $model;
	protected $params;

	public function getData(){

		return (object)$this->data;

		//return $this->data;
	}

	public function getModel(){

		return $this->model;
	}

	public function getParams(){

		return $this->params;
	}

	public function __construct($data = array()){

		$this->data = $data;
		$this->params = Bootstrap::getRouter()->getParams();
	}

}