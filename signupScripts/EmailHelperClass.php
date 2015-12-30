<?php 

class EmailHelperClass {
	
	function createHeaders($subject, $to, $replyAddress = "brittany.kos@colorado.edu") {
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=ISO-8859-1";
		$headers[] = "To: $to";
		$headers[] = "From: ATLAS T9Hacks <no-reply@t9hacks.org>";
		$headers[] = "Subject: $subject";
		$headers[] = "Reply-To: $replyAddress";
		$headers[] = "X-Mailer: PHP/" . phpversion();
		
		$h = implode("\r\n", $headers);
		
		return $h;
	}
	
	
	function createAndSendEmail_ParticipantConfirmation($inputValues, $key) {
		// create email message
		$message = EmailHelperClass::createEmail_Confirmation($inputValues, $key, 0);
		
		return EmailHelperClass::finishEmail($inputValues, "Your Ticket for ATLAS T9Hacks Spring 2016");
		
	}
	
	function createAndSendEmail_MentorConfirmation($inputValues, $key) {
		// create email message
		$message = EmailHelperClass::createEmail_Confirmation($inputValues, $key, 1);
		
		return EmailHelperClass::finishEmail($inputValues, "Your Confirmation for ATLAS T9Hacks Spring 2016");
	}
	
	function finishEmail($inputValues, $subject) {
		// create headers
		$to = "To: " . $inputValues['name'] . "<" . $inputValues['email'] . ">";
		$h = EmailHelperClass::createHeaders($subject, $to);
		
		// send email
		$emailResult = mail($inputValues['email'], $subject, $message, $h);
		
		// return result
		return $emailResult;
	}
	
	
	function createEmail_Confirmation($inputValues, $key, $type) {
		$name = $inputValues['name'];
		
		if($type == 1) {
			$ticketName = "Ticket";
			$ticketType = "Mentor";
			$extras = "
				<tr><td style='padding: 5px 10px;'>Breakfast: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['breakfast']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Lunch: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['lunch']==1?"Yes":"No") . "</td></tr>
				<tr><td style='padding: 5px 10px;'>Dinner: </td>	<td style='padding: 5px 10px;'>" . ($inputValues['dinner']==1?"Yes":"No") . "</td></tr>
			";
			
		} else if ($type == 0) {
			$ticketName = "Ticket";
			$ticketType = "Hacker Participant";
			$extras = "
				<tr><td style='padding: 5px 10px;'>Shirt: </td>	<td style='padding: 5px 10px;'>" . $inputValues['shirt'] . "</td></tr>
			";
		}
		
		$message = "
			<html>
				<head></head>
				<body style='font-family:helvetica,arial,sans-serif;'>
					<div style='height: 100%; width: 100%; background: #eee; padding: 20px;' >
						<table style='width: 600px; max-width: 600px; margin: 0 auto; background: white; border-collapse: collapse;'>
						
							<tr><td style='padding: 20px 20px 0 20px;'>
								<h2>Hi $name, this is your signup confirmation for ATLAS T9Hacks Spring 2016</h2>
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
								<p>20 February 2016</p>
								<p><a href='https://www.google.com/maps?q=ATLAS+Institute,+University+of+Colorado+Boulder&um=1&ie=UTF-8&sa=X&ved=0ahUKEwitkd7m0-zJAhVC5iYKHUNyDcsQ_AUIBygB' style='text-decoration:none;color:#5AB8E2;font-weight:normal' target='_blank' wotsearchprocessed='true'>
									ATLAS Institute, University of Colorado Boulder</a></p>
								<p>Black Box Experimental Studio</p>
							</td></tr>
							
							<tr><td style='padding: 0 20px;'>
								<hr/>
							</td></tr>
							
							<tr><td style='padding: 0 20px;'>
								<h3>Questions about the event?</h3>
							</td></tr>
							<tr><td style='padding: 0 20px 20px;'>
								<p>
									Contact Brittany at 
									<a href='mailto:brittany.kos@colorado.edu?subject=T9Hacks+-+Question+from+$name' style='text-decoration:none;color:#5AB8E2;font-weight:normal' target='_blank' wotsearchprocessed='true'>brittany.kos@colorado.edu</a>
									or Jessie at 
									<a href='mailto:jessica.albarian@colorado.edu ?subject=T9Hacks+-+Question+from+$name' style='text-decoration:none;color:#5AB8E2;font-weight:normal' target='_blank' wotsearchprocessed='true'>jessica.albarian@colorado.edu </a>
								</p>
							</td></tr>
						
						</table>
					</div>
				</body>
			</html>
		";
		
		return $message;
	}
	
	
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
		$message .= "<tr><td colspan='2'><h2>Input Values</h2></td></tr>";
		foreach($inputValues as $key => $value) {
			$message .= "<tr><td>$key</td><td>$value</td></tr>";
		}
		$message .= "</table></body></html>";
		
		// create headers
		$to = "To: Brittany <britkos@gmail.com>";
		$h = EmailHelperClass::createHeaders($subject, $to);
		
		// send email
		$emailResult = mail("britkos@gmail.com", $subject, $message, $h);
		
		// return result
		return $emailResult;
	}
	
	
	function createAndSendEmail_SponsorEmail($name, $email, $subject, $message) {
		// create subject
		$subject = "Sponsor Email From T9Hacks";
		
		// create message
		$message = "<html><head></head><body><h1>Email send from T9Hacks.org</h1><table>";
		$message .= "<tr><td><h2>Name: </h2><p>$name</p></td></tr>";
		$message .= "<tr><td><h2>Email: </h2><p>$email</p></td></tr>";
		$message .= "<tr><td><h2>Subject: </h2><p>$subject</p></td></tr>";
		$message .= "<tr><td><h2>Message: </h2><p>$message</p></td></tr>";
		$message .= "</table></body></html>";
		
		// create headers
		$to = 'To: Brittany Ann Kos <brittany.kos@colorado.edu>, Jessie Albarian<jessica.albarian@colorado.edu>';
		$h = EmailHelperClass::createHeaders($subject, $to, $email);
		
		// send email
		$emailResult1 = mail("brittany.kos@colorado.edu", $subject, $message, $h);
		$emailResult2 = mail("jessica.albarian@colorado.edu", $subject, $message, $h);
		
		// return result
		return ($emailResult1 && $emailResult2);
	}
	
} // end class
	
	
?>