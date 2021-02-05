<?php
$config = [
	//data sets
	'data_sets' => [
	        'top100mel_suburbs.csv' => 'Top100 Melbourne Suburbs',
                'top100syd_suburbs.csv' => 'Top100 Sydney Suburbs',
                'top100per_suburbs.csv' => 'Top100 Perth Suburbs',
                'perth_suburbs.csv' => 'All Perth Suburbs (359)',
                'sydney_suburbs.csv' => 'All Sydney Suburbs (704)',
                'melb_suburbs.csv' => 'All Melbourne Suburbs (1024)',
                'drw_suburbs.csv' => 'All Darwin Suburbs',
                'bne_suburbs.csv' => 'All Brisbane Suburbs',
                'hba_suburbs.csv' => 'All Hobart Suburbs',
                'cbr_suburbs.csv' => 'All Canberra Suburbs',
		'qsrh-easy.csv' => 'Red Rooster Street Easy (30)',
		'test.csv' => 'Testing 123'
	],
	
	//serial numbers
	'serial_no' => [
		'serialno.csv' => 'Serial Number',
		'serialno-hard.csv' => 'Serial Number Hard'
	],
	
	//site URL
	'site_url'  => "http://{$_SERVER['HTTP_HOST']}"
];

