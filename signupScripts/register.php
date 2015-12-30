<?php

/*
header('Access-Control-Allow-Origin: *');

// Please specify your Mail Server - Example: mail.example.com.
ini_set("SMTP","mail.example.com");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
ini_set("smtp_port","25");

// Please specify the return address to use
ini_set('sendmail_from', 'example@YourDomain.com');
*/

// set correct time zone
date_default_timezone_set('America/Denver');

include 'DBHelperClass.php';
include 'EmailHelperClass.php';

// global variables
$isParticipant = false;
$isMentor = false;
$selfInputValues = array();

// create index keys for result array
$SUCCESS 				= "SUCCESS";
$MESSAGE				= "MESSAGE";
$DETAIL_MESSAGE			="DETAIL_MESSAGE";
$PARTICIPANT			= "PARTICIPANT";
$MENTOR					= "MENTOR";

$HIDDEN_INPUTS_MISSING 	= "HIDDEN_INPUTS_MISSING";
$WRONG_NUM_FRIENDS		= "WRONG_NUM_FRIENDS";
$HONEYPOT_FILLED 		= "HONEYPOT_FILLED";
$WRONG_SIGNUP_TYPE 		= "WRONG_SIGNUP_TYPE";

$PARTICIPANT_INPUTS_MISSING 	= "PARTICIPANT_INPUTS_MISSING";
$PARTICIPANT_INPUTS_EMPTY 		= "PARTICIPANT_INPUTS_EMPTY";
$PARTICIPANT_EMAIL_USED			= "PARTICIPANT_EMAIL_USED";
$PARTICIPANT_SELF_RECORD_ERROR	= "PARTICIPANT_SELF_RECORD_ERROR";
$PARTICIPANT_SELF_EMAIL_ERROR	= "PARTICIPANT_SELF_EMAIL_ERROR";

$MENTOR_INPUTS_MISSING		= "MENTOR_INPUTS_MISSING";
$MENTOR_INPUTS_EMPTY 		= "MENTOR_INPUTS_EMPTY";
$MENTOR_EMAIL_USED			= "MENTOR_EMAIL_USED";
$MENTOR_SELF_RECORD_ERROR	= "MENTOR_SELF_RECORD_ERROR";
$MENTOR_SELF_EMAIL_ERROR	= "MENTOR_SELF_EMAIL_ERROR";

$END_SUCCESS	= "END_SUCCESS";


// create error messages
$errorMessages = array(
	$HIDDEN_INPUTS_MISSING => "There was a problem with your form. It looks like pieces of it are missing. Please refresh the page and start again.",
	$HONEYPOT_FILLED => "There was a problem verifying that you are human. If a field says to leave it blank, please do so.",
	$WRONG_SIGNUP_TYPE => "There was a problem with your form. It looks like you are trying to sign-up as a type of person that doesn't exist. Please refresh the page and start again.",
	$WRONG_NUM_FRIENDS => "There was a problem with your form.  It looks like you are trying to register too many friends.  Please refresh the page and start again.",
	
	$PARTICIPANT_INPUTS_MISSING => "There was a problem with your participant form. It looks like pieces of it are missing. Please refresh the page and start again.",
	$PARTICIPANT_INPUTS_EMPTY => "There was a problem with your participant registration.  Please check to make sure you have the required information entered in the form.",
	$PARTICIPANT_EMAIL_USED => "It looks like the email you are trying to register with has already been used.  Please check your email for a confirmation ticket or an invitation to complete the registeration process.",
	$PARTICIPANT_SELF_RECORD_ERROR => "There was a problem submitting your participant registration. . Please refresh the page and start again.",
	$PARTICIPANT_SELF_EMAIL_ERROR => "There was a problem sending a confirmation to your email.  Please check the email you entered and resubmit the form.",
	
	$MENTOR_INPUTS_MISSING => "There was a problem with your mentor form. It looks like pieces of it are missing. Please refresh the page and start again.",
	$MENTOR_INPUTS_EMPTY => "There was a problem with your mentor registration.  Please check to make sure you have the required information entered in the form.",
	$MENTOR_EMAIL_USED => "It looks like the email you are trying to sign-up with has already been used.  Please check your email for a confirmation or an invitation to complete the registeration process.",
	$MENTOR_SELF_RECORD_ERROR => "There was a problem submitting your mentor registration. . Please refresh the page and start again.",
	$MENTOR_SELF_EMAIL_ERROR => "There was a problem sending a confirmation to your email.  Please check the email you entered and resubmit the form.",
	
	$END_SUCCESS => "SUCCESS!!!",
);

// create skelton result array
$resultArray = array(
	$SUCCESS 			=> false, 
	$MESSAGE			=> "Start",
	$DETAIL_MESSAGE		=> "",
	$PARTICIPANT		=> -1,
	$MENTOR				=> -1,
		
	$HIDDEN_INPUTS_MISSING	=> -1,
	$HONEYPOT_FILLED 		=> -1,
	$WRONG_SIGNUP_TYPE		=> -1,
	$WRONG_NUM_FRIENDS		=> -1,
		
	$PARTICIPANT_INPUTS_MISSING		=> -1,
	$PARTICIPANT_INPUTS_EMPTY		=> -1,
	$PARTICIPANT_EMAIL_USED			=> -1,
	$PARTICIPANT_SELF_RECORD_ERROR	=> -1,
	$PARTICIPANT_SELF_EMAIL_ERROR	=> -1,
	
	$MENTOR_INPUTS_MISSING		=> -1,
	$MENTOR_INPUTS_EMPTY		=> -1,
	$MENTOR_EMAIL_USED			=> -1,
	$MENTOR_SELF_RECORD_ERROR	=> -1,
	$MENTOR_SELF_EMAIL_ERROR	=> -1,
);


/* ************************************ */
/* 		Test For Hidden Inputs			*/
/* ************************************ */
// test - hiden inputs
if( !array_key_exists('honeypot', $_POST) || !array_key_exists('type', $_POST) || !array_key_exists('friends', $_POST) ) {
	
	// bad - hiden inputs
	$resultArray[$HIDDEN_INPUTS_MISSING] = 1;
	$resultArray[$MESSAGE] = $errorMessages[$HIDDEN_INPUTS_MISSING];

// success - hiden inputs
} else {
	
	// good - hidden inputs
	$resultArray[$HIDDEN_INPUTS_MISSING] = 0;
	
	
	
	/* ************************************************ */
	/* 			Test For Correct Number of Friends		*/
	/* ************************************************ */
	$numFriends = $_POST['friends'];
	// test - num friends
	if( $numFriends != 0 && $numFriends != 1 && $numFriends != 2 && $numFriends != 3) {
		
		// bad - num friends
		$resultArray[$WRONG_NUM_FRIENDS] = 1;
		$resultArray[$MESSAGE] = $errorMessages[$WRONG_NUM_FRIENDS];
			
	// success - num friends
	} else {
		
		// good - num friends
		$resultArray[$WRONG_NUM_FRIENDS] = 0;
		
		
		
		/* ******************************** */
		/* 			Test Honeypot			*/
		/* ******************************** */
		// test - honeypot
		if( !empty($_POST['honeypot']) ) {
			
			// bad - honeypot
			$resultArray[$HONEYPOT_FILLED] = 1;
			$resultArray[$MESSAGE] = $errorMessages[$HONEYPOT_FILLED];
		
		// success - honeypot
		} else {
			
			// good - honeypot
			$resultArray[$HONEYPOT_FILLED] = 0;
			
			
			
			/* **************************************** */
			/* 		Test For Correct Signup Type		*/
			/* **************************************** */
			// test - signup type
			if( $_POST['type'] != "participant" && $_POST['type'] != "mentor") {
				
				// bad - signup type
				$resultArray[$WRONG_SIGNUP_TYPE] = 1;
				$resultArray[$MESSAGE] = $errorMessages[$WRONG_SIGNUP_TYPE];
				
			// success - signup type
			} else {
				
				// good - signup type
				$resultArray[$WRONG_SIGNUP_TYPE] = 0;
				
				
				// create database helper
				$db = new DBHelperClass();
				
				// create array to store inputs
				$selfInputNames = array();
				$numReqInputs = 3;
				
				
				/* ************************************ */
				/* 		Participant Registration		*/
				/* ************************************ */
				// test - participant flag
				if($_POST['type'] == "participant") {
				
					// success - participant flag
					$resultArray[$PARTICIPANT] = 1;
					$resultArray[$MENTOR] = 0;
					$isParticipant = true;
					$isMentor = false;
					
					// store inputs
					$selfInputNames = array( "name", "email", "college", "major", "phone", "linkedin", "website", "github", "company", "position", "facebook", "twitter", "shirt" );
					$numReqInputs = 5;
					
					
				/* **************************** */
				/* 		Mentor Registration		*/
				/* **************************** */
				// test - participant flag
				} else if($_POST['type'] == "mentor") {
					
					// success - participant flag
					$resultArray[$PARTICIPANT] = 0;
					$resultArray[$MENTOR] = 1;
					$isParticipant = false;
					$isMentor = true;
					
					$selfInputNames = array("name", "email", "phone", "company", "position", "breakfast", "lunch", "dinner", "webDesign", "webDev", "android", "iOS", "uiux", "gaming", "print", "arduino" );
					$numReqInputs = 3;
					$numMentorTextInputs = 5;
				}
					
					
					
				/* ************************************ */
				/* 		Test For Remaining Inputs		*/
				/* ************************************ */
				// add to counter if does not exist
				$doesNotExist = 0;
				$doesNotExistNames = "";
				if($isParticipant) {
					foreach($selfInputNames as $name)
						if( !array_key_exists($name, $_POST) ) {
							$doesNotExist++;
							$doesNotExistNames .= $name;
						}
				} else {
					$i = 0;
					foreach($selfInputNames as $name) {
						if( $i < $numMentorTextInputs && !array_key_exists($name, $_POST) ) {
							$doesNotExist++;
							$doesNotExistNames .= $name;
						}
					$i++;
					}
				}
				
				// test - missing inputs
				if($doesNotExist != 0) {
					
					// bad - missing inputs
					if($isParticipant) {
						$resultArray[$PARTICIPANT_INPUTS_MISSING] = 1;
						$resultArray[$MESSAGE] = $errorMessages[$PARTICIPANT_INPUTS_MISSING];
					} else {
						$resultArray[$MENTOR_INPUTS_MISSING] = 1;
						$resultArray[$MESSAGE] = $errorMessages[$MENTOR_INPUTS_MISSING];
					}
					$resultArray[$DETAIL_MESSAGE] = $doesNotExistNames;
					
				// success - missing inputs
				} else {
					
					// good - missing participant inputs
					$resultArray[$PARTICIPANT_INPUTS_MISSING] = 0;
					$resultArray[$MENTOR_INPUTS_MISSING] = 0;
					
					
					
					/* ******************************** */
					/* 		Test For Empty Inputs		*/
					/* ******************************** */
					// get form input values
					$selfInputValues = array();
					if($isParticipant) 
						foreach($selfInputNames as $name) 
							$selfInputValues[$name] = $_POST[$name];
					else {
						$i=0;
						foreach($selfInputNames as $name) {
							if($i < $numMentorTextInputs)
								$selfInputValues[$name] = $_POST[$name];
							else 
								$selfInputValues[$name] = (array_key_exists($name, $_POST) ? 1 : 0);
							$i++;
						}
					}
					
					// add resume input, test later
					if($isParticipant)
						$selfInputValues["resume"] = "";
					
					// add to counter if empty input
					$emptyInputs = 0;
					$i=0;
					foreach($selfInputValues as $k => $v) {
						if($i < $numReqInputs)
							if( $v == null || empty($v) || $v == "" || trim($v, " \t\n\r\0\x0B") == "" )
								$emptyInputs++;
						$i++;
					}
					
					// test - empty participant inputs
					if($emptyInputs != 0) {
						
						// bad - empty participant inputs
						if($isParticipant) {
							$resultArray[$PARTICIPANT_INPUTS_EMPTY] = 1;
							$resultArray[$MESSAGE] = $errorMessages[$PARTICIPANT_INPUTS_EMPTY];
						} else {
							$resultArray[$MENTOR_INPUTS_EMPTY] = 1;
							$resultArray[$MESSAGE] = $errorMessages[$MENTOR_INPUTS_EMPTY];
						}
					
					// success - empty participant inputs
					} else {
						
						// good - empty participant inputs
						$resultArray[$PARTICIPANT_INPUTS_EMPTY] = 0;
						$resultArray[$MENTOR_INPUTS_EMPTY] = 0;
						
						
						
						/* ******************************************** */
						/* 		Test For Email Already Registered		*/
						/* ******************************************** */
						$email = $selfInputValues['email'];
						
						// test - participant email used
						if( $db->participantEmailRegistered($email) ) {
							
							// bad - participant email used
							$resultArray[$PARTICIPANT_EMAIL_USED] = 1;
							$resultArray[$MESSAGE] = $errorMessages[$PARTICIPANT_EMAIL_USED];
						
						// test - participant email used
						} else if( $db->mentorEmailRegistered($email) ) {
							
							// bad - participant email used
							$resultArray[$MENTOR_EMAIL_USED] = 1;
							$resultArray[$MESSAGE] = $errorMessages[$MENTOR_EMAIL_USED];
							
						// success - participant email used
						// success - mentor email used
						} else {
							
							// good - participant email used
							// good - participant email used
							$resultArray[$PARTICIPANT_EMAIL_USED] = 0;
							$resultArray[$MENTOR_EMAIL_USED] = 0;
						
					
					
							/* **************************************** */
							/* 		Participant Upload File Script		*/
							/* **************************************** */
							/*
							if( !empty($_FILES["resume"]["name"]) ) {
								
								// get unique date
								date_default_timezone_set('America/Denver');
								$date = date("YmdHis");
								$filenameAddition = "___" . $date;
								
								// get names and types
								$defaultFileName = basename($_FILES["resume"]["name"]);
								$tmpFileName = $_FILES["resume"]["tmp_name"];
								$fileType = pathinfo($filename, PATHINFO_EXTENSION);
								$extensionPos = strrpos($defaultFileName, '.'); // find position of the last dot, so where the extension starts
								
								// get updated name
								$updatedFileName = substr($defaultFileName, 0, $extensionPos) . $filenameAddition . substr($defaultFileName, $extensionPos);
								$inputValues['resume'] = $updatedFileName;
								
								
								// create helper
								$dropbox = new DropboxHelperClass();
								
								// upload file
								$dropbox->uploadFile($tmpFileName, $updatedFileName);
							}
							*/
						
						
							/* ******************************** */
							/* 		Create Self Record Test		*/
							/* ******************************** */
							// create key
							$keyPrefix = ($isParticipant) ? "P-" : "M-";
							$key = $keyPrefix . substr(str_shuffle("abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789"), 0, 6);
							
							// add self record
							$selfInsertResult = false;
							if($isParticipant)
								$selfInsertResult = $db->addParticipant($selfInputValues, $key);
							else 
								$selfInsertResult = $db->addMentor($selfInputValues, $key);
							
							// test - insert self record
							if( !$selfInsertResult ) {
								// bad - insert self record
								if($isParticipant) {
									$resultArray[$PARTICIPANT_SELF_RECORD_ERROR] = 1;
									$resultArray[$MESSAGE] = $errorMessages[$PARTICIPANT_SELF_RECORD_ERROR];
								} else {
									$resultArray[$MENTOR_SELF_RECORD_ERROR] = 1;
									$resultArray[$MESSAGE] = $errorMessages[$MENTOR_SELF_RECORD_ERROR];
								}
								
							// success - insert self record
							} else {
								
								// good - insert self record
								$resultArray[$PARTICIPANT_SELF_RECORD_ERROR] = 0;
								$resultArray[$MENTOR_SELF_RECORD_ERROR] = 0;
						
									
								
								/* ******************************** */
								/* 		Send Self Email Test		*/
								/* ******************************** */
								// send email
								$emailResult = false;
								if($isParticipant)
									$emailResult = EmailHelperClass::createAndSendEmail_ParticipantConfirmation($selfInputValues, $key);
								else 
									$emailResult = EmailHelperClass::createAndSendEmail_MentorConfirmation($selfInputValues, $key);
								
								// test - send self email
								if( !$emailResult ) {
									// bad - send self email
									if($isParticipant) {
										$resultArray[$PARTICIPANT_SELF_EMAIL_ERROR] = 1;
										$resultArray[$MESSAGE] = $errorMessages[$PARTICIPANT_SELF_EMAIL_ERROR];
									} else {
										$resultArray[$MENTOR_SELF_EMAIL_ERROR] = 1;
										$resultArray[$MESSAGE] = $errorMessages[$MENTOR_SELF_EMAIL_ERROR];
									}
									
								// success - send self email
								} else {
									// good - send self email
									$resultArray[$PARTICIPANT_SELF_EMAIL_ERROR] = 0;
									$resultArray[$MENTOR_SELF_EMAIL_ERROR] = 0;
									
									// end
									$resultArray[$MESSAGE] = $errorMessages[$END_SUCCESS];
									$resultArray[$SUCCESS] = true;
									
								} // end else for send self email
									
							} // end else for insert self record test
							
						} // end else for participant and mentor email already used test
						
					} // end else for empty inputs test
					
				} // end else for missing inputs test
					
				
				// close database helper
				$db->close();
				
				
			} // end else for mentor or participant test
			
		} // end else for honeypot test
		
	} // end else for num friends test
	
} //end else hidden inputs test
	



// json encode array
$jsonResult = json_encode($resultArray);

// print array to screen as results
print_r($jsonResult); 

// send me an email
EmailHelperClass::createAndSendEmail_Register($resultArray, $selfInputValues);

die();


?>