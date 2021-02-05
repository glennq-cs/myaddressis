<?php
include 'functions/functions.php';
require_once "config/config.php";

$site_url = $config['site_url'];

include "pages/header.php";
$stats = readStats();
ksort($stats);
include "pages/stats/stats.php";
include "pages/footer.php";
