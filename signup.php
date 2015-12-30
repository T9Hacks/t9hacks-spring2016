<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks - Sign-up</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php include "includes/css.php"; css(); ?>
	
</head>
<body id="page-top" class="index hackathon">

	<!-- Navigation -->
	<?php include "includes/nav-simple.php"; nav(); ?>
	
	
	<section class="bg-trianglePurple">
		<div class="container">
		
			<div class="row">
				<div class="column12">
					<div class="team-title">
						<h1>Sign-up for T9Hacks</h1>
					</div>
				</div>
			</div>
			<?php if(true) { ?>
			<div class="row" id="signupWait">
				<div class="signupWrapper">
				<div class="column12">
					<div class="waitMessage">
						<p>Thank you for your interest in T9Hacks!  We will begin the registration process on Jan 1, 2016.</p>
						<br/>
						<br/>
						<a href="index.php" class="btn btn-l">Back to Website</a>
					</div>
				</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row" id="signupChoice">
				<div class="signupWrapper">	
					<div class="row">			
						<p class="column12">
							If you are planning on attending T9Hacks, we kindly ask you to register.  This lets allows us to keep track of 
							tickets to make sure that we can provide enough space, food, and supplies for everyone.
						</p>
						<p class="column12 text-bold">
							You can register yourself and your friends and colleagues here!
						</p>
					</div>
					<div class="row">	
						<p class="column4">
							If you are a student, click here:
						</p>	
						<div class="column8 btnHolder"><a href="signupPages/signup-participant1.php" class="btn btn-xl">Register as a participant</a></div>
					
					</div>
					<div class="row">	
						<p class="column4">
							If you are an external volunteer, click here:
						</p>
						<div class="column8 btnHolder"><a href="signupPages/signup-mentor1.php" class="btn btn-xl">Sign-up as a mentor</a></div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
	
	
	<!-- Footer -->
	<?php include "includes/footer.php"; footer(); ?>
	
	
	<!-- Javascript -->
	<?php include "includes/js.php"; js();	 ?>
	
	
</body>
</html>