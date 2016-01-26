<?php 

class EmailHelperClass {
	
	/* 
	 * Create headers for all emails sent
	 */
	function createHeaders($subject, $sendTo, $replyTo = "Brittany Ann Kos <brittany.kos@colorado.edu>") {
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=ISO-8859-1";
		$headers[] = "To: $sendTo";
		$headers[] = "From: \"T9Hacks\" <no-reply@t9hacks.org>";
		$headers[] = "Subject: $subject";
		$headers[] = "Reply-To: $replyTo";
		$headers[] = "X-Mailer: PHP/" . phpversion();
		
		$h = implode("\r\n", $headers);
		
		return $h;
	}
	
	function getEmailStyles() {
		$styles['linkStyles'] = "color: #3A98C2; font-weight: normal;";
		return $styles;
	}
	
	function createEmailHeader() {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$header = "
			<html>
				<head></head>
				<body style='font-family:helvetica,arial,sans-serif;'>
					<div style='height: 100%; width: 100%; background: #DAC8DA; padding: 20px;' >
						<table style='width: 600px; max-width: 600px; margin: 0 auto; background: white; border-collapse: collapse;'>
		";
		return $header;
	}
	
	function createEmailFooter($name) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$footer = "
							<tr><td style='padding: 0 20px;'>
								<hr/>
							</td></tr>
							
							<tr><td style='padding: 0 20px;'>
								<p style='margin: 5px 0'>T9Hacks</p>
								<p style='margin: 5px 0'>20-21 February 2016</p>
								<p style='margin: 5px 0'><a href='https://www.google.com/maps?q=ATLAS+Institute,+University+of+Colorado+Boulder&um=1&ie=UTF-8&sa=X&ved=0ahUKEwitkd7m0-zJAhVC5iYKHUNyDcsQ_AUIBygB' style='$linkStyles' target='_blank' wotsearchprocessed='true'>
									ATLAS Institute, University of Colorado Boulder</a></p>
								<p style='margin: 5px 0'>Black Box Experimental Studio</p>
							</td></tr>
							
							<tr><td style='padding: 0 20px;'>
								<hr/>
							</td></tr>
							
							<tr><td style='padding: 0 20px;'>
								<h3 style='padding: 0; margin: 0 0 10px ;'>Questions about this event?</h3>
							</td></tr>
							<tr><td style='padding: 0 20px 20px;'>
								<p>
									Contact Brittany at 
									<a href='mailto:brittany.kos@colorado.edu?subject=T9Hacks+-+Question+from+$name' style='$linkStyles' target='_blank' wotsearchprocessed='true'>brittany.kos@colorado.edu</a>
									or Jessie at 
									<a href='mailto:jessica.albarian@colorado.edu ?subject=T9Hacks+-+Question+from+$name' style='$linkStyles' target='_blank' wotsearchprocessed='true'>jessica.albarian@colorado.edu </a>
								</p>
							</td></tr>
						
						</table>
					</div>
				</body>
			</html>
		";
		return $footer;
	}
	
	
	
	
	
	
	
	/* 
	 * Create and send confirmation emails for friends of participant and mentors
	 */
	function createAndSendEmail_RegistrationNotice($inputValues, $key, $isParticipant) {
		// create subject
		$subject = "A friend registered you for T9Hacks! Please complete your registration.";
		
		// create email message
		$message = EmailHelperClass::createEmail_RegistrationNotice($inputValues, $key, $isParticipant);
		
		// create headers
		$email = $inputValues['email'];
		$sendTo = $inputValues['name'] . " <$email>";
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	
	
/*
	 * Create email message - registration for participant and mentor
	 */
	function createEmail_RegistrationNotice($inputValues, $key, $isParticipant) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$name = $inputValues['name'];
		$friendName = $inputValues['friendName'];
		$link = "www.t9hacks.org/signupPages/signup-participant2.php?key=$key";
		
		if($isParticipant) {
			$intro = "This is your application notice for T9Hacks Spring 2016";
			
			$note = "
					<p>
						Your friend, $friendName, started your application for 
						<a href='www.t9hacks.org' style='$linkStyles' target='_blank' wotsearchprocessed='true'>T9Hacks</a>.
					</p>
					<p>
						T9Hacks is a 24 hour women's hackathon promoting gender diversity in technology.  It is held
						at the University of Colorado Boulder's ATLAS Institute on Feb 20-21.  T9Hacks brings students together 
						for a weekend of creativity, building, and hacking.
					</p>
					<p>
						Your friend has started your application, but to be considered for a spot at T9Hacks you will need to 
						complete your registration form.  
					</p>
					<p>
						Click on this link: 
						<br/>
						<a href='$link' style='$linkStyles' target='_blank' wotsearchprocessed='true'>$link</a> 
						<br/>
						(or copy and paste it into a web browser)  
						to go to the application page.
					</p>
					";
			
		} else {
			$intro = "This is your registration notice for T9Hacks Spring 2016";
			
			$note = "
					<p>
						Your colleague, $friendName, registered you as a mentor for 
						<a href='www.t9hacks.org' style='$linkStyles' target='_blank' wotsearchprocessed='true'>T9Hacks</a>.
					</p>
					<p>
						T9Hacks is a 24 hour women's hackathon promoting gender diversity in technology.  It is held
						at the University of Colorado Boulder's ATLAS Institute on Feb 20-21.  T9Hacks brings students together 
						for a weekend of creativity, building, and hacking.
					</p>
					<p>
						Your colleague has reserved you 
						a spot at T9Hacks, but to participate as a mentor, you will need to complete the process.  
					</p>
					<p>
						Click on this link: 
						<br/>
						<a href='$link' style='$linkStyles' target='_blank' wotsearchprocessed='true'>$link</a> 
						<br/>
						(or copy and paste it into a web browser)  
						to go to the registration page.
					</p>
					<p>
						We look forward to seeing you there!
					</p>
					";
		}
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name,</h2>
				<p>$intro</p>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
				
			<tr><td style='padding: 0 20px;'>
				$note
			</td></tr>
		" . EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	
	
	
	
	
	
	/* 
	 * Create and send confirmation emails for participant and mentors
	 */
	function createAndSendEmail_Confirmation($inputValues, $key, $isParticipant) {
		// create subject
		$subject = "";
		if($isParticipant)
			$subject = "Your Application Ticket for T9Hacks Spring 2016";
		else 
			$subject = "Your Registration Confirmation for T9Hacks Spring 2016";
		
		// create email message
		$message = EmailHelperClass::createEmail_Confirmation($inputValues, $key, $isParticipant);
		
		// create headers
		$email = $inputValues['email'];
		$sendTo = $inputValues['name'] . " <$email>";
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	
	
	/*
	 * Create email message - confirmation for participant and mentor
	 */
	function createEmail_Confirmation($inputValues, $key, $isParticipant) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$name = $inputValues['name'];
		
		if($isParticipant) {
			$intro = "This is your application for T9Hacks Spring 2016";
			$ticketName = "Application Ticket";
			$ticketType = "Hacker Participant";
			$extras = "
				
			";
			$link = "www.t9hacks.org/signupPages/signup-participant2.php?key=".$key;
			
		} else {
			$intro = "This is your signup confirmation for T9Hacks Spring 2016";
			$ticketName = "Ticket";
			$ticketType = "Mentor";
			$extras = "
				<tr><td style='padding: 5px 10px;'>Dinner on the 20th: </td><td style='padding: 5px 10px;'>" . ($inputValues['dinner']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Breakfast on the 21st: </td><td style='padding: 5px 10px;'>" . ($inputValues['breakfast']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Lunch on the 21st: </td><td style='padding: 5px 10px;'>" . ($inputValues['lunch']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Area: </td><td style='padding: 5px 10px;'>" . $inputValues['area'] . "</td></tr>
			";
			$link = "www.t9hacks.org/signupPages/signup-mentor2.php?key=".$key;
		}
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name,</h2>
				<p>$intro</p>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<h3>$ticketName</h3>
			</td></tr>
			<tr><td style='padding: 0 20px 20px;'>
				<table style='background: #AA88AA; border: 2px solid #553377; color: white; width: 98%; border-collapse: collapse;'>
					<tr style='background: #553377;'><td style='padding: 10px;'>Order Code: $key</td><td style='padding: 10px;'></td></tr>
					<tr><td style='padding: 5px 10px;'>Name: </td>	<td style='padding: 5px 10px;'>$name</td></tr>
					<tr><td style='padding: 5px 10px;'>Type: </td>	<td style='padding: 5px 10px;'>$ticketType</td></tr>
					$extras
					<tr><td style='padding: 5px 10px;'>Shirt Size: </td><td style='padding: 5px 10px;'>" . $inputValues['shirt'] . "</td></tr>
					<tr><td style='padding: 5px 10px;'>Comments: </td><td style='padding: 5px 10px;'>" . $inputValues['comment'] . "</td></tr>
				</table>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<p>
					You can edit your registration details by clicking on this link: 
					<br/>
					<a href='$link' style='$linkStyles' target='_blank' wotsearchprocessed='true'>$link</a> 
					<br/>
					(or by copying and pasting it into a web browser).
				</p>
			</td></tr>";
			
		if(!$isParticipant) {
			$message .= "
				<tr><td style='padding: 10px 20px;'>
					<p>
						We require that mentors be present for at least 2 hours during the hackathon.  For more specific 
						information about mentorship at T9Hacks, please visit our 
						<a href='http://t9hacks.org/documents/T9Hacks_MentorGuide.pdf' target='_blank' style='$linkStyles'>Mentor Guide</a>.
					</p>
				</td></tr>
			";
		}
				
		$message .= EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* 
	 * Create and send approval emails for participants
	 */
	function createAndSendEmail_Approval($personRecord) {
		$name = $personRecord[0]["name"];
		$email = $personRecord[0]["email"];
		$sendTo = $name . " <$email>";
		
		// create subject
		$subject = "Welcome to T9Hacks!";
		
		// create email message
		$message = EmailHelperClass::createEmail_Approval($name);
		
		// create headers
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	
	/*
	 * Create email message - confirmation for participant and mentor
	 */
	function createEmail_Approval($name) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name,</h2>
				<p>Welcome to T9Hacks!</p>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
				
			<tr><td style='padding: 0 20px;'>
				<p style='padding: 0 0 10px;'>
					We are amazed by the incredible number and quality of applications for T9Hack's first hackathon and  
					we are excited to invite you to this spring's edition!
				</p>
				<p style='padding: 0 0 10px;'>
					We will be sending out more information about the hackathon as the event draws closer.  Please be on 
					the lookout for future emails coming from the T9Hacks team.  We look forward to seeing you there!
				</p>
				<p style='padding: 0 0 10px;'>
					Best,
					<br/>
					The T9Hacks Team
				</p>
			</td></tr>
			" . EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	/* 
	 * Create and send approval emails for participants
	 */
	function createAndSendEmail_Rejection($personRecord) {
		$name = $personRecord[0]["name"];
		$email = $personRecord[0]["email"];
		$sendTo = $name . " <$email>";
		
		// create subject
		$subject = "Thanks for applying to T9Hacks";
		
		// create email message
		$message = EmailHelperClass::createEmail_Rejection($name);
		
		// create headers
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	function createEmail_Rejection($name) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name,</h2>
				<p>Thanks for applying to T9Hacks.</p>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<p style='padding: 0 0 10px;'>
					We are amazed at how many participants and supporters signed up for T9Hack's first hackathon! 
					Unfortunately, we were unable to invite you to this spring's edition. We're limited by the size of 
					the our hackathon space and with the ever-increasing number of applicants, we unfortunately can't accept 
					everyone.
				</p>
				<p style='padding: 0 0 10px;'>
					We're going to continue working on making T9Hacks even more accessible (and possibly even larger), so 
					definitely do apply for the next T9Hacks! We are planning on growing more every year, so definitely apply 
					again next Spring when we will try our best to continue scaling up. We hope to see you at the next one, 
					and we'll try our hardest to continue growing the hacker community.
				</p>
				<p style='padding: 0 0 10px;'>
					Best,
					<br/>
					The T9Hacks Team
				</p>
			</td></tr>
		" . EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	
	function createAndSendEmail_ReminderToCompleteRegistration($personRecord) {
		// get person's data
		$name = $personRecord[0]["name"];
		$email = $personRecord[0]["email"];
		$key = $personRecord[0]["key"];
		$reminderNum = $personRecord[0]["reminder_num"];
		
		// create send to
		$sendTo = $name . " <$email>";
		
		// create subject
		$subject = "Reminder: Please complete your registration for T9Hacks.";
		
		// create email message
		$message = EmailHelperClass::createEmail_ReminderToCompleteRegistration($name, $key);
		
		// create headers
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	function createEmail_ReminderToCompleteRegistration($name, $key) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$link = "www.t9hacks.org/signupPages/signup-participant2.php?key=$key";
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name,</h2>
				<p>This is your second application notice for T9Hacks Spring 2016!</p>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
				
			<tr><td style='padding: 0 20px;'>
				<p>
					Your friend started your application for 
					<a href='www.t9hacks.org' style='$linkStyles' target='_blank' wotsearchprocessed='true'>T9Hacks</a>.
				</p>
				<p>
					T9Hacks is a 24 hour women's hackathon promoting gender diversity in technology.  It is held
					at the University of Colorado Boulder's ATLAS Institute on Feb 20-21.  T9Hacks brings students together 
					for a weekend of creativity, building, and hacking.
				</p>
				<p><b>
					Your friend has started your application, but to be considered for a spot at T9Hacks you will need to 
					complete your registration form.  
				</b></p>
				<p>
					Click on this link: 
					<br/>
					<a href='$link' style='$linkStyles' target='_blank' wotsearchprocessed='true'>$link</a> 
					<br/>
					(or copy and paste it into a web browser)  
					to go to the application page.
				</p>
				<p>
					Thank you,<br/>
					T9Hacks Team
				</p>
			</td></tr>
		" . EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	
	
	
	
	
	
	
	/*
	 * Create and send email for every registration
	 */
	function createAndSendEmail_Register($resultArray, $inputValues) {
		// res
		$res = ( ($resultArray['SUCCESS'] == 1) ? "Success" : "Failure" );
		
		// create subject
		$subject = "ATLAS T9Hacks – Register Message – $res";
		
		// create message
		$message = "<html><head></head><body><h1>$res</h1><table>";
		
		$message .= "<tr><td colspan='2'><h2>Register Error Results</h2></td></tr>";
		foreach($resultArray as $key => $value) {
			$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		
		if(array_key_exists("participant", $inputValues)) {
			$message .= "<tr><td colspan='2'><h2>Input Values - Participant</h2></td></tr>";
			foreach($inputValues["participant"] as $key => $value) {
				$message .= "<tr><td>$key</td><td>$value</td></tr>";
			}
		}
		
		if(array_key_exists("mentor", $inputValues)) {
			$message .= "<tr><td colspan='2'><h2>Input Values - Mentor</h2></td></tr>";
			foreach($inputValues["mentor"] as $key => $value) {
				$message .= "<tr><td>$key</td><td>$value</td></tr>";
			}
		}
		
		if(array_key_exists("friends", $inputValues)) {
			$message .= "<tr><td colspan='2'><h2>Input Values - Friends</h2></td></tr>";
			foreach($inputValues["friends"] as $k => $friend) {
				foreach($friend as $key => $value)
					$message .= "<tr><td>$key</td><td>$value</td></tr>";
			}
		}
		
		if(array_key_exists("extra", $inputValues)) {
			$message .= "<tr><td colspan='2'><h2>Input Values - Extra</h2></td></tr>";
			foreach($inputValues["extra"] as $key => $value)
				$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		
		if(array_key_exists("post", $inputValues)) {
			$message .= "<tr><td colspan='2'><h2>Input Values - Post</h2></td></tr>";
			foreach($inputValues["post"] as $key => $value)
				$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		
		$message .= "</table></body></html>";
		//echo $message; die();
		
		// create send to
		$sendTo = "Brittany <britkos@gmail.com>";
		
		// create headers
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	
	
	/*
	 * Create and send email for every sponsor notice
	 */
	function createAndSendEmail_Sponsor($resultArray, $inputValues) {
		// res
		$res = ( ($resultArray['SUCCESS'] == 1) ? "Success" : "Failure" );
		
		// create subject
		$subject = "ATLAS T9Hacks – Sponsor Message – $res";
		
		
		// create message
		$message = "<html><head></head><body><h1>$res</h1><table>";
		
		$message .= "<tr><td colspan='2'><h2>Sponsor Error Results</h2></td></tr>";
		foreach($resultArray as $key => $value) {
			$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		
		$message .= "<tr><td colspan='2'><h2>Input Values</h2></td></tr>";
		foreach($inputValues as $key => $value) {
			$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		
		$message .= "</table></body></html>";
		//echo $message; die();
		
		
		// create send to
		$sendTo = "Brittany <britkos@gmail.com>";
		
		// create headers
		$headers = EmailHelperClass::createHeaders($subject, $sendTo);
		
		// send email
		$emailResult = mail($sendTo, $subject, $message, $headers);
		
		// return result
		return $emailResult;
	}
	
	
	
	
	
	
	
	
	
} // end class
	
	
?>