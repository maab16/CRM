<?php
if (session_start()) {
	echo "<script>alert('Session');</script>";
}
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);

	require_once ROOT.DS.'vendor'.DS.'autoload.php';
	if (isset($_POST['ip'])) {

		$json_data['exists']=false;
				
		$db = Blab\Mvc\Models\Blab_Model::getDBInstance();

		$user = (new Blab\Libs\Blab_User())->data();

			$delete = $db->query()
						->from("carts")
						->where(array(
							'user_id'=>$user->id
						))
						->delete();
			if($delete){
				$json_data['exists']=true;
			}	

		echo json_encode($json_data);
	}