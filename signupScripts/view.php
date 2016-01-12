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
	<div class="container12">

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

		$allPeople = array(
			array(
				"name"			=> "Participants",
				"data"			=> $participants,
				"genericInfo"	=> array("gender", "college", "major", "linkedin", "resume", "website", "github", "company", "position", "facebook", "twitter", "shirt", "comment"),
			), 
			array(
				"name"			=> "Mentors",
				"data"			=> $mentors,
				"genericInfo"	=> array("gender", "company", "position", "dinner", "breakfast", "lunch", "area", "comment"),
			)
		);
		
		
		foreach($allPeople as $peopleKey => $people) {
			?>
			<div class="row peopleSection">
			<h1><?php echo $people["name"]; ?></h1>
				<?php 
				$num = 1;
				foreach($people["data"] as $personKey => $person) {
					
					// only print row if deleted is false
					if($person["deleted"] == 0) {
						?>
						<div class="person">
						
							<div class="basicInfo">
								<span class="column6">Name: <b><?php echo $person["name"]; ?></b></span>
								<span class="column6">Email: <b><?php echo $person["email"]; ?></b></span>
								<span class="column6">Phone: <b><?php echo $person["phone"]; ?></b></span>
								<span class="num">#<?php echo $num; ?></span>
							</div>
							
							<div class="remainingInfo">
								<?php 
								foreach($people["genericInfo"] as $columnKey => $column) {
									echo "<span class='column6'>$column: <b>";
									if( $column == "linkedin" || $column == "website" || $column == "github" || $column == "facebook" || $column == "twitter" )
										echo "<a href='" . $person[$column] . "' target='_blank'>" . $person[$column] . "</a>";
									else if($column == "resume")
										echo "<a href='../hidden/resumes/" . $person[$column] . "' target='_blank'>" . $person[$column] . "</a>";
									else
										echo $person[$column];
									echo "</b></span>";
								}
								?>
							</div>
					
							<?php if(false) { ?>
								<div class="actionBtns">
									
									<div class="column3">
										<form action="view.php" method="POST">
											<span>Delete Person: </span>
											<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
											<input type="hidden" name="delete" value="1">
											<input type="hidden" name="type" value="<?php echo ($name == "Participants") ? 1 : 2; ?>">
											<button type="submit" class="deleteBtn"><i class="fa fa-remove"></i></button>
										</form>
									</div>
									
									<div class="column3">
										<form action="view.php" method="POST">
											<span>Check-in Person: </span>
											<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
											<input type="hidden" name="checkIn" value="1">
											<input type="hidden" name="type" value="<?php echo ($name == "Participant") ? 1 : 2; ?>">
											<button type="submit" class="checkInBtn"><i class="fa fa-check"></i></button>
										</form>
									</div>
								</div>
							<?php } ?>
							
						</div>
						<?php 
						
					$num++;
					} // end if for deleted
					
				} // end foreach
				?>
			</div>
			
		<?php
		}
	}
	?>
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	
	<script>
	    $(".deleteBtn").click(function(event){
	    	//event.preventDefault();
			var y = confirm("Are you sure you want to delete this record?  This is permanent.");
			if(!y)
				event.preventDefault();
		});
	</script>
	
	</div>
</body>
</html>


