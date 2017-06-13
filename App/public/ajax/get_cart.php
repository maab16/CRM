<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define("VIEWS_PATH", ROOT.DS."App".DS."views");

	require_once ROOT.DS.'App'.DS.'Autoloader'.DS.'autoload.php';
	$data['exists']=false;
	if (isset($_POST['ip'])) {

		$db = \Blab\Mvc\Models\Blab_Model::getDBInstance();

		$results = $db->query()
					->from("cart")
					->where(array('ip_address'=>$_POST['ip']))
					->results();
		if (!empty($results)) {	
			
			$data['exists']=true;
			$data['items'] = count($results);
		}else{

			$data['exists']=false;
			$data['items'] = 0;
		}

		echo json_encode($data);
	}