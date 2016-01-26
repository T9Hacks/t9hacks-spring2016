<?php 

include 'emailHelperClass.php';

// test key for all
$key = "Test Key";

// create input values for all
$inputValues = array(
	"name"		=> "Tester McTesterson",
	"email"		=> "test@email.com",
	"shirt"		=> "Medium",
	"comment"	=> "None",
	
	"area"		=> "Web Dev",
	"dinner"	=> 0,
	"breakfast"	=> 0,
	"lunch"		=> 1,
	
	"friendName"=> "Friend of Tester",
	"link"		=> "",
);

// test confirmation email
if(true) {
	echo EmailHelperClass::createEmail_Confirmation($inputValues, $key, true);
	echo EmailHelperClass::createEmail_Confirmation($inputValues, $key, false);
}

// test registration email
if(true) {
	echo EmailHelperClass::createEmail_RegistrationNotice($inputValues, $key, true);
	echo EmailHelperClass::createEmail_RegistrationNotice($inputValues, $key, false);
}

// test registration email
if(true) {
	echo EmailHelperClass::createEmail_Approval("a");
	echo EmailHelperClass::createEmail_Rejection("a");
	echo EmailHelperClass::createEmail_ReminderToCompleteRegistration("a", "key");
}

?>