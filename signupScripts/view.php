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
				<div class="filterBtn active" id="allFilterBtn">All <span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="approvedFilterBtn">Approved Admission <span></span></div>
				<div class="filterBtn" id="rejectedFilterBtn">Rejected Admission <span></span></div>
				<div class="filterBtn" id="undecidedFilterBtn">Undecided Admission <span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="completeFilterBtn">Registration Complete <span></span></div>
				<div class="filterBtn" id="incompleteFilterBtn">Registration Incomplete <span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="regFilterBtn">Registered <span></span></div>
				<div class="filterBtn" id="unregisteredFilterBtn">Cancled Registration <span></span></div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="checkedInFilterBtn">Checked-in <span></span></div>
				<div class="filterBtn" id="notCheckedInFilterBtn">Not Checked-in <span></span></div>
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
							echo ($person["unregistered"] == 1) ? "unregistered " : "reg ";
							echo ($person["checked_in"] == 1) ? "checkedIn " : "notCheckedIn ";
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
								
								<div class="cell-linkedin column4"><?php echo ($person["linkedin"] == "") ? "No Linkedin" : $person["linkedin"]; ?></div>
								<div class="cell-resume column4"><?php echo ($person["resume"] == "") ? "No Resume" : $person["resume"]; ?></div>
								<div class="cell-website column4"><?php echo ($person["website"] == "") ? "No Website" : $person["website"]; ?></div>
								<div class="cell-github column4"><?php echo ($person["github"] == "") ? "No Github" : $person["github"]; ?></div>
								<div class="cell-facebook column4"><?php echo ($person["facebook"] == "") ? "No Facebook" : $person["facebook"]; ?></div>
								<div class="cell-twitter column4"><?php echo ($person["twitter"] == "") ? "No Twitter" : $person["twitter"]; ?></div>
								
								<div class="cell-comment column12">Comments: <?php echo $person["comment"]; ?></div>
							</div>
							
							<div class="actionBtns column12">
								<form class="actionBtn" action="view.php" method="POST">
								
									<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
									<input type="hidden" name="type" value="1">
									
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
										<button type="submit" class="btn registerBtn">Activate Registration</i></button>
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
							echo ($person["unregistered"] == 1) ? "unregistered " : "reg ";
							echo ($person["checked_in"] == 1) ? "checkedIn " : "notCheckedIn ";
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
		toggleFilter(".peopleSection", "#participantsDiv", ".tabBtn", "#participantsBtn");
		doCounters(true);
	});
	$("#mentorsBtn").click(function(event){
		toggleFilter(".peopleSection", "#mentorsDiv", ".tabBtn", "#mentorsBtn");
		doCounters(false);
	});
	$("#extrasBtn").click(function(event){
		toggleFilter(".peopleSection", "#extrasDiv", ".tabBtn", "#extrasBtn");
		doCounters(true);
	});
	
	
	// filters
	$("#allFilterBtn").click(function(event){
		toggleFilter("", ".person", ".filterBtn", "#allFilterBtn");
	});
	$("#approvedFilterBtn").click(function(event){
		toggleFilter(".person", ".approved", ".filterBtn", "#approvedFilterBtn");
	});
	$("#rejectedFilterBtn").click(function(event){
		toggleFilter(".person", ".rejected", ".filterBtn", "#rejectedFilterBtn");
	});
	$("#undecidedFilterBtn").click(function(event){
		toggleFilter(".person", ".undecided", ".filterBtn", "#undecidedFilterBtn");
	});
	$("#completeFilterBtn").click(function(event){
		toggleFilter(".person", ".complete", ".filterBtn", "#completeFilterBtn");
	});
	$("#incompleteFilterBtn").click(function(event){
		toggleFilter(".person", ".incomplete", ".filterBtn", "#incompleteFilterBtn");
	});
	$("#unregisteredFilterBtn").click(function(event){
		toggleFilter(".person", ".unregistered", ".filterBtn", "#unregisteredFilterBtn");
	});
	$("#regFilterBtn").click(function(event){
		toggleFilter(".person", ".reg", ".filterBtn", "#regFilterBtn");
	});
	$("#checkedInFilterBtn").click(function(event){
		toggleFilter(".person", ".checkedIn", ".filterBtn", "#checkedInFilterBtn");
	});
	$("#notCheckedInFilterBtn").click(function(event){
		toggleFilter(".person", ".notCheckedIn", ".filterBtn", "#notCheckedInFilterBtn");
	});

	function toggleFilter(divHide, divShow, tabClass, tabActive) {
		$(divHide).hide();
		$(divShow).show();
		$(tabClass).removeClass("active");
		$(tabActive).addClass("active");
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

		$("#unregisteredFilterBtn span").html( $(sectionDiv + " .unregistered").size() );
		$("#regFilterBtn span").html( $(sectionDiv + " .reg").size() );

		$("#checkedInFilterBtn span").html( $(sectionDiv + " .checkedIn").size() );
		$("#notCheckedInFilterBtn span").html( $(sectionDiv + " .notCheckedIn").size() );
	}
	
	$("#participantsDiv .person")
	

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
		var y = confirm("Are you sure you want to cancel this person's registeration?");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("checkIn");
	});
	$(".unCheckInBtn").click(function(event){
		var y = confirm("Are you sure you want to activate this person's registeration?");
		if(!y) event.preventDefault();
		else  $(".actionAction").val("unCheckIn");
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
	
	
	// extra
	$(".extraBtn").click(function(event){
		event.preventDefault();
		$(".extraDiv").slideToggle();
	});
	</script>
	
	
</body>
</html>


