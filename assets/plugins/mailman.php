<?php

/*****************************************
Send an email to a specified recipient
******************************************/

// Includes
include '../../functions.php';

// Return and new line
$cr = "\r\n";

// Reciepent of the email
$Recipient = bloginfo('admin_email');

// Clean user input
$Name = cleanUserInput($_GET['name']);
$Email = strtolower(cleanUserInput($_GET['email']));
$Message = wordwrap(cleanUserInput($_GET['message']), 70, $cr);

// Email header info
$SiteUrl = ltrim($_SERVER['HTTP_HOST'], "www.");
$Date = date("l jS \of F Y h:i:s A");

// Email Header
$mailHeader = "From: {$SiteUrl} <website@{$SiteUrl}>" . $cr .
	"Reply-To: {$Name} <{$Email}>" . $cr .
	"Content-Type: text/plain; charset=utf-8" . $cr .
	"MIME-Version: 1.0" . $cr .
	"X-Mailer: PHP/" . phpversion();

// The Subject
$mailSubject = "[{$SiteUrl}] Message from {$Name}";

// The Message 
$mailMessage = $Message . "\r\n\n\t" . $Date;

// Send the email
if ($Name && $Email && $Message) {
	// Email Sent
	wp_mail($Recipient, $mailSubject, $mailMessage, $mailHeader);
	echo true;
} else {
	// Error
	echo false;
}


// Function: Sanitize the user input
function cleanUserInput($input) {
    return htmlspecialchars(strip_tags($input));
}
