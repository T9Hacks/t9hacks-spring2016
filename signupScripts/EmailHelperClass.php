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
					<div style='height: 100%; width: 100%; background: #eee; padding: 20px;' >
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
								<h3>Questions about this event?</h3>
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
	function createAndSendEmail_Registration($inputValues, $key, $friendType) {
		// create subject
		$subject = "A friend registered you for T9Hacks! Please complete your registration.";
		
		// create email message
		$message = EmailHelperClass::createEmail_Registration($inputValues, $key, $friendType);
		
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
	function createEmail_Registration($inputValues, $key, $friendType) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$name = $inputValues['name'];
		$friendName = $inputValues['friendName'];
		
		if($friendType == 1) {
			$type = "participant";
			$link = "www.t9hacks.org/signupPages/signup-participant2.php?t=2&key=".$key;
			
		} else if ($friendType == 2) {
			$type = "mentor";
			$link = "www.t9hacks.org/signupPages/signup-mentor2.php?t=2&key=".$key;
		}
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name, this is your registration notice for T9Hacks Spring 2016</h2>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<hr/>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<p>
					Your friend, $friendName, registered you as a $type for 
					<a href='www.t9hacks.org' style='$linkStyles' target='_blank' wotsearchprocessed='true'>T9Hacks</a>.
				</p>
				<p>
					T9Hacks is a 24 hour female hackathon at the University of Colorado Boulder's ATLAS Institute 
					that brings together students for a day of creativity, building, and hacking.
				</p>
				<p>
					Your friend has reserved you 
					a spot at T9Hacks, but to participate as a $type, you will need to complete the process.  
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
			</td></tr>
		" . EmailHelperClass::createEmailFooter($name);
		
		return $message;
	}
	
	
	
	
	
	
	
	
	
	/* 
	 * Create and send confirmation emails for participant and mentors
	 */
	function createAndSendEmail_Confirmation($inputValues, $key, $type) {
		// create subject
		$subject = "";
		if($type == 1)
			$subject = "Your Ticket for T9Hacks Spring 2016";
		else if ($type == 2)
			$subject = "Your Confirmation for T9Hacks Spring 2016";
		
		// create email message
		$message = EmailHelperClass::createEmail_Confirmation($inputValues, $key, $type);
		
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
	function createEmail_Confirmation($inputValues, $key, $type) {
		$styles = EmailHelperClass::getEmailStyles();
		$linkStyles = $styles['linkStyles'];
		
		$name = $inputValues['name'];
		
		if($type == 1) {
			$ticketName = "Ticket";
			$ticketType = "Hacker Participant";
			$extras = "
				<tr><td style='padding: 5px 10px;'>Shirt: </td>	<td style='padding: 5px 10px;'>" . $inputValues['shirt'] . "</td></tr>
			";
			$link = "www.t9hacks.org/signupPages/signup-participant2.php?key=".$key;
			
		} else if ($type == 2) {
			$ticketName = "Ticket";
			$ticketType = "Mentor";
			$extras = "
				<tr><td style='padding: 5px 10px;'>Breakfast: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['breakfast']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Lunch: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['lunch']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Dinner: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['dinner']==1?"Yes":"No") . "</td></tr>
			";
			$link = "www.t9hacks.org/signupPages/signup-mentor2.php?key=".$key;
		}
		
		$message = EmailHelperClass::createEmailHeader() . "
			<tr><td style='padding: 20px 20px 0 20px;'>
				<h2>Hi $name, this is your signup confirmation for T9Hacks Spring 2016</h2>
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
				</table>
			</td></tr>
			
			<tr><td style='padding: 0 20px;'>
				<p>
					You can edit your confirmation details by clicking on this link: 
					<br/>
					<a href='$link' style='$linkStyles' target='_blank' wotsearchprocessed='true'>$link</a> 
					<br/>
					(or by copying and pasting it into a web browser).
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
			foreach($inputValues["extra"] as $k => $friend) {
				foreach($friend as $key => $value)
					$message .= "<tr><td>$key</td><td>$value</td></tr>";
			}
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
	 * Create and send email for index page sponsor interest
	 */
	function createAndSendEmail_SponsorEmail($sponsorName, $sponsorEmail, $sponsorSubject, $sponsorMessage) {
		// create subject
		$sendSubject = "Sponsor Email From T9Hacks";
		
		// create message
		$sendMessage = "<html><head></head><body><h2>Here is the sponsor email sent from T9Hacks.org</h2><table style='border-collapse: collapse'>";
		$sendMessage .= "<tr><td style='border:1px solid black;padding:10px;'><b>Name: </b></td><td style='border:1px solid black;padding:10px;'><p>$sponsorName</p></td></tr>";
		$sendMessage .= "<tr><td style='border:1px solid black;padding:10px;'><b>Email: </b></td><td style='border:1px solid black;padding:10px;'><p>$sponsorEmail</p></td></tr>";
		$sendMessage .= "<tr><td style='border:1px solid black;padding:10px;'><b>Subject: </b></td><td style='border:1px solid black;padding:10px;'><p>$sponsorSubject</p></td></tr>";
		$sendMessage .= "<tr><td style='border:1px solid black;padding:10px;'><b>Message: </b></td><td style='border:1px solid black;padding:10px;'><p>$sponsorMessage</p></td></tr>";
		$sendMessage .= "</table></body></html>";
		
		// create sender's reply to
		$replyTo = "$sponsorName <$sponsorEmail>";
		
		// create send to
		$sendTo = 'Brittany Ann Kos <brittany.kos@colorado.edu>, Jessie Albarian <jessica.albarian@colorado.edu>';
		//$sendTo = 'Brittany Ann Kos <brittany.kos@colorado.edu>';
		
		// create headers
		$sendHeaders = EmailHelperClass::createHeaders($sendSubject, $sendTo, $replyTo);
		
		// send email
		$emailResult = mail($sendTo, $sendSubject, $sendMessage, $sendHeaders);
		
		// return result
		return ($emailResult);
	}
	
} // end class
	
	
?>