<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks - Sign Up</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php 
		include "../includes/css.php"; 
		css(true);
		facebookMeta(4);
	?>
	
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
	
	
	<section id="signup" class="bg-trianglePurple">
		<div class="container">
		
			<div class="row">
				<div class="column12">
					<div class="signupTitle">
						<h1>Sign Up for T9Hacks</h1>
					</div>
				</div>
			</div>
			
		
			<div class="row" id="participantTop">
				<div class="signupWrapper">
				
					<div class="row">
						<div class="column12">
							<h2>Mentor Sign Up</h2>
							<p>20-21 February 2016</p>
						</div>
					</div>
					<div class="row">
						<p class="column12">
							If you are planning on attending T9Hacks, we kindly ask you to register.  This allows us to keep track of 
							tickets to make sure that we can provide enough space, food, and supplies for everyone.
						</p>
						<p class="column12">
							We require that mentors be present for at least 2 hours during the hackathon.  For more specific 
							information about mentorship at T9Hacks, please visit our <a href="../documents/T9Hacks_MentorGuide.pdf" target="_blank">Mentor Guide</a>.
						</p>
						<div class="column12">
							<p>How many people are you registering for?</p>
						</div>
					</div>
					<div class="row">
						<div class="fieldWrapper column12 colleagues">
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="myself" type="radio" name="friends" value="0" <?php echo ($numFriends == 0 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself" data-tg-on="Myself" for="myself"></label>
							</div>
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="friend1" type="radio" name="friends" value="1" <?php echo ($numFriends == 1 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself and 1 Colleague" data-tg-on="Myself and 1 Colleague" for="friend1"></label>
							</div>
							<div class="fieldRadio">
								<input class="tgl tgl-flip" id="friend2" type="radio" name="friends" value="2"<?php echo ($numFriends == 2 ) ? "checked='checked'" : ""; ?> >
   								<label class="tgl-btn" data-tg-off="Myself and 2 Colleagues" data-tg-on="Myself and 2 Colleagues" for="friend2"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="fieldWrapper column12">
							<a href="../signup.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Back</a>
							<a href="signup-mentor2.php?n=<?php echo $numFriends; ?>" class="btn btn-l right regBtn" id="mentorRegBtn">Registration &nbsp;<i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
					
				</div> <!-- end signupWrapper -->
			</div> <!-- end mentorSignup -->
			
			
			
		</div>
	</section>
	
	
	
	<!-- Footer -->
	<?php include "../includes/footer.php"; footer(true); ?>
	
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	<script src="../js/signup.js"></script>
	
	
</body>
</html>