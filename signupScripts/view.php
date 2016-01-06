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
	
	<style>
		html, body {
			background: white; 
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black; 
			padding: 2px 3px;
		}
	</style>
	
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

		$allPeople = array("Participants" => $participants, "Mentors" => $mentors);
		
		foreach($allPeople as $name => $peopleArray) {
			?>
			<h1><?php echo $name; ?></h1>
			<table>
				<?php 
				$printedHeaders = false;
				foreach($peopleArray as $key => $person) {
					// print headers
					if(!$printedHeaders) {
						echo "<thead><tr>";
						echo "<th class='action'>Delete</th>";
						echo "<th class='action'>Check-in</th>";
						foreach($person as $k => $value) {
							if($k != "deleted") 
								echo "<th>" . $k . "</th>"; 
						}
						echo "</tr></thead>";
						$printedHeaders = true;
					}
					
					// only print row if deleted is false
					if($person["deleted"] == 0) {
						?>
						<tr>
							<td>
								<form action="view.php" method="POST">
									<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
									<input type="hidden" name="delete" value="1">
									<input type="hidden" name="type" value="<?php echo ($name == "Participants") ? 1 : 2; ?>">
									<button type="submit" class="deleteBtn"><i class="fa fa-remove"></i></button>
								</form>
							</td>
							<td>
								<form action="view.php" method="POST">
									<input type="hidden" name="id" value="<?php echo $person["id"]; ?>">
									<input type="hidden" name="checkIn" value="1">
									<input type="hidden" name="type" value="<?php echo ($name == "Participant") ? 1 : 2; ?>">
									<button type="submit" class="checkInBtn"><i class="fa fa-check"></i></button>
								</form>
							</td>
							<?php 
							foreach($person as $k => $value) {
								if($k != "deleted") {
									if( $k == "linkedin" || $k == "website" || $k == "github" || $k == "facebook" || $k == "twitter" )
										echo "<th><a href='" . $value . "' target='_blank'>" . $value . "</a></th>";
									else if($k == "resume")
										echo "<th><a href='../hidden/resumes/" . $value . "' target='_blank'>" . $value . "</a></th>";
									else
										echo '<td>' . $value . '</td>';
								}
							}
							?>
						</tr>
						<?php 
					} // end if for deleted
					
				} // end foreach
				?>
			</table>
			
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
	
	
</body>
</html>


