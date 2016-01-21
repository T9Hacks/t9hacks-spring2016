<?php 

include 'DBHelperClass.php';

$isSession = false;

// check if session
if(array_key_exists("t9hacks_login", $_COOKIE) && $_COOKIE["t9hacks_login"] == 1) {
	
	// set session
	$isSession = true;
	
	// create helper
	$db = new DBHelperClass();
	
	// make submit
	// check if delete exists and is 1
	if(array_key_exists("delete", $_POST) && $_POST["delete"] == 1) {
	
		// check if id exists
		if(array_key_exists("id", $_POST)) {
			// get id
			$id = $_POST["id"];
			$type = $_POST["type"];
			
			// delete id
			$db->deleteRecord($id, $type);
			
			// close helper
			$db->close();
			
			// relocate to same page without post data
			header('Location: view.php');
			
		}
	}
	
	// check in person
	if(array_key_exists("checkIn", $_POST) && $_POST["checkIn"] == 1) {
	
		// check if id exists
		if(array_key_exists("id", $_POST)) {
			// get id
			$id = $_POST["id"];
			$type = $_POST["type"];
			
			// check in id
			$db->checkInRecord($id, $type);
			
			// close helper
			$db->close();
			
			// relocate to same page without post data
			header('Location: view.php');
			
		}
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
				<div class="filterBtn active" id="allFilterBtn">All</div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="approvedFilterBtn">Approved Admission</div>
				<div class="filterBtn" id="rejectedFilterBtn">Rejected Admission</div>
				<div class="filterBtn" id="undecidedFilterBtn">Undecided Admission</div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="completeFilterBtn">Registration Complete</div>
				<div class="filterBtn" id="incompleteFilterBtn">Registration Incomplete</div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="regFilterBtn">Registered</div>
				<div class="filterBtn" id="unregisteredFilterBtn">Cancled Registration</div>
			</div>
			<div class="filterGroup">
				<div class="filterBtn" id="checkedInFilterBtn">Checked-in</div>
				<div class="filterBtn" id="notCheckedInFilterBtn">Not Checked-in</div>
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
								<div class="cell-unregistered"><?php echo ($person["unregistered"] == 1) ? "Canceled Registration" : "Registration Active"; ?></div>
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
							
							<div class="changeBtns column12 hide">
								<div class="btn">Delete</div>
								<div class="btn">Approve</div>
								<div class="btn">Check-in</div>
								<div class="btn">Un-register</div>
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
							
							<div class="changeBtns column12 hide">
								<div class="btn">Delete</div>
								<div class="btn">Approve</div>
								<div class="btn">Check-in</div>
								<div class="btn">Un-register</div>
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
		toggleFilter(".peopleSection", "#participantsDiv", ".tabBtn", "#participantsBtn")
	});
	$("#mentorsBtn").click(function(event){
		toggleFilter(".peopleSection", "#mentorsDiv", ".tabBtn", "#mentorsBtn");
	});
	$("#extrasBtn").click(function(event){
		toggleFilter(".peopleSection", "#extrasDiv", ".tabBtn", "#extrasBtn");
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
	
	
    $(".deleteBtn").click(function(event){
    	//event.preventDefault();
		var y = confirm("Are you sure you want to delete this record?  This is permanent.");
		if(!y)
			event.preventDefault();
	});

    $(".extraBtn").click(function(event){
	    event.preventDefault();
	    $(".extraDiv").slideToggle();
    });
	</script>
	
	
	
	</script>	
	
	 
	
</body>
</html>


