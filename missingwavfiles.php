<?php
include 'functions/functions.php';
require_once "classes/class.file.reader.php";
require_once "config/config.php";

$csvfiles = [];

//addresses
foreach($config['data_sets'] as $key => $value) {
	$csvfiles[] = [
		'name' => $value,
		'csv'  => $key
	];
}

//serialno
foreach($config['serial_no'] as $key => $value) {
	$csvfiles[] = [
		'name' => $value,
		'csv'  => $key
	];	
}

$data = [];
foreach($csvfiles as $value) {

	$results = \App\Classes\FileReader\Factory::readfiles($value['csv']);

	$data[] = [
		'name' => $value['name'],
		'data' => $results
	];
}


//check wav files
$missingwav = [];

foreach($data as $key => $val) {

	$missingwav[$key]['name'] = $val['name'];
	
	foreach($val['data'] as $k => $v) {

		$missing = filechecker($v);

		if($missing) {
			$missingwav[$key]['missing'][] = [
				'id' => $v[0],
				'missing_wav' => $missing
			];
		}
	}
}

//file checker function
function filechecker($arr) {

	$doc_root = $_SERVER['DOCUMENT_ROOT'].'/files/wav/';

	$fileNotFoud = [];

	if(!file_exists($doc_root.$arr[1])) {
		return $arr[1];
	}

	return false;
}

include "pages/header.php";
include "pages/missing_wavs.php";
include "pages/footer.php";