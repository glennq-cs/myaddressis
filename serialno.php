<?php
//timer
$minutes = 0;
$seconds = 0;
$post    = $_POST;

// if($_SESSION['queue'] == 0 || $_SESSION['queue'] == 1 || !isset($_SESSION['serialno'])) {
if($_SESSION['queue'] == 0 || !isset($_SESSION['serialno'])) {	

	$filename = $post['dataset'];

	$serialno_wavs = \App\Classes\FileReader\Factory::readfiles($filename);

	shuffle($serialno_wavs);
	shuffle($serialno_wavs);

	$reArrange = array_combine(range(1, count($serialno_wavs)), array_values($serialno_wavs));

	$_SESSION['serialno'] = $reArrange;

	empty($_SESSION['results']);	
}

$serialno = $_SESSION['serialno'];

if(!isset($_SESSION['queue'])) {
	$_SESSION['queue'] = 0;
}

//if session is == 0 or == 1
if($_SESSION['queue']  == 1 || $_SESSION['queue']  == 0) {
	$_SESSION['results'] = [];
}

//minute and second
if(isset($post['queue']) || isset($post['email'])) {
	$minutes = isset($post['minutes'])?$post['minutes']:0;
	$seconds = isset($post['seconds'])?$post['seconds']:0;
}

if(!isset($post['email'])) {
	$_SESSION['queue'] = isset($post['queue'])?$post['queue']+1:1;	
}

if(isset($post['queue']) && $post['queue'] > 0) {

	$serialOrg  = trim(strtolower($serialno[$post['queue']][3]));
	$serialPost = trim(strtolower($post['serialno']));

	//stats
	$correct = 0;
	$wrong   = 0;

	if($serialOrg !== $serialPost) {
		$_SESSION['results'][$post['queue']] = [
			'id' => $serialno[$post['queue']][0],
			'post_serial' => trim($post['serialno']),
			'text_serial' => $serialno[$post['queue']][3],
			'wav' => $serialno[$post['queue']][1],
			'played' => $post['played']

		];

		$wrong = 1;

	} else {
		$correct = 1;
	}

	//statistic
	stats($serialno[$post['queue']][1], $correct, $wrong);	
}

$queue = $_SESSION['queue'];

$dataname = $_SESSION['mode']['dataname'];

if(isset($post['finish']) || ($queue > count($serialno))) {

	if(!isset($_SESSION['refresh'])) {
	
		include "pages/serialno/run_test.php";

	} else {

		$avg = ($minutes*60) + $seconds;

		$results = $_SESSION['results'];

		$total_results = count($results);

		if(!isset($post['email'])) {

			include "pages/serialno/email.php";	

		} else {

			--$queue;

			$mode = $_SESSION['mode']['dataset'];
			
			$score =  ((int)$queue - (int)$total_results) ." out of ". (int)$queue;

			logs($post['email'], $results,  $score, $_SESSION['mode']['name']);

			include "mail/serialno.php";
			include "pages/serialno/score.php";	
			
			unset($_SESSION['serialno']);
			unset($_SESSION['queue']);
			unset($_SESSION['refresh']);
			// session_destroy();
		}
	}

} else {
	$_SESSION['refresh'] = 0;
	include "pages/serialno/form.php";	
}

