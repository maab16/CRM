<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define("VIEWS_PATH", ROOT.DS."App".DS."views");

	require_once ROOT.DS.'App'.DS.'Autoloader'.DS.'autoload.php';
	if (isset($_POST['productID']) && isset($_POST['ip']) && isset($_POST['quantity'])) {

		$json_data['exists']=false;

		$product_id= (isset($_POST['productID']))? $_POST['productID']:"";
		$ip_address= (isset($_POST['ip']))? $_POST['ip']:"";
		$qty= (isset($_POST['quantity']))? $_POST['quantity']:"";
				
		$db = \Blab\Mvc\Models\Blab_Model::getDBInstance();

			$update = $db->query()
						->into("cart")
						->where(array(
							'product_id'=>$product_id,
							'ip_address'=>$ip_address
						))
						->update(array('qty'=>$qty));
			if($update){
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