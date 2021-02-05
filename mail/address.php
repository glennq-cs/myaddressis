<?php
$to  = strip_tags($post['email']);
$bcc = "thekelly@sonarlogic.biz";
$subject = "[MAI] Score {$score} - {$dataname}";
$ip = $_SERVER['REMOTE_ADDR'];

//header
$headers = "From: no-reply@cloudstaff.com"."\r\n";
$headers .= "Bcc: {$bcc}"."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//message
$message = "<html><body>";
$message .= "<h3>MyAddressIs (MAI) - <small style='color: #666'>{$subtitle}</small></h3>";
$message .= "<table border='0'>
			<tr><td>Date</td><td>: ".date('M d, Y')."</td><tr>
			<tr><td>Time</td><td>: {$minutes} min {$seconds} sec (avg {$avg} sec)</td><tr>
			<tr><td>IP</td><td>: {$ip}</td></tr>
			</table>";
$message .= "<p>";
$message .= "<h4>You Scored ".$score."</h4>";

if(!empty($results)) {
	$message .= "<strong>Incorrect Address were</strong><br /><br />";
	foreach($results as $key => $result) {
		$message .= "<strong>You entered:</strong> ".$result['post_address']."<br />";

		$corrects = explode("|", $result['text_address']);
		foreach($corrects as $val) {
			$message .= "<strong>Correct Address:</strong> ".$val."<br />";
		}
		$message .= "<strong>File ID:</strong> ".$result['wav'];
		$message .= "<br /><br />";
	}
} else {
	$message .= "<h4>Congratulation! You have no errors.</h4>";
}

$message .= "</body></html>";

mail($to, $subject, $message, $headers);
