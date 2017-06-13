<?php

namespace Blab\Mvc\Router;

use Blab\Mvc\Router\Exception as Exception;

class Route extends Route_Base
{

	/**
	*@readwrite
	*/
	protected $_pattern;
	/**
	*@readwrite
	*/
	protected $_controller;
	/**
	*@readwrite
	*/
	protected $_action;
	/**
	*@readwrite
	*/
	protected $_params=array();

	

	protected function _getExceptionForImplementation($method){

		return new Exception\Implementation("{$method} method not Implemented");
		
	}
/*
	public function getPattern(){

		if (isset($this->_pattern)) {
			
			return $this->_pattern;
		}
	}

	public function setPattern($value){

		$this->_pattern = $value;
	}
/*
	public function getController(){

		if (isset($this->_controller)) {
			
			return $this->_controller;
		}

		return "index";
	}

	public function setController($value){

		$this->_controller = $value;
	}

	public function getAction(){

		if (isset($this->_action)) {
			
			return $this->_action;
		}

		return "index";
	}

	public function setAction($value){

		$this->_action = $value;
	}

	public function getParams(){

		if (isset($this->_parameters)) {
			
			$this->_parameters;
		}
	}

	public function setParams($values){

		$this->_parameters = $values;
	}
*/
}