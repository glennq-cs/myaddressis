<?php
include 'functions/functions.php';
require_once "classes/class.file.reader.php";
require_once "config/config.php";

$site_url = $config['site_url'];

session_start();

include "pages/header.php";

if(!empty($_POST)) {

	$post = $_POST;
	
	if(isset($post['mode'])) {
		$_SESSION['mode'] = [
			'name' => $post['mode'],
			'dataset' => $post['dataset'],
			'dataname' => ($post['mode']=='address')?
								$config['data_sets'][$post['dataset']]:
								$config['serial_no'][$post['dataset']]
		];
	} 
	
	include "pages/subtitle.php";

	switch($_SESSION['mode']['name']) {
		case "address":
			include "address.php";
			break;
		case "serialno":
			include "serialno.php";
			break;
		case "practice":
			include "practice.php";
			break;
		default:
			header("Location: ".$site_url);
			include "practice.php";
			break;
	}

} else {

	session_unset();
	session_destroy();
	session_write_close();
	
	include "pages/home.php";
}

// session_destroy();

include "pages/footer.php";


