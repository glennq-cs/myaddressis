<?php
namespace App\Classes\FileReader;

class Factory {

	static protected $txt_dir  = 'files/text/';
	static protected $wav_dir  = 'files/wav/';
	static protected $filename = '';
	static protected $filetype = ['txt','csv'];
	static protected $delimited = "\t";

	public function __construct() 
	{

	}

	/*
		Read Files
	*/
	static public function readfiles($filename)
	{
		// get text file dir
		$txt_dir = self::getRoot().self::$txt_dir;

		// get wav files dir
		$wav_dir = self::getRoot().self::$wav_dir;

		//check file if exist;
		if(self::checkfile($txt_dir.$filename)) {

			$file_type = self::getFileType($txt_dir.$filename);

			$addresses = [];

			if(in_array($file_type, self::$filetype)) {
				$addresses = self::manipulate($txt_dir.$filename);
			} 
			
			return $addresses;

		}

		die("Error: File is not exist, <br />
				1. Please make sure the text file \"{$filename}\" is stored in directory /files/text/.<br />
				2. Insert wav file on /files/wav/ folder."
		);
	}

	/*
		Read tab Delimited
	*/
	static private function manipulate($filename = '')
	{
		$handle      = fopen($filename, "r");
		$manipulated = [];

		if($handle) {
			while (!feof($handle)) {
				$line = fgets($handle, 2048);
				$data = str_getcsv($line, self::$delimited);
				if(is_numeric($data[0])) {
					$manipulated[$data[0]] = $data;	
				}
			}
		}

		fclose($handle);

		return $manipulated;
	}

	/*
		Check file type
	*/
	static private function getFileType($filename = '') 
	{
		if(empty($filename)) {
			return false;
		}

		$fileType = pathinfo($filename, PATHINFO_EXTENSION);
		
		if(!in_array($fileType, self::$filetype) ) {
			die("Invalid file format, <br />
					1. Please insert text file with tab delimited on directory /files/text folder <br />
					2. Insert wav file on files/wav folder.
				");
		}

		return $fileType;

	}

    /*
    	Integrate addresses and wav
    */
	static private function integrate($addresses, $wavs)
	{
		foreach($addresses as $key => &$val) {
			$val['wav'] = $wavs[$key];
		}

		return $addresses;
	}

	/*
		check file if exist
	*/
	static private function checkfile($filename)
	{
		if(!file_exists($filename)) {
			return false;
		} 

		return true;
	}

	/*
		Read Folder
	*/
	static private function readFolder($location = '', $filename = '')
	{
		$files = [];

		if($handle = opendir($location)) {
			//loop directory
			while(false !== ($entry = readdir($handle))) {
				if($entry !== '.' && $entry !== '..') 
					$files[] = "$entry";
			}

			closedir($handle);
		}

		return $files;
	}

	/*
	* Get root directory
	*/
	static private function getRoot() 
	{
		
		return $_SERVER['DOCUMENT_ROOT'].'/';
	}

}