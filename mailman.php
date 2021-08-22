<?php

/*****************************************
Send an email to a specified recipient
******************************************/

error_reporting(0);

// Includes
include 'config.php';
include 'functions.php';

// Reciepent of the email
$Recipient = $config->Email;

// Clean user input
$Name = cleanUserInput($_GET['name']);
$Email = strtolower(cleanUserInput($_GET['email']));
$Message = wordwrap(cleanUserInput($_GET['message']), 70, "\r\n");

// Email header info
$SiteUrl = ltrim($_SERVER['HTTP_HOST'], "www.");
$Date = date("l jS \of F Y h:i:s A");

// Email Header
$mailHeader = "From: {$SiteUrl} <website@{$SiteUrl}>" . "\r\n" .
	"Reply-To: {$Name} <{$Email}>" . "\r\n" .
	"Content-Type: text/plain; charset=utf-8" . "\r\n" .
	"MIME-Version: 1.0" . "\r\n" .
	"X-Mailer: PHP/" . phpversion();

// The Subject
$mailSubject = "[{$SiteUrl}] Message from {$Name}";

// The Message 
$mailMessage = $Message . "\r\n\n\t" . $Date;

// Send the email
if ($Name && $Email && $Message) {
	// Email Sent
	mail($Recipient, $mailSubject, $mailMessage, $mailHeader);
	echo true;
} else {
	// Error
	echo false;
}


// Function: Sanitize the user input
function cleanUserInput($input) {
    return htmlspecialchars(strip_tags($input));
}

?>