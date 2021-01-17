<?php
$recipient = "xolanielphas@nizzcorp.co.za";
$subject = "purchase";
$location = "https://nizzcorp.co.za";
$sender = $recipient;

$body .= "first_name: ".$_REQUEST['first_name']." \n";
$body .= "email_address: ".$_REQUEST['email_address']." \n";
$body .= "user_numbers: ".$_REQUEST['user_numbers']."\r\n";
$body .= "Comments: ".$_REQUEST['Comments']."\r\n";

function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if(isInjected( $email_address)){
	echo "Bad email value";
	Exit;
}
mail( $recipient, $subject, $body, "From: $sender" ) or die ("Your request could not be sent.");
mail( "xolanielphas@nizzcorp.co.za", "purchase_page.html", $msg );
header( "Location: $purchase_page" );

?>