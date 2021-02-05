<?php
/***
	Functions
*/

function showErrors($enable = false)
{
	if($enable ) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);	
	}

	return;
}

function pr($arr = []) {
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function debug($value) {
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
	exit;	
}

function sanitizePostData($post) {
	
	switch($post['state']) {
		case 'QLD': $post['state'] = 'queensland'; break;
		case 'NSW': $post['state'] = 'new south wales'; break;
		case 'SA':  $post['state'] = 'south australia'; break;
		case 'TAS': $post['state'] = 'tasmania'; break;
		case 'VIC': $post['state'] = 'victoria'; break;
		case 'WA':  $post['state'] = 'western australia'; break;
		case 'ACT': $post['state'] = 'australian capital territory'; break;
		case 'NT':  $post['state'] = 'northern territory'; break;
	}

	$post['route'] = preg_replace('/street/','st', strtolower($post['route']));
	$post['city']  = trim(preg_replace('/south/','', strtolower($post['city'])));
	$post['city']  = trim(preg_replace('/east/','', strtolower($post['city'])));
	// $post['city']  = trim(preg_replace('/west/','', strtolower($post['city'])));

	 return trim(strtolower($post['street_number']." ".
			$post['route']." ".
			$post['city']." ".
			$post['state']." ".
			$post['country']
	));

}

/*
* log files
*/
function getLogDir(){
	return $_SERVER['DOCUMENT_ROOT'].'/files/logs/';
}

function logs($email, $results, $score, $mode)
{
	$logs_doc_root = getLogDir();

	$log_file = $logs_doc_root."logs_".date('Y-m-d').".txt";

	$data = [
		'mode' => $mode,
		'email' => $email,
		'score' => $score,
		'results' => serialize($results),
		'ip' => $_SERVER['REMOTE_ADDR']
	];

	$string = serialize($data);

	if(!file_exists($log_file)) {

		//create file
		$handle = fopen($log_file, "wb") or die('Cannot open file: '.$log_file);

		fwrite($handle, $string."\n");

		fclose($handle);

	} else {
		$current = file_get_contents($log_file);

		$current .= $string;

		file_put_contents($log_file, $current."\n");

	}

	return true;
}

function readlogsdir()
{
	$logs_doc_root = getLogDir();

	$logfiles = [];

	if($dh = opendir($logs_doc_root)) {
		while(($file = readdir($dh))) {
			if($file !== "." && $file !== "..") {
				$f = substr($file,5,-4);

				$logfiles[strtotime($f)] = [
					'date' => date('F d, Y', strtotime($f)),
					'filename' => substr($file,0,-4)
				];
			}
		}
		closedir($dh);
	}

	krsort($logfiles);
	
	return $logfiles;
}

function readlogfile($filename)
{
	$filename = getLogDir().$filename.'.txt';
	$content  = file_get_contents($filename);

	if($content) {

		$ex = explode("\n", $content);
		
		foreach($ex as $k => &$v) {

			if(!empty($v) || $v !== "") {
				$v = unserialize($v);
				$v['results'] = unserialize($v['results']);	
			} else {
				unset($ex[$k]);
			}
		}

		return $ex;
	}
	return false;	
}
/** End of Log file **/

/** Statistics file**/
function stats($wavfilename, $correct = 0, $wrong = 0)
{
	$stats_file = $_SERVER['DOCUMENT_ROOT'].'/files/stats/stats.txt';

	$wavfilename = strtolower($wavfilename);

	$content = '';

	if(!file_exists($stats_file)) {

		//create file
		$handle = fopen($stats_file, "wb") or die('Cannot open file: '. $stats_file);

		fwrite($handle, serialize($content));

		fclose($handle);

	}	

	$content = file_get_contents($stats_file);

	$content = unserialize($content);

	if($content == false || !array_key_exists($wavfilename, $content)) {
		$content[$wavfilename] = [
			'correct'  => $correct,
			'wrong'    => $wrong
		];

		file_put_contents($stats_file, serialize($content));

		return;
	}

	$content[$wavfilename]['correct'] += $correct;
	$content[$wavfilename]['wrong']   += $wrong;

	file_put_contents($stats_file, serialize($content));

	return;
}

function readStats()
{
	$stats_file = $_SERVER['DOCUMENT_ROOT'].'/files/stats/stats.txt';
	
	$content = file_get_contents($stats_file);

	return unserialize($content);
}

/** End of statistic file **/