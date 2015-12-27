<?php
header('Access-Control-Allow-Origin: *');
/*
// Please specify your Mail Server - Example: mail.example.com.
ini_set("SMTP","mail.example.com");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
ini_set("smtp_port","25");

// Please specify the return address to use
ini_set('sendmail_from', 'example@YourDomain.com');
*/

include 'DBHelperClass.php';
//include 'DropboxHelperClass.php';
include 'EmailHelperClass.php';

// Create default responses
$res_success		= false;
$res_message		= "Start";
$res_emailSuccess	= -1;
$res_honeypot		= -1;
$res_nameEmail		= -1;
$res_type			= -1;
$res_recordInsert	= -1;
$inputValues = array();

// only process if name and email are present
if( array_key_exists('name', $_POST) && array_key_exists('email', $_POST) ) {
	
	// turn name and email entered to success
	$res_nameEmail = 1;
	
	// test honeypot
	if(!empty($_POST['honeypot'])) {
		$res_message = "Honeypot filled in";
		$res_honeypot = 0;
		
	// honeypot success
	} else {
		// turn hoeypot to success
		$res_honeypot = 1;
		
		
		
		
		
		
		
		// participant signup
		if(array_key_exists('type', $_POST) && $_POST['type'] == "participant") {
		
			// set type to success
			$res_type = 1;
			
			$inputValues = array(
				"name"		=> $_POST['name'],
				"email"		=> $_POST['email'],
				"linkedin"	=> ( (array_key_exists('linkedin',	$_POST)) ? $_POST['linkedin']	: "" ),
				"resume"	=> "",
				"website"	=> ( (array_key_exists('website', 	$_POST)) ? $_POST['website']	: "" ),
				"github"	=> ( (array_key_exists('github', 	$_POST)) ? $_POST['github']		: "" ),
				"company"	=> ( (array_key_exists('company', 	$_POST)) ? $_POST['company']	: "" ),
				"title"		=> ( (array_key_exists('title', 	$_POST)) ? $_POST['title']		: "" ),
				"facebook"	=> ( (array_key_exists('facebook',	$_POST)) ? $_POST['facebook']	: "" ),
				"twitter"	=> ( (array_key_exists('twitter', 	$_POST)) ? $_POST['twitter']	: "" ),
				"shirt"		=> ( (array_key_exists('shirt', 	$_POST)) ? $_POST['shirt']		: "" )
			);
			
			// upload file script
			/*
			if(array_key_exists("resume", $_FILES) && !empty($_FILES["resume"]["name"])) {
				
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
			
			
			// create helper
			$db = new DBHelperClass();
			
			// create key
			$key = "P-" . substr(str_shuffle("abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789"), 0, 6);
			//echo $key; die();
			
			// add a participant
			$insertResult = $db->addParticipant($inputValues, $key);
			
			// close helper
			$db->close();
			
			// check if inserted record
			if(!$insertResult) {
				$res_message = "Something went wrong inserting participant record";
				$res_recordInsert = 0;
				
			// can contuine on emailing participant
			} else {
				
				// set successful record insert
				$res_recordInsert = 1;
				
				// send email
				$emailResult = EmailHelperClass::createAndSendEmail_ParticipantConfirmation($inputValues, $key);
				
				// check if successful
				if($emailResult) {
					// set successful email
					$res_emailSuccess = 1;
					
					// set only successful result
					$res_success = true;
					$res_message = "SUCCESS!!!";
					
				} else {
					$res_emailSuccess = 0;
					$res_message = "Something went wrong emailing ticket";
				}
				
			} // end else (emailing participant)
			
			
			
			
			
			
		// else mentor signup
		} else if(array_key_exists('type', $_POST) && $_POST['type'] == "mentor") {
			
			// set type to success
			$res_type = 1;
			
			// get the post values
			$inputValues = array(
				"name"		=> $_POST['name'],
				"email"		=> $_POST['email'],
				"company"	=> ( (array_key_exists('company', 	$_POST)) ? $_POST['company']	: "" ),
				"title"		=> ( (array_key_exists('title', 	$_POST)) ? $_POST['title']		: "" ),
				"breakfast"	=> ( (isset($_POST['breakfast'],	$_POST)) ? 1 : 0 ),
				"lunch"		=> ( (isset($_POST['lunch'],		$_POST)) ? 1 : 0 ),
				"dinner"	=> ( (isset($_POST['dinner'],		$_POST)) ? 1 : 0 ),
				"webDesign"	=> ( (array_key_exists('webDesign', $_POST)) ? 1 : 0 ),
				"webDev"	=> ( (array_key_exists('webDev', 	$_POST)) ? 1 : 0 ),
				"android"	=> ( (array_key_exists('android', 	$_POST)) ? 1 : 0 ),
				"iOS"		=> ( (array_key_exists('iOS', 		$_POST)) ? 1 : 0 ),
				"uiux"		=> ( (array_key_exists('uiux', 		$_POST)) ? 1 : 0 ),
				"gaming"	=> ( (array_key_exists('gaming', 	$_POST)) ? 1 : 0 ),
				"print"		=> ( (array_key_exists('print', 	$_POST)) ? 1 : 0 ),
				"arduino"	=> ( (array_key_exists('arduino', 	$_POST)) ? 1 : 0 )
			);
			
			
			// create helper
			$db = new DBHelperClass();
			
			// create key
			$key = "M-" . substr(str_shuffle("abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789"), 0, 6);
			//echo $key; die();
			
			// add a participant
			$insertResult = $db->addMentor($inputValues, $key);
			
			// close helper
			$db->close();
			
			// check if inserted record
			if(!$insertResult) {
				$res_message = "Something went wrong inserting mentor record";
				$res_recordInsert = 0;
				
			// can contuine on emailing participant
			} else {
				
				// set successful record insert
				$res_recordInsert = 1;
				
				// send email
				$emailResult = EmailHelperClass::createAndSendEmail_MentorConfirmation($inputValues, $key);
				
				// check if successful sent email
				if($emailResult) {
					// set successful email
					$res_emailSuccess = 1;
					
					// set only successful result
					$res_success = true;
					$res_message = "SUCCESS!!!";
					
				} else {
					$res_emailSuccess = 0;
					$res_message = "Something went wrong emailing ticket";
				}
				
			} // end else (emailing participant)
			
			
			
			
			
			
			
		// else wrong kind of signup
		} else {
			$res_type = 0;
			$res_message = "wrong signup type";
		}
		
		
		
	} // end else for honeypot
} else {
	$res_nameEmail = 0;
	$res_message = "no name and email";
}

// combine flags to create array
$resultArray = array(
	"success" 			=> $res_success, 
	"message"			=> $res_message,
	"nameEmailEntered"	=> $res_nameEmail,
	"honeypotPass" 		=> $res_honeypot,
	"typeCorrect"		=> $res_type,
	"recordInserted"	=> $res_recordInsert,
	"emailSuccess"		=> $res_emailSuccess
);



// json encode array
$jsonResult = json_encode($resultArray);

// print array to screen as results
print_r($jsonResult); 

// send me an email
EmailHelperClass::createAndSendEmail_Register($resultArray, $inputValues);

die();



?>