<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks - Sign-up</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php include "../includes/css.php"; css(true); ?>
	
	<?php 
		// get post data
		$numFriends = 0;
		// check if post data exists
		if(array_key_exists("n", $_GET)) {
			$n = $_GET['n'];
			// check if data is between 0 and 3
			if($n >= 0 && $n <= 3) {
				$numFriends = $n;
			}
		}
	?>
	
</head>
<body id="page-top" class="index hackathon">

	<!-- Navigation -->
	<?php include "../includes/nav-simple.php"; nav(true); ?>
	
	
	<section id="signup" class="bg-purple">
		<div class="container">
		
			<div class="row">
				<div class="column12">
					<div class="team-title">
						<h1>Sign-up for T9Hacks</h1>
					</div>
				</div>
			</div>
			
		
			<div class="row" id="participantTop">
				<div class="signupWrapper">
				
					<div class="row">
						<div class="column12">
							<h2>Participant Sign-up</h2>
						</div>
					</div>
					<div class="row">
						<div class="column12">
							<p>How many people are you registering for?</p>
						</div>
					</div>
					<div class="row">
						<div class="fieldWrapper column12 areas">
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="myself" type="radio" name="friends" value="0" <?php echo ($numFriends == 0 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself" data-tg-on="Myself" for="myself"></label>
							</div>
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="friend1" type="radio" name="friends" value="1" <?php echo ($numFriends == 1 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself and 1 Friend" data-tg-on="Myself and 1 Friend" for="friend1"></label>
							</div>
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="friend2" type="radio" name="friends" value="2"<?php echo ($numFriends == 2 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself and 2 Friends" data-tg-on="Myself and 2 Friends" for="friend2"></label>
							</div>
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="friend3" type="radio" name="friends" value="3"<?php echo ($numFriends == 3 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself and 3 Friends" data-tg-on="Myself and 3 Friends" for="friend3"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="fieldWrapper column12">
							<a href="../signup.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Back</a>
							<a href="signup-participant2.php?n=<?php echo $numFriends; ?>" class="btn btn-l right regBtn" id="participantRegBtn">Registration &nbsp;<i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
					
				</div> <!-- end signupWrapper -->
			</div> <!-- end participantSignup -->
			
			
			
		</div>
	</section>
	
	
	
	<!-- Footer -->
	<?php include "../includes/footer.php"; footer(true); ?>
	
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	<script src="../js/signup.js"></script>
	
	
</body>
</html>