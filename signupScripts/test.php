<?php 

include 'emailHelperClass.php';

// test key for all
$key = "Test Key";

// create input values for all
$inputValues = array(
	"name" => "Tester McTesterson",
	"email" => "test@email.com",
);

// test confirmation email
if(true) {
	// 1 = participant
	// 2 = mentor
	$type = 2;
	
	// participant
	if($type == 1) {
		$inputValues['shirt'] = "Medium";
		
	// mentor
	} else if($type == 2) {
		$inputValues['breakfast'] = 0;
		$inputValues['lunch'] = 1;
		$inputValues['dinner'] = 0;
	}
	
	echo EmailHelperClass::createEmail_Confirmation($inputValues, $key, $type);
	
}

// test registration email
if(true) {
	// 1 = participant's friend
	// 2 = mentor's friend
	$type = 2;
	
	$inputValues['friendName'] = "Friend Tester";
	
	echo EmailHelperClass::createEmail_Registration($inputValues, $key, $type);
}

?>