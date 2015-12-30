<!DOCTYPE html>
<html>
<head>
	
	<title>T9Hacks - Database</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black; 
			padding: 2px 3px;
		}
	</style>
	
	<?php 
	include 'DBHelperClass.php';
	
	// create helper
	$db = new DBHelperClass();
	
	// get participants
	$participants = $db->getParticipants();
	
	// get mentors
	$mentors = $db->getMentors();
	
	// close helper
	$db->close();
	
	//echo '<pre>' . print_r($participants, true) . '</pre>';
	?>
	
</head>
<body>
	<h1>Participants</h1>
	<table>
		<thead>
			<tr>
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
		foreach($participants as $key => $p) {
			echo '<tr>';
			foreach($p as $k => $value) {
				echo '<td>' . $value . '</td>';
			}
			echo '</tr>';
		}
		?>
	</table>
	
	<h1>Mentors</h1>
	<table>
		<thead>
			<tr>
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
		foreach($mentors as $key => $p) {
			echo '<tr>';
			foreach($p as $k => $value) {
				echo '<td>' . $value . '</td>';
			}
			echo '</tr>';
		}
		?>
	</table>
	
	
</body>
</html>


