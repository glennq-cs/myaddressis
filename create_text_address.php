<?php
include 'functions/functions.php';
session_start();

$results = $_SESSION['result'][$_GET['id']];

//create file name with time stamp
// $filename = "testfile_".$_GET['id']."_".date("Ymdhmi")."_".$_SERVER['REMOTE_ADDR'].".txt";

//file location
// $text_name = $_SERVER['DOCUMENT_ROOT']."/files/saved/".$filename;

//create file
// $textFile = fopen($text_name, "wb") or die('Cannot open file: '.$text_name);

//write text to file
$txtPost = "You entered: ".$results['post_address']."\n";
// fwrite($textFile, $txtPost);
$txtText = "Correct address: ".$results['text_address']."\n";
// fwrite($textFile, $txtText);
// $txt = "Audio: ".$results['wav']."\n";
// fwrite($textFile, $txt);
$txtDate = "Date: ".date('M d, Y')."\n";
$txtWav  = "File ID: ". $results['wav'];
// fwrite($textFile, $txtDate);
//close file
// fclose($textFile);

$site_url = "http://{$_SERVER['HTTP_HOST']}".$site_url."/files/saved/".$filename;

echo $txtPost;
echo $txtText;
echo $txtDate;
echo $txtWav;
echo "IP: ".$_SERVER['REMOTE_ADDR'];

header("Content-Disposition: attachment; filename=Text_Address_Result_{$_GET['id']}.txt");

exit;
// header("Location: http://".$site_url."/files/saved/".$filename);
// echo "<script>window.close();</script>";
