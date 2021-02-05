<?php
//timer
$minutes = 0;
$seconds = 0;
$post    = $_POST;

// if($_SESSION['queue'] == 0 || $_SESSION['queue'] == 1 || !isset($_SESSION['address'])) {
if($_SESSION['queue'] == 0 || !isset($_SESSION['address'])) {

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

	if(current($exploded)) {

		//stats
		$correct = 0;
		$wrong   = 0;

		foreach($exploded as $k => $explode) {			

			$postAddress = trim(strtolower($postAddress));
			$postAddress = preg_replace('/st,/','street,', $postAddress);
			$postAddress = preg_replace('/st\./','street', $postAddress);
			$postAddress = preg_replace('/rd,/','road,', $postAddress);
			$postAddress = preg_replace('/ave,/','avenue,', $postAddress);

			$orgAddress = explode(",", $explode);

			$addressOrg = '';

			foreach($orgAddress as $val) {
				$addressOrg = $addressOrg . $val;			
			}
			
			$addressOrg = trim(strtolower($addressOrg));

			if($addressOrg != $postAddress) {
				
				$_SESSION['result'][$post['queue']] = [
					'post_address' 	=> $post['full_address'],
					'text_address' 	=> $addresses[$post['queue']][4],
					'wav'          	=> $addresses[$post['queue']][1],
					'played'		=> $post['played'],
				];

				//statistic
				$wrong = 1;
				
			} else {

				//statistic
				$correct = 1;

				unset($_SESSION['result'][$post['queue']]);

				break;
			}
		}

		//statistic
		stats($addresses[$post['queue']][1], $correct, $wrong);		
	}
}

if(isset($post['queue']) || isset($post['email'])) {
	$minutes = isset($post['minutes'])?$post['minutes']:0;
	$seconds = isset($post['seconds'])?$post['seconds']:0;
}

if(!isset($post['email'])) {
	$_SESSION['queue'] = isset($post['queue'])?$post['queue']+1:1;	
}

$queue    = $_SESSION['queue'];

$dataname = $_SESSION['mode']['dataname'];

if(isset($post['finish']) || ($queue > count($addresses))) {

	if(!isset($_SESSION['refresh'])) {
		
		include "pages/address/run_test.php";		

	} else {

		$results = $_SESSION['result'];

		foreach($results as $key => $result) {
			if(strpos($result['text_address'],$result['post_address']) !== false) {
					unset($results[$key]);
			}
		}

		$total_results = count($results);
		$total_address = count($addresses);

		$avg = ($minutes*60) + $seconds;

		if(!isset($post['email'])) {

			include "pages/address/email.php";

		} else {
				
			--$queue;

			$mode = $_SESSION['mode']['dataset']; 
			
			$score =  ((int)$queue - (int)$total_results) ." out of ". (int)$queue;

			logs($post['email'], $results,  $score, $_SESSION['mode']['name']);
			
			//get selected address name
			$address = $config['data_sets'][$_SESSION['mode']['dataset']];

			include "mail/address.php";
			include "pages/address/score.php";

			unset($_SESSION['queue']);
			unset($_SESSION['address']);
			unset($_SESSION['refresh']);
			// session_destroy();
		}
	}
}  else {
	$_SESSION['refresh'] = 0;	
	include "pages/address/form.php";
}
