<?php
$headers = 'From: connect@limespot.com' . "\r\n" .
    'Reply-To: connect@limespot.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = "New Contact Form submitted on the website:\r\n\r\n";

$message .= "Contact Name: " . $_POST["contactName"] . "\r\n";
$message .= "Contact Email: " . $_POST["contactEmail"] . "\r\n";
$message .= "Subject: " . $_POST["contactSubject"] . "\r\n";
$message .= "Message: " . $_POST["contactBody"] . "\r\n"; 

$sent = mail('connect@limespot.com', 'New Contact Form: ' . $_POST["contactSubject"], $message, $headers) or die("Cannot send mail.");

?>
