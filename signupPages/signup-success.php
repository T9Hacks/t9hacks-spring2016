<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks - Sign-up</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php 
		$isParticipant = true;
		if(array_key_exists("t", $_GET)) {
			$t = $_GET['t'];
			if($t == 4)
				$isParticipant = false;
		}
		
		include "../includes/css.php"; 
		css(true);
		if($isParticipant)
			facebookMeta(3);
		else
			facebookMeta(4);
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
						<br/>
						<ul class="shareBtns">
							<li>
								<div class="fb-share-button" data-href="http://t9hacks.org/" data-layout="button_count"></div>
							</li>
							<li>
								<?php
								if($isParticipant) { 
								?>
									<a href="https://twitter.com/intent/tweet?button_hashtag=T9Hacks&text=Just%20signed%20up%20for%20%40T9Hacks!%20A%20female%20creative%20technology%20hackathon%2C%20at%20%40cuatlas%20on%20Feb%2020-21" class="twitter-hashtag-button" data-related="T9Hacks" data-url="http://www.t9hacks.org">Tweet #T9Hacks</a>
								<?php 
								} else { 
								?>
									<a href="https://twitter.com/intent/tweet?button_hashtag=T9Hacks&text=Just%20signed%20up%20to%20mentor%20%40T9Hacks!%20A%20female%20creative%20technology%20hackathon%2C%20at%20%40cuatlas%20on%20Feb%2020-21" class="twitter-hashtag-button" data-related="T9Hacks" data-url="http://www.t9hacks.org">Tweet #T9Hacks</a>
								<?php 
								}
								?>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							</li>
						</ul>
						<a href="../index.php" class="btn btn-l"><i class="fa fa-arrow-circle-o-left"></i> &nbsp;Back to Home</a>
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