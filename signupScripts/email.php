<?php 

include 'EmailHelperClass.php';

// get data
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

// send email
$result = EmailHelperClass::createAndSendEmail_SponsorEmail($name, $email, $subject, $message);
$resultMessage = ($result) ? "Success!" : "There was a problem sending a email.  Please resubmit the form.";

// create result array
$resultArray = array(
	"SUCCESS"	=> $result, 
	"MESSAGE"			=> $resultMessage
);

// json encode array
$jsonResult = json_encode($resultArray);

// print array to screen as results
print_r($jsonResult); 


?>
