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
				"genericInfo"	=> array("college", "major", "linkedin", "resume", "website", "github", "company", "position", "facebook", "twitter", "shirt","comment"),
			), 
			array(
				"name"			=> "Mentors",
				"data"			=> $mentors,
				"genericInfo"	=> array("company", "position", "dinner", "breakfast", "lunch", "area", "shirt", "comment"),
			)
		);
		
		
		foreach($allPeople as $peopleKey => $people) {
			?>
			<div class="row peopleSection">
			
				<h1><?php echo $people["name"]; ?></h1>
				
				<table id="" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Gender</th>
							<th>Key</th>
							<th>Complete</th>
							<th>Unregistered</th>
							<th>Approved</th>
							<th>Checked-In</th>
							<?php 
							foreach($people["genericInfo"] as $columnKey => $column) {
								if($column == "comment")
									echo "<th style='width: 500px !important; display: inline-block;'>$column</th>";
								else
									echo "<th>$column</th>";
							}
							?>
						</tr>
					</thead>
					
					<tbody>
					<?php 
					$num = 1;
					foreach($people["data"] as $personKey => $person) {
						// only print row if deleted is false
						if($person["deleted"] == 0) {
						?>
							<tr>
								<td><?php echo $num; ?></td>
								<td><?php echo $person["name"]; ?></td>
								<td><?php echo $person["email"]; ?></td>
								<td><?php echo $person["phone"]; ?></td>
								<td><?php echo $person["gender"]; ?></td>
								<td><?php echo $person["key"]; ?></td>
								<td><?php echo $person["complete"]; ?></td>
								<td><?php echo $person["unregistered"]; ?></td>
								<td><?php echo $person["approved"]; ?></td>
								<td><?php echo $person["checked_in"]; ?></td>
								<?php 
								foreach($people["genericInfo"] as $columnKey => $column) {
									echo "";
									if( $column == "linkedin" || $column == "website" || $column == "github" || $column == "facebook" || $column == "twitter" )
										echo "<td><a href='" . $person[$column] . "' target='_blank'>" . $person[$column] . "</a></td>";
									else if($column == "resume")
										echo "<td><a href='../hidden/resumes/" . $person[$column] . "' target='_blank'>" . $person[$column] . "</a></td>";
									else if($column == "comment") {
										echo "<td style='width: 500px !important; display: inline-block;'>" . $person[$column] . "</td>";
									} else
										echo "<td>".$person[$column]."</td>";
								}
								?>
							</tr>
						<?php 
						}
						
						$num++;
					}
					?>
					</tbody>
				</table>
			</div>
		<?php
		}
	}
	?>
	
	<div class="row">
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
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	
	<script>
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
	
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.0.0/css/responsive.dataTables.css"/>
	 
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.0.0/js/dataTables.responsive.js"></script>
	
	<script>
	$(document).ready(function() {
	    $('table.display').DataTable({
	        "scrollX": true,
	        "scrollY": 500,
	        "paging":   false,
	        "info":     false
	    });
	} );
	</script>	
	
	</div>
</body>
</html>


