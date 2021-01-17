<?php

$webmaster_email = "xolanielphas@nizzcorp.co.za";


$contact = "index.html";
$thankyou_page = "thank_you.html";

$first_name = $_REQUEST['first_name'] ;
$email_address = $_REQUEST['email_address'] ;
$user_numbers = $_REQUEST['user_numbers'] ;
$comments = $_REQUEST['comments'] ;

$msg = 
"First Name: " . $first_name . "\r\n" . 
"Email: " . $email_address . "\r\n" . 
"user_numbers: " . $user_numbers . "\r\n" . 
"Comments: " . $comments ;

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

// If the user tries to access this script directly, redirect them to the contact form,
if (!isset($_REQUEST['email_address'])) {
header( "Location: $contact" );
}

// If the form fields are empty, redirect to the error page.
elseif (empty($first_name) || empty($email_address)) {
header( "Location: $contact" );
}

/* 
If email injection is detected, redirect to the error page.
If you add a form field, you should add it here.
*/
elseif ( isInjected($email_address) || isInjected($first_name)  || isInjected($comments) ) {
header( "Location: $contact" );
}

// If we passed all previous tests, send the email then redirect to the thank you page.
else {

	mail( "xolanielphas@nizzcorp.co.za", "purchase_page.html", $msg );

	header( "Location: $purchase_page" );
}
?>