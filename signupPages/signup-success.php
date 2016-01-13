<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks - Sign-up</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php 
		$t = 1;
		if(array_key_exists("t", $_GET))
			$t = $_GET['t'];
		if($t != 1 && $t != 2)
			$t = 1;
		
		include "includes/css.php"; 
		css(true);
		facebookMeta($t);
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
						<h1>Sign-up for T9Hacks</h1>
						<p class="tagline">CU's first female hackathon!</p>
					</div>
				</div>
			</div>
			
		
			<div class="row signupTop" id="participantTop">
				<div class="signupWrapper">
				
					<div class="column12">
						<h1 class="blue">Success!</h1>
						<p>Thank you for registering for ATLAS T9Hacks.  Your confirmation will be send to your email.  We look forward to seeing you!</p>
						<br/>
						<br/>
						<a href="../index.php" class="btn btn-l"><i class="fa fa-arrow-circle-o-left"></i> &nbsp;Back to Home</a>
					</div>
					
					<div class="column12">
						<div class="fb-share-button" data-href="http://t9hacks.org/" data-layout="button_count"></div>
					</div>
					
				</div> <!-- end signupWrapper -->
			</div> <!-- end participantSignup -->
			
			
			
		</div>
	</section>
	
	
	
	<!-- Footer -->
	<?php include "../includes/footer.php"; footer(true); ?>
	
	
	<!-- Javascript -->
	<?php include "../includes/js.php"; js(true); ?>
	
	
</body>
</html>