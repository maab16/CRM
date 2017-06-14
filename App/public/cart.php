<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require_once ROOT.DS.'vendor'.DS.'autoload.php';

$json_data = ['exists'=>false];

if (isset($_GET['product_id']) && isset($_GET['user_id']) && isset($_GET['qty'])) {

	$product_id = strtolower(trim($_GET['product_id']));
	$user_id = strtolower(trim($_GET['user_id']));
	$qty = strtolower(trim($_GET['qty']));

	$db = Blab\Mvc\Models\Blab_Model::getDBInstance();

	$results = $db->query()
				->into('carts')
				->insert(array(
					'user_id'=>$user_id,
					'product_id'=>$product_id,
					'qty' => $qty,
					'created_at'=>date("Y-m-d"),
					'updated_at'=>date("Y-m-d")
				));
	if ($results) {
		$json_data = ['exists'=>true,'results'=>$results];
	}else{
		$json_data = ['exists'=>true,'results'=>false];
	}

}

echo json_encode($json_data);