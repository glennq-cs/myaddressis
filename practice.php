<?php
//timer
$post    = $_POST;

if($post['queue'] == 0 || !isset($_SESSION['address'])) {

	$filename = $_SESSION['mode']['dataset'];

	$addresses_wavs = \App\Classes\FileReader\Factory::readfiles($filename);
	
	shuffle($addresses_wavs);
	shuffle($addresses_wavs);

	$reArrange = array_combine(range(1, count($addresses_wavs)), array_values($addresses_wavs));

	$_SESSION['address'] = $reArrange;

	empty($_SESSION['result']);	
}

$addresses = $_SESSION['address'];

//if queue is not set
if(!isset($_SESSION['queue'])) {
	$_SESSION['queue'] = 0;
}

//if session is == 0 or == 1
if($_SESSION['queue']  == 1 || $_SESSION['queue']  == 0) {
	$_SESSION['result'] = [];
}

if(isset($post['queue'])) {		

	if(!isset($_SESSION['result'])) {
		$_SESSION['result'] = [];
	}

	$postAddress = sanitizePostData($post);

	//text address
	$exploded = explode("|",$addresses[$post['queue']][4]);

	foreach($exploded as $k => $explode) {

		// debug($val);
		$orgAddress = explode(",", $explode);
		
		$addressOrg = '';
		foreach($orgAddress as $val) {
			$addressOrg = $addressOrg . $val;			
		}
			$addressOrg = trim(strtolower($addressOrg));
			$addressOrg = preg_replace('/street/','st', $addressOrg);
		// end text address
		if($addressOrg != $postAddress) {
				$_SESSION['result'][$post['queue']] = [
				'post_address' => $post['full_address'],
				'text_address' => $addresses[$post['queue']][4],
				'wav'          => $addresses[$post['queue']][1]
			];
		} else {
			unset($_SESSION['result'][$post['queue']]);
			break;
		}
	}
}

if(!isset($post['email'])) {
	$_SESSION['queue'] = isset($post['queue'])?$post['queue']+1:1;	
}

$queue = $_SESSION['queue'];

include "pages/practice/form.php";
