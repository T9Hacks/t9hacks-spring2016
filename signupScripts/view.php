<?php 
include 'DBHelperClass.php';

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
		
		header('Location: view.php');
		
	}
}

// get participants
$participants = $db->getParticipants();

// get mentors
$mentors = $db->getMentors();

// close helper
$db->close();

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
	<h1>Participants</h1>
	<table>
		<thead>
			<tr>
				<th>Delete</th>
				<th>ID</th>
				<th>Key</th>
				<th>Name</th>
				<th>Email</th>
				<th>College</th>
				<th>Major</th>
				<th>Phone</th>
				<th>Linkedin</th>
				<th>Resume</th>
				<th>Website</th>
				<th>Github</th>
				<th>Company</th>
				<th>Position</th>
				<th>Facebook</th>
				<th>Twitter</th>
				<th>Shirt</th>
				<th>Date</th>
				<th>Complete</th>
			</tr>
		</thead>
		<?php 
		foreach($participants as $key => $participant) {
			if($participant["deleted"] == 0) {
				?>
				<tr>
					<td>
						<form action="view.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $participant["id"]; ?>">
							<input type="hidden" name="delete" value="1">
							<input type="hidden" name="type" value="1">
							<button type="submit" class="deleteBtn"><i class="fa fa-remove"></i></button>
						</form>
					</td>
					<?php 
					foreach($participant as $k => $value) {
						if($k != "deleted")
							echo '<td>' . $value . '</td>';
					}
				echo '</tr>';
			}
		}
		?>
	</table>
	
	<h1>Mentors</h1>
	<table>
		<thead>
			<tr>
				<th>Delete</th>
				<th>ID</th>
				<th>Key</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Company</th>
				<th>Position</th>
				<th>Breakfast</th>
				<th>Lunch</th>
				<th>Dinner</th>
				<th>Area Web Design</th>
				<th>Area Web Dev</th>
				<th>Area Android</th>
				<th>Area iOS</th>
				<th>Area UI/UX</th>
				<th>Area Gaming</th>
				<th>Area Print Media</th>
				<th>Area Arduino</th>
				<th>Date</th>
				<th>Complete</th>
			</tr>
		</thead>
		<?php 
		foreach($mentors as $key => $mentor) {
			if($mentor["deleted"] == 0) {
				?>
				<tr>
					<td>
						<form action="view.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $mentor["id"]; ?>">
							<input type="hidden" name="delete" value="1">
							<input type="hidden" name="type" value="2">
							<button type="submit" class="deleteBtn"><i class="fa fa-remove"></i></button>
						</form>
					</td>
					<?php
					foreach($mentor as $k => $value) {
						if($k != "deleted")
							echo '<td>' . $value . '</td>';
					}
					echo '</tr>';
			}
		}
		?>
	</table>
	
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


