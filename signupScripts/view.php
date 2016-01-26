<?php 

include 'DBHelperClass.php';
include 'EmailHelperClass.php';

$isSession = false;

// check if session
if(array_key_exists("t9hacks_login", $_COOKIE) && $_COOKIE["t9hacks_login"] == 1) {
	
	// set session
	$isSession = true;
	
	// create helper
	$db = new DBHelperClass();
	
	// make submit
	if(array_key_exists("action", $_POST) && array_key_exists("id", $_POST) && array_key_exists("type", $_POST)) {
		$id = $_POST["id"];
		$type = $_POST["type"];
			
		switch($_POST["action"]) {
			case "delete":
				$db->updateRecord(($type == 1), $id, "deleted", 1);
				break;
			case "approve":
				$db->updateRecord(($type == 1), $id, "approved", 1);
				if($type==1)
					EmailHelperClass::createAndSendEmail_Approval($db->getPeopleFromId(true, $id));
				break;
			case "reject":
				$db->updateRecord(($type == 1), $id, "approved", 2);
				if($type == 1)
					EmailHelperClass::createAndSendEmail_Rejection($db->getPeopleFromId(true, $id));
				break;
			case "checkIn":
				$db->updateRecord(($type == 1), $id, "checked_in", 1);
				break;
			case "unCheckIn":
				$db->updateRecord(($type == 1), $id, "checked_in", 0);
				break;
			case "unregister":
				$db->updateRecord(($type == 1), $id, "unregistered", 1);
				break;
			case "register":
				$db->updateRecord(($type == 1), $id, "unregistered", 0);
				break;
			case "reminderReg" :
				if($type == 1) {
					$db->updateRecord(($type == 1), $id, "reminder_num", 1);
					EmailHelperClass::createAndSendEmail_ReminderToCompleteRegistration($db->getPeopleFromId(true, $id));
				}
				break;
			case "setFemale":
				$db->updateRecord(($type == 1), $id, "set_gender", 1);
				break;
			case "setMale":
				$db->updateRecord(($type == 1), $id, "set_gender", 2);
				break;
			case "setX":
				$db->updateRecord(($type == 1), $id, "set_gender", 3);
				break;
			case "setCU":
				$db->updateRecord(($type == 1), $id, "set_college", 1);
				break;
			case "setCO":
				$db->updateRecord(($type == 1), $id, "set_college", 2);
				break;
			case "setUS":
				$db->updateRecord(($type == 1), $id, "set_college", 3);
				break;
			case "setWorld":
				$db->updateRecord(($type == 1), $id, "set_college", 4);
				break;
			default: break;
		}
		
		header('Location: view.php');
		$db->close();
	}
	
	
	
	// run sql stmt
	if(array_key_exists("exe", $_POST) && $_POST["exe"] == 1) {
		// check if exe
		if(array_key_exists("exeStmt", $_POST)) {
			// get exeStmt
			$exe = $_POST["exeStmt"];
			
			// check in id
			$db->runExe($exe);
			
			// close helper
			$db->close();
			
			// relocate to same page without post data
			header('Location: view.php');
		}
	}
	
	// get participants
	$participants = $db->getParticipants();
	
	// get mentors
	$mentors = $db->getMentors();
	
	// close helper
	$db->close();

// no session
} else {
	
	// check if loggin in
	if(array_key_exists("login", $_POST) && $_POST["login"] == 1) {
		
		// check if username and login exists
		if(array_key_exists("username", $_POST) && array_key_exists("password", $_POST)) {
			
			// get data
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			// create helper
			$db = new DBHelperClass();
			
			// check if correct login
			if($db->login($username, $password)) {
				// correct, so set cookie
				setcookie("t9hacks_login", "1", time()+(60*60*24));
				
				// close helper
				$db->close();
				
				// relocate to same page without post data
			header('Location: view.php');
			}
			
			// close helper
			$db->close();
		}
		
	}
	
}




//echo '<pre>' . print_r($participants, true) . '</pre>';
?>

<!DOCTYPE html>
<html>
<head>
	
	<title>T9Hacks - Database</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php include "../includes/css.php"; css(true); ?>
	<link href="../css/adminView.css" rel="stylesheet">
	
</head>
<body>

	<?php 
	if(!$isSession) {
		?>
		<form action="view.php" method="post">
			<label>Username</label>
			<input type="text" name="username" />
			<label>Password</label>
			<input type="password" name="password" />
			<input type="hidden" name="login" value="1">
			<input type="submit" value="Login"/>
		</form>
		<?php 
	} else if($isSession) {
	?>
		
		<div class="filterButtons">
			<div class="filterGroup tabs">
				<div class="tabBtn active" id="participantsBtn">Participants</div>
				<div class="tabBtn" id="mentorsBtn">Mentors</div>
				<div class="tabBtn" id="extrasBtn">Extras</div>
			</div> 
			
			<div class="filterGroup">
				<div class="filterBtn active" id="allFilterBtn">All<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="approvedFilterBtn">Approved Admission<span></span></div>
				<div class="filterBtn" id="rejectedFilterBtn">Rejected Admission<span></span></div>
				<div class="filterBtn" id="undecidedFilterBtn">Undecided Admission<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="completeFilterBtn">Registration Complete<span></span></div>
				<div class="filterBtn" id="incompleteFilterBtn">Registration Incomplete<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="activeRegFilterBtn">Active Registration<span></span></div>
				<div class="filterBtn" id="cancledRegFilterBtn">Cancled Registration<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="checkedInFilterBtn">Checked-in<span></span></div>
				<div class="filterBtn" id="notCheckedInFilterBtn">Not Checked-in<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="genderFemaleFilterBtn">Women<span></span></div>
				<div class="filterBtn" id="genderMaleFilterBtn">Men<span></span></div>
				<div class="filterBtn" id="genderXFilterBtn">X<span></span></div>
				<div class="filterBtn" id="genderUnknownFilterBtn">Unknown<span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="collegeCUFilterBtn">CU<span></span></div>
				<div class="filterBtn" id="collegeCOFilterBtn">CO<span></span></div>
				<div class="filterBtn" id="collegeUSFilterBtn">US<span></span></div>
				<div class="filterBtn" id="collegeWorldFilterBtn">World<span></span></div>
				<div class="filterBtn" id="collegeUnknownFilterBtn">Unknown<span></span></div>
			</div>
		</div>
			
		<div class="tabSectionWrapper">
		
			<div id="participantsDiv" class="peopleSection">
			
				<?php 
				$num = 1;
				foreach($participants as $personKey => $person) {
					// only print row if deleted is false
					if($person["deleted"] == 0) {
					?>
					
						<div class="person <?php 
							echo ($person["approved"] == 1) ? "approved " : ( ($person["approved"] == 0) ? "undecided " : "rejected ");
							echo ($person["complete"] == 1) ? "complete " : "incomplete ";
							echo ($person["unregistered"] == 1) ? "cancledReg " : "activeReg ";
							echo ($person["checked_in"] == 1) ? "checkedIn " : "notCheckedIn ";
							if($person["set_gender"] == 1) echo "genderFemale ";
							else if($person["set_gender"] == 2) echo "genderMale ";
							else if($person["set_gender"] == 3) echo "genderX ";
							else echo "genderUnknown ";
							if($person["set_college"] == 1) echo "collegeCU ";
							else if($person["set_college"] == 2) echo "collegeCO ";
							else if($person["set_college"] == 3) echo "collegeUS ";
							else if($person["set_college"] == 4) echo "collegeWorld ";
							else echo "collegeUnknown ";
						?>">
						
							<div class="beg">
								<div class="cell-name column4"><?php echo $person["name"]; ?></div>
								<div class="cell-email column4"><?php echo $person["email"]; ?></div>
								<div class="cell-gender column4">
									<?php 
									if($person["set_gender"] == 1) echo "Female"; 
									else if ($person["set_gender"] == 2) echo "Male"; 
									else if($person["set_gender"] == 3) echo "Other Gendered";
									?>
								</div>
							</div>
							
							<div class="status column12">
								<div class="cell-key"><?php echo $person["key"]; ?></div>
								<div class="cell-complete"><?php echo ($person["complete"] == 1) ? "Registration Complete" : "Registration Incomplete"; ?></div>
								<div class="cell-unregistered"><?php echo ($person["unregistered"] == 1) ? "Registration Canceled" : "Registration Active"; ?></div>
								<div class="cell-approved"><?php echo ($person["approved"] == 1) ? "Approved Admission" : ( ($person["approved"] == 0) ? "Undecided Admission" : "Rejected Admission"); ?></div>
								<div class="cell-checked-in"><?php echo ($person["checked_in"] == 1) ? "Checked-in" : "Not checked-in"; ?></div>
							</div>
							
							<div class="other">
								<div class="cell-phone column4">Phone: <?php echo $person["phone"]; ?></div>
								<div class="cell-college column4">College: <?php echo $person["college"]; ?></div>
								<div class="cell-major column4">Major: <?php echo $person["major"]; ?></div>
								
								<div class="cell-shirt column4">Shirt Size: <?php echo $person["shirt"]; ?></div>
								<div class="cell-company column4">Company: <?php echo $person["company"]; ?></div>
								<div class="cell-position column4">Position: <?php echo $person["position"]; ?></div>
								
								<div class="cell-linkedin column4"><?php echo ($person["linkedin"] == "") ? "No Linkedin" : "<a href='" . $person["linkedin"] . "' target='_blank'>" . $person["linkedin"] . "</a>"; ?></div>
								<div class="cell-resume column4"><?php echo ($person["resume"] == "") ? "No Resume" : "<a href='../hidden/resumes/" . $person["resume"] . "' target='_blank'>" . $person["resume"] . "</a>"; ?></div>
								<div class="cell-website column4"><?php echo ($person["website"] == "") ? "No Website" : "<a href='" . $person["website"] . "' target='_blank'>" . $person["website"] . "</a>"; ?></div>
								<div class="cell-github column4"><?php echo ($person["github"] == "") ? "No Github" : "<a href='" . $person["github"] . "' target='_blank'>" . $person["github"] . "</a>"; ?></div>
								<div class="cell-facebook column4"><?php echo ($person["facebook"] == "") ? "No Facebook" : "<a href='" . $person["facebook"] . "' target='_blank'>" . $person["facebook"] . "</a>"; ?></div>
								<div class="cell-twitter column4"><?php echo ($person["twitter"] == "") ? "No Twitter" : "<a href='" . $person["twitter"] . "' target='_blank'>" . $person["twitter"] . "</a>"; ?></div>
								
								<div class="cell-comment column12">Comments: <?php echo $person["comment"]; ?></div>
							</div>
							
							<div class="actionBtns column12">
								<form action="view.php" method="POST">
								
									<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
									<input type="hidden" name="type" value="1">
									
									<input type="hidden" name="action" class="actionAction" value="">
									
									<button type="submit" class="btn deleteBtn">Delete</button>
									
									<?php if($person["approved"] == 0 || $person["key"] == "P-cdyRYz") { ?>
										<button type="submit" class="btn approveBtn">Approve</i></button>
										<button type="submit" class="btn rejectBtn">Reject</i></button>
									<?php } else if($person["approved"] == 1) {?>
										<button type="submit" class="btn rejectBtn">Reject</i></button>
									<?php } ?>
									
									<?php if($person["checked_in"] == 0) { ?>
										<button type="submit" class="btn checkInBtn">Check-In</i></button>
									<?php } else { ?>
										<button type="submit" class="btn unCheckInBtn">Un-Check-In</i></button>
									<?php } ?>
									
									<?php if($person["unregistered"] == 0) { ?>
										<button type="submit" class="btn unregisterBtn">Cancel Registration</i></button>
									<?php } else { ?>
										<button type="submit" class="btn registerBtn">Activate Registration</i></button>
									<?php } ?>
									
									<?php if( ($person["complete"] == 0 && $person["reminder_num"] == 0) || $person["key"] == "P-cdyRYz" ) { ?>
										<button type="submit" class="btn reminderRegBtn">Reminder to complete Registration</i></button>
									<?php } ?>
									
									<br/>
									
									<?php if($person["set_gender"] == 0) { ?>
										<button type="submit" class="btn setFemaleBtn">Mark as Female</i></button>
										<button type="submit" class="btn setMaleBtn">Mark as Male</i></button>
										<button type="submit" class="btn setXBtn">Mark as X</i></button>
									<?php } ?>
									
									<?php if($person["set_college"] == 0) { ?>
										<button type="submit" class="btn setCUBtn">Mark as CU</i></button>
										<button type="submit" class="btn setCOBtn">Mark as CO</i></button>
										<button type="submit" class="btn setUSBtn">Mark as US</i></button>
										<button type="submit" class="btn setWorldBtn">Mark as World</i></button>
									<?php } ?>
									
								</form>
							</div>
							
						</div>
					<?php 
					}
					
					$num++;
				}
				?>
				
			</div>
			
			<div id="mentorsDiv" class="peopleSection">
				
				<?php 
				$num = 1;
				foreach($mentors as $personKey => $person) {
					// only print row if deleted is false
					if($person["deleted"] == 0) {
					?>
					
						<div class="person <?php 
							echo ($person["approved"] == 1) ? "approved " : ( ($person["approved"] == 0) ? "undecided " : "rejected ");
							echo ($person["complete"] == 1) ? "complete " : "incomplete ";
							echo ($person["unregistered"] == 1) ? "cancledReg " : "activeReg ";
							echo ($person["checked_in"] == 1) ? "checkedIn " : "notCheckedIn ";
							if($person["set_gender"] == 1) echo "genderFemale ";
							else if($person["set_gender"] == 2) echo "genderMale ";
							else if($person["set_gender"] == 3) echo "genderX ";
							else echo "genderUnknown ";
						?>">
						
							<div class="beg">
								<div class="cell-name column4"><?php echo $person["name"]; ?></div>
								<div class="cell-email column4"><?php echo $person["email"]; ?></div>
								<div class="cell-gender column3"><?php echo $person["gender"]; ?></div>
								<div class="cell-num column1"># <?php echo $num; ?></div>
							</div>
							
							<div class="status column12">
								<div class="cell-key"><?php echo $person["key"]; ?></div>
								<div class="cell-complete"><?php echo ($person["complete"] == 1) ? "Registration Complete" : "Registration Incomplete"; ?></div>
								<div class="cell-unregistered"><?php echo ($person["unregistered"] == 1) ? "Canceled Registration" : "Registration Active"; ?></div>
								<div class="cell-approved"><?php echo ($person["approved"] == 1) ? "Approved Admission" : ( ($person["approved"] == 0) ? "Undecided Admission" : "Rejected Admission"); ?></div>
								<div class="cell-checked-in"><?php echo ($person["checked_in"] == 1) ? "Checked-in" : "Not checked-in"; ?></div>
							</div>
							
							<div class="other">
								<div class="cell-phone column4">Phone: <?php echo $person["phone"]; ?></div>
								<div class="cell-company column4">Company: <?php echo $person["company"]; ?></div>
								<div class="cell-position column4">Position: <?php echo $person["position"]; ?></div>
								
								<div class="cell-shirt column4">Shirt Size: <?php echo $person["shirt"]; ?></div>
								<div class="cell-area column8">Area: <?php echo $person["area"]; ?></div>
								
								<div class="cell-dinner column4">Dinner: <?php echo ($person["dinner"] == 1) ? "Yes" : "No"; ?></div>
								<div class="cell-breakfast column4">Breakfast: <?php echo ($person["breakfast"] == 1) ? "Yes" : "No"; ?></div>
								<div class="cell-lunch column4">Lunch: <?php echo ($person["lunch"] == 1) ? "Yes" : "No"; ?></div>
								
								<div class="cell-comment column12">Comment: <?php echo $person["comment"]; ?></div>
							</div>
							
							<div class="actionBtns column12">
								<form class="actionBtn" action="view.php" method="POST">
								
									<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
									<input type="hidden" name="type" value="2">
									
									<input type="hidden" name="action" class="actionAction" value="">
									
									<button type="submit" class="btn deleteBtn">Delete</button>
									
									<?php if($person["approved"] == 0) { ?>
										<button type="submit" class="btn approveBtn">Approve</i></button>
										<button type="submit" class="btn rejectBtn">Reject</i></button>
									<?php } else if($person["approved"] == 1) {?>
										<button type="submit" class="btn rejectBtn">Reject</i></button>
									<?php } ?>
									
									<?php if($person["checked_in"] == 0) { ?>
										<button type="submit" class="btn checkInBtn">Check-In</i></button>
									<?php } else { ?>
										<button type="submit" class="btn unCheckInBtn">Un-Check-In</i></button>
									<?php } ?>
									
									<?php if($person["unregistered"] == 0) { ?>
										<button type="submit" class="btn unregisterBtn">Cancel Registration</i></button>
									<?php } else { ?>
										<button type="submit" class="btn registerBtn">Re-Activate Registration</i></button>
									<?php } ?>
									
									<br/>
									
									<?php if($person["set_gender"] == 0) { ?>
										<button type="submit" class="btn setFemaleBtn">Mark as Female</i></button>
										<button type="submit" class="btn setMaleBtn">Mark as Male</i></button>
										<button type="submit" class="btn setXBtn">Mark as X</i></button>
									<?php } ?>
									
								</form>
							</div>
							
						</div>
					<?php 
					}
					
					$num++;
				}
				?>
				
			</div>
			
			<div id="extrasDiv" class="peopleSection">
				<div class="column12">
					<a href="#" class="extraBtn">Extra</a>
				</div>
				<div class="column12 extraDiv" style="display: none;">
					<form action="view.php" method="POST">
						<textarea name="exeStmt" style="width: 100%;"></textarea>
						<input type="hidden" name="exe" value="1">
						<button type="submit" class="btn btn-med">Submit</button>
					</form>
				</div>
				
				<div class="column12">
					<div class="btn" id="turnOnEditing">Turn on editing</div>
				</div>
			</div>
		
		</div> <!-- end tabSectionWrapper -->
		
	<?php 
	}	// end if for session
	?>
	
	
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	
	<script>
	// show/hide tabs
	$("#participantsBtn").click(function(event){
		$(".peopleSection").hide();
		$("#participantsDiv").show();
		$(this).parent().children().removeClass("active");
		$(this).addClass("active");
		doCounters(true);
	});
	$("#mentorsBtn").click(function(event){
		$(".peopleSection").hide();
		$("#mentorsDiv").show();
		$(this).parent().children().removeClass("active");
		$(this).addClass("active");
		doCounters(false);
	});
	$("#extrasBtn").click(function(event){
		$(".peopleSection").hide();
		$("#extrasDiv").show();
		$(this).parent().children().removeClass("active");
		$(this).addClass("active");
		doCounters(true);
	});
	
	
	// filters
	$("#allFilterBtn").click(function(event){
		$(".person").show();
		$(".filterBtn").removeClass("active");
		$(this).addClass("active");
	});
	// approved, rejected, or undecided filters
	$("#approvedFilterBtn, #rejectedFilterBtn, #undecidedFilterBtn, " +
		"#completeFilterBtn, #incompleteFilterBtn, " +
		"#activeRegFilterBtn, #cancledRegFilterBtn, " +
		"#checkedInFilterBtn, #notCheckedInFilterBtn, " +
		"#genderFemaleFilterBtn, #genderMaleFilterBtn, #genderXFilterBtn, #genderUnknownFilterBtn, " + 
		"#collegeCUFilterBtn, #collegeCOFilterBtn, #collegeUSFilterBtn, #collegeWorldFilterBtn, #collegeUnknownFilterBtn").click(function(event){
		event.preventDefault();
		if($(this).hasClass("active")) {
			$(this).removeClass("active");
		} else {
			$(this).parent().children().removeClass("active");
			$(this).addClass("active");
		}
		toggleFilters();
	});

	function toggleFilters() {
		$(".person").show();
		
		if($("#approvedFilterBtn").hasClass("active"))		$(".rejected, .undecided").hide();
		if($("#rejectedFilterBtn").hasClass("active"))		$(".approved, .undecided").hide();
		if($("#undecidedFilterBtn").hasClass("active"))		$(".approved, .rejected").hide();

		if($("#completeFilterBtn").hasClass("active"))		$(".incomplete").hide();
		if($("#incompleteFilterBtn").hasClass("active"))	$(".complete").hide();

		if($("#activeRegFilterBtn").hasClass("active"))		$(".cancledReg").hide();
		if($("#cancledRegFilterBtn").hasClass("active"))	$(".activeReg").hide();

		if($("#checkedInFilterBtn").hasClass("active"))		$(".notCheckedIn").hide();
		if($("#notCheckedInFilterBtn").hasClass("active"))	$(".checkedIn").hide();

		if($("#genderFemaleFilterBtn").hasClass("active"))	$(".genderMale, .genderX, .genderUnknown").hide();
		if($("#genderMaleFilterBtn").hasClass("active"))	$(".genderFemale, .genderX, .genderUnknown").hide();
		if($("#genderXFilterBtn").hasClass("active"))		$(".genderFemale, .genderMale, .genderUnknown").hide();
		if($("#genderUnknownFilterBtn").hasClass("active"))	$(".genderFemale, .genderMale, .genderX").hide();

		if($("#collegeCUFilterBtn").hasClass("active"))		$(".collegeCO, .collegeUS, .collegeWorld, .collegeUnknown").hide();
		if($("#collegeCOFilterBtn").hasClass("active"))		$(".collegeCU, .collegeUS, .collegeWorld, .collegeUnknown").hide();
		if($("#collegeUSFilterBtn").hasClass("active"))		$(".collegeCU, .collegeCO, .collegeWorld, .collegeUnknown").hide();
		if($("#collegeWorldFilterBtn").hasClass("active"))	$(".collegeCU, .collegeCO, .collegeUS, .collegeUnknown").hide();
		if($("#collegeUnknownFilterBtn").hasClass("active"))$(".collegeCU, .collegeCO, .collegeUS, .collegeWorld").hide();
	}
	
	
	// counters
	doCounters(true);
	function doCounters(isParticipant) {
		var sectionDiv = (isParticipant) ? "#participantsDiv" : "#mentorsDiv";

		$("#allFilterBtn span").html( $(sectionDiv + " .person").size() );
		
		$("#approvedFilterBtn span").html( $(sectionDiv + " .approved").size() );
		$("#rejectedFilterBtn span").html( $(sectionDiv + " .rejected").size() );
		$("#undecidedFilterBtn span").html( $(sectionDiv + " .undecided").size() );

		$("#completeFilterBtn span").html( $(sectionDiv + " .complete").size() );
		$("#incompleteFilterBtn span").html( $(sectionDiv + " .incomplete").size() );

		$("#activeRegFilterBtn span").html( $(sectionDiv + " .activeReg").size() );
		$("#cancledRegFilterBtn span").html( $(sectionDiv + " .cancledReg").size() );

		$("#checkedInFilterBtn span").html( $(sectionDiv + " .checkedIn").size() );
		$("#notCheckedInFilterBtn span").html( $(sectionDiv + " .notCheckedIn").size() );

		$("#genderFemaleFilterBtn span").html( $(sectionDiv + " .genderFemale").size() );
		$("#genderMaleFilterBtn span").html( $(sectionDiv + " .genderMale").size() );
		$("#genderXFilterBtn span").html( $(sectionDiv + " .genderX").size() );
		$("#genderUnknownFilterBtn span").html( $(sectionDiv + " .genderUnknown").size() );

		$("#collegeCUFilterBtn span").html( $(sectionDiv + " .collegeCU").size() );
		$("#collegeCOFilterBtn span").html( $(sectionDiv + " .collegeCO").size() );
		$("#collegeUSFilterBtn span").html( $(sectionDiv + " .collegeUS").size() );
		$("#collegeWorldFilterBtn span").html( $(sectionDiv + " .collegeWorld").size() );
		$("#collegeUnknownFilterBtn span").html( $(sectionDiv + " .collegeUnknown").size() );
	}
	

	// action buttons
	$(".deleteBtn").click(function(event){
		var y = confirm("Are you sure you want to delete this record?  This is permanent.");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("delete");
	});
	$(".approveBtn").click(function(event){
		var y = confirm("Are you sure you want to approve this person? This will send an email to the person notifying them of this action.");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("approve");
	});
	$(".rejectBtn").click(function(event){
		var y = confirm("Are you sure you want to reject this person? This will send an email to the person notifying them of this action.");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("reject");
	});
	$(".checkInBtn").click(function(event){
		$(".actionAction").val("checkIn");
	});
	$(".unCheckInBtn").click(function(event){
		$(".actionAction").val("unCheckIn");
	});
	$(".unregisterBtn").click(function(event){
		var y = confirm("Are you sure you want to cancel this person's registeration?");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("unregister");
	});
	$(".registerBtn").click(function(event){
		var y = confirm("Are you sure you want to re-activate this person's registeration?");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("register");
	});
	$(".reminderRegBtn").click(function(event) {
		$(".actionAction").val("reminderReg");
	});

	$(".setFemaleBtn").click(function(event){
		$(".actionAction").val("setFemale");
	});
	$(".setMaleBtn").click(function(event){
		$(".actionAction").val("setMale");
	});
	$(".setXBtn").click(function(event){
		$(".actionAction").val("setX");
	});
	$(".setCUBtn").click(function(event){
		$(".actionAction").val("setCU");
	});
	$(".setCOBtn").click(function(event){
		$(".actionAction").val("setCO");
	});
	$(".setUSBtn").click(function(event){
		$(".actionAction").val("setUS");
	});
	$(".setWorldBtn").click(function(event){
		$(".actionAction").val("setWorld");
	});
	
	
	// extra
	$(".extraBtn").click(function(event){
		event.preventDefault();
		$(".extraDiv").slideToggle();
	});

	$("#turnOnEditing").click(function(event){ 
		event.preventDefault();
		$(".actionBtns").toggle();
	});
	</script>
	
	
</body>
</html>


