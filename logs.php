<?php
include 'functions/functions.php';
require_once "config/config.php";

$site_url = $config['site_url'];

include "pages/header.php";

if(isset($_GET['logs'])) {
	$logs = readlogfile($_GET['logs']);
	include "pages/logs/logslist.php";
} else {
	$logs = readlogsdir();
	include "pages/logs/logs.php";	
}

include "pages/footer.php";
