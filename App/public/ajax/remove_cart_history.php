<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define("VIEWS_PATH", ROOT.DS."App".DS."views");

	require_once ROOT.DS.'App'.DS.'Autoloader'.DS.'autoload.php';
	if (isset($_POST['ip'])) {

		$json_data['exists']=false;

		$ip_address= (isset($_POST['ip']))? $_POST['ip']:"";
				
		$db = \Blab\Mvc\Models\Blab_Model::getDBInstance();

			$delete = $db->query()
						->from("cart")
						->where(array(
							'ip_address'=>$ip_address
						))
						->delete();
			if($delete){
				$json_data['exists']=true;
			}

		$results = $db->query()
					->from("cart")
					->where(array('ip_address'=>$ip_address))
					->results();
		if (!empty($results)) {
					
			$json_data['items'] = count($results);
		}else{

			$json_data['items'] = 0;
		}
		

		echo json_encode($json_data);
	}