<?php
$message = "New Join LimeSpot form submitted on the website:\r\n\r\n";

$headers = 'From: connect@limespot.com' . "\r\n" .
    'Reply-To: connect@limespot.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
$message .= "Contact Name: " . $_POST["contactname"] . "\r\n";
$message .= "Contact Email: " . $_POST["contactemail"] . "\r\n";
$message .= "Phone Number: " . $_POST["phonenumber"] . "\r\n";
$message .= "Company Name: " . $_POST["companyname"] . "\r\n"; 
$message .= "Company Website: " . $_POST["companywebsite"] . "\r\n"; 
$message .= "Facebook Page: " . $_POST["facebookpage"] . "\r\n"; 
$message .= "City: " . $_POST["city"] . "\r\n"; 
$message .= "Country: " . $_POST["country"] . "\r\n"; 
$message .= "Line of Business: " . $_POST["lineofbusiness"] . "\r\n"; 
$message .= "Number of Employees: " . $_POST["numberemployees"] . "\r\n"; 
$message .= "Number of Products: " . $_POST["numberproducts"] . "\r\n"; 
$message .= "E-commerce Provider: " . $_POST["ecommerceprovider"] . "\r\n";

if (isset($_POST["otherecommerce"]))
	$message .= "Other E-commerce: " . $_POST["otherecommerce"] . "\r\n"; 

mail('connect@limespot.com', 'New Join LimeSpot form', $message, $headers) or die("Cannot send mail.");
?>
