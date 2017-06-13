<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define("VIEWS_PATH", ROOT.DS."App".DS."views");

	require_once ROOT.DS.'App'.DS.'Autoloader'.DS.'autoload.php';
	if (isset($_POST['productID']) && isset($_POST['ip'])) {

		$json_data['exists']=false;

		$product_id= (isset($_POST['productID']))? $_POST['productID']:"";
		$ip_address= (isset($_POST['ip']))? $_POST['ip']:"";
		$country= (isset($_POST['country']))? $_POST['country']:"";
		$country_code= (isset($_POST['country_code']))? $_POST['country_code']:"";
		$city= (isset($_POST['city']))? $_POST['city']:"";
		$isp= (isset($_POST['isp']))? $_POST['isp']:"";
		$org= (isset($_POST['org']))? $_POST['org']:"";
		$as_name= (isset($_POST['as_name']))? $_POST['as_name']:"";
		$zip= (isset($_POST['zip']))? $_POST['zip']:"";
		$timezone= (isset($_POST['timezone']))? $_POST['timezone']:"";
		$region= (isset($_POST['region']))? $_POST['region']:"";
		$region_name= (isset($_POST['region_name']))? $_POST['region_name']:"";
		$lat= (isset($_POST['lat']))? $_POST['lat']:"";
		$lon= (isset($_POST['lon']))? $_POST['lon']:"";
		
		$db = \Blab\Mvc\Models\Blab_Model::getDBInstance();

		if (empty($db->query()
			->from("users_info")
			->where(array('ip_address'=>$ip_address))
			->firstResult()
			)) {
			
			$insertLocation = $db->query()
								->into('users_info')
								->insert(array(
									'ip_address'=>$ip_address,
									'country'=>$country,
									'countryCode'=>$country_code,
									'city'=>$city,
									'zip'=>$zip,
									'timezone'=>$timezone,
									'region'=>$region,
									'regionName'=>$region_name,
									'isp'=>$isp,
									'org'=>$org,
									'as_name'=>$as_name,
									'lat'=>$lat,
									'lon'=>$lon
								));
			if ($insertLocation->getAffectedRows()) {
				
				$json_data['exists']=true;
			}
		}
		
		if (empty($db->query()
			->from("cart")
			->where(array(
				'product_id'=>$product_id,
				'ip_address'=>$ip_address
			))
			->firstResult()
			)) {
			
			$insert = $db->query()
						->into("cart")
						->insert(array(
							'product_id'=>$product_id,
							'ip_address'=>$ip_address
						));
			if($insert->getAffectedRows()){
				$json_data['exists']=true;
			}
		}else{
			$json_data['error']=true;
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