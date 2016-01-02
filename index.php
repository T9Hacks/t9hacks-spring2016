<!DOCTYPE html>
<html>
<head>

	<title>T9Hacks</title>

	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<?php include "includes/css.php"; css(); ?>

    <link rel="stylesheet" type="text/css" href="css/demo.css">

	
</head>
<body id="page-top" class="index hackathon">

	<!-- Navigation -->
	<nav class="navbar navbar-fixed-top">
		<div class="container">

			<!-- Brand -->
			<div class="navbar-header page-scroll">
				<a class="navbar-brand page-scroll" href="#page-top">T9Hacks</a>
			</div>
			
			<!-- Mobile nav button -->
			<div class="navbar-right" data-toggle="collapse" data-target="#navbar">
				<button type="button" class="navbar-toggle btn btn-l">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="navbar-collapse collapse" id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="page-scroll" href="#questions">About</a></li>
					<li><a class="page-scroll" href="#join">Join</a></li>
					<li><a class="page-scroll" href="#schedule">Schedule</a></li>
					<li><a class="page-scroll" href="#sponsors">Sponsors</a></li>
				</ul>
			</div>

		</div>
	</nav>




	<!-- Header -->
	<header id="header" class="bg-medPurple">

		<canvas id="header-canvas"></canvas>

		<div id="header-container" class="container">

			<div class="hack-header">

				<div class="row">
					<div class="column12">
						<img class="logo" src="images/t9hacks_logo_transparent.png" />
					</div>
				</div>


				<div class="countdown" data-border-color="rgba(255, 255, 255, .8)">
			        <div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3">
		                <div class="inner">
		                    <div id="canvas-days" class="clock-canvas"></div>

		                    <div class="text">
		                        <p class="type-days type-time">DAYS</p>
		                        <p class="val">0</p>
		                    </div><!-- /.text -->
		                </div><!-- /.inner -->
			        </div><!-- /.clock-item -->

			        <div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3">
		                <div class="inner">
		                    <div id="canvas-hours" class="clock-canvas"></div>

		                    <div class="text">
		                        <p class="type-hours type-time">HOURS</p>
		                        <p class="val">0</p>
		                    </div><!-- /.text -->
		                </div><!-- /.inner -->
			        </div><!-- /.clock-item -->

			        <div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
		                <div class="inner">
		                    <div id="canvas-minutes" class="clock-canvas"></div>

		                    <div class="text">
		                        <p class="type-minutes type-time">MINUTES</p>
		                        <p class="val">0</p>
		                    </div><!-- /.text -->
		                </div><!-- /.inner -->
			        </div><!-- /.clock-item -->

 			        <div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
		                <div class="inner">
		                    <div id="canvas-seconds" class="clock-canvas"></div>

		                    <div class="text">
		                        <p class="type-seconds type-time">SECONDS</p>
		                        <p class="val">0</p>
		                    </div>
		                </div>
			        </div>
				</div><!-- /.countdown-wrapper -->







				<div class="row">
					<div class="column12">
						<p><span class="fa fa-clock-o"></span>&nbsp;&nbsp;20-21 February 2016</p>
						<p><span class="fa fa-map-marker"></span>&nbsp;&nbsp;ATLAS Institute, University of Colorado Boulder</p>
						<p><span class="fa fa-location-arrow"></span>&nbsp;&nbsp;Black Box Experimental Studio</p>
					</div>
				</div>

				<div class="row">
					<div class="column12">
						<p><a href="#questions" class="page-scroll btn btn-circle"><i class="down fa fa-angle-double-down"></i></a></p>
					</div>
				</div>

			</div>

		</div>

	</header>


	<!-- Questions Section -->
	<section id="questions" class="bg-cream">

		<div class="container">

			<div class="row">
				<div class="column12">
					<h1 class="blue">About Us</h1>
				</div>
			</div>

			<div class="row">
				<div class="column12">
					<p>
						T9Hacks is a 24 hour hackathon at the University of Colorado Boulder's ATLAS Institute 
						that brings together students for a day of creativity, building, and hacking.
						Our goals this upcoming spring is to increase participation of women in hackathons and to create an opportunity for 
						students to explore new technologies, solve problems, and create something amazing with a 
						team. Women occupy only 26% of IT positions and 18% of engineering majors in universities, and we want to help raise
						those numbers!
					</p>
				</div>
			</div>

			<div class="row">
				<div class="column6 faq">
					<i class="faq-icon fa fa-code"></i>
					<div class="faq-question">
						<h2>Do I have to be a programmer?</h2>
						<p>
							Absolutely not!  We encourage women with all backgrounds to participate.  It doesn't matter
							if you are an artist, a journalist, or a programmer, there is a place for you here.
						</p>
					</div>
				</div>
				<div class="column6 faq">
					<i class="faq-icon fa fa-code-fork"></i>
					<div class="faq-question">
						<h2>What is "hacking"?</h2>
						<p>
							"Hacking" doesn't mean malicious programming or breaking into something.  We want you to "hack" 
							(create, build, combine, MacGyver) technology, art, and media together to create something awesome.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column6 faq">
					<i class="faq-icon fa fa-ticket"></i>
					<div class="faq-question">
						<h2>How much does it cost?</h2>
						<p>
							Participating is completely free! We will provide food, snacks, and drinks to energize you throughout the day.
						</p>
					</div>
				</div>
				<div class="column6 faq">
					<i class="faq-icon fa fa-laptop"></i>
					<div class="faq-question">
						<h2>What do I have to bring?</h2>
						<p>
							Bring your laptop, phone, chargers, a well-rested open mind, but most of all, your creativity.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column6 faq">
					<i class="faq-icon fa fa-group"></i>
					<div class="faq-question">
						<h2>Do I have to have a team to register?</h2>
						<p>
							Nope!  T9Hacks is a great place to meet new people with different skillsets.  You can come with a 
							pre-formed group and idea, an idea of your own and no team, or have a desire to help someone else's idea along.  
						</p>
					</div>
				</div>
				
			</div>

		</div>

	</section>



	<!-- Join Section -->
	<section id="join" class="bg-image bg-signup">
		<div class="container">
			<div class="column12">
				<div class="row">
					<h1 class="white">Let's build something together!</h1>
					<div class="signupBtn">
						<a href="signup.php" class="btn btn-xl">Sign Up &nbsp; <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>



	<!-- Schedule Section -->
	<section id="schedule" class="bg-trianglePurple">
		<div class="container">

			<div class="row">
				<div class="column12">
					<h1>Schedule</h1>
				</div>
			</div>

			<div class="row">
				<div class="scheduleOuter"><div class="scheduleInner">
					<div class="scheduleSection">
						<h2 class="white">Saturday, February 20</h2>
						<div class="times">
							<p><i class="fa fa-th-list"></i> 3:00pm</p>
							<p><i class="fa fa-quote-left"></i> 3:30pm</p>
							<p><i class="fa fa-battery-full"></i> 4:00pm</p>
							<p><i class="fa fa-cutlery"></i> 6:30pm</p>
							<p><i class="fa fa-star"></i> 8:00pm</p>
							<p><i class="fa fa-star"></i> 11:00pm</p>
							<p><i class="fa fa-cutlery"></i> 12:00am</p>
						</div>
						<div class="events">
							<p>Check-in Starts</p>
							<p>Opening Ceremonies</p>
							<p>Hacking Begins</p>
							<p>Dinner</p>
							<p>Mini Challenge #1</p>
							<p>Mini Challenge #2</p>
							<p>Snack</p>
						</div>
					</div>
					<div class="scheduleSection">
						<h2 class="white">Sunday, February 22</h2>
						<div class="times">
							<p><i class="fa fa-coffee"></i> 9:00am</p>
							<p><i class="fa fa-star"></i> 10:00am</p>
							<p><i class="fa fa-cutlery"></i> 12:30pm</p>
							<p><i class="fa fa-battery-empty"></i> 4:00pm</p>
							<p><i class="fa fa-trophy"></i> 4:30pm</p>
							<p><i class="fa fa-quote-right"></i> 5:30pm</p>
						</div>
						<div class="events">
							<p>Breakfast</p>
							<p>Mini Challenge #3</p>
							<p>Lunch</p>
							<p>Hacking Ends</p>
							<p>Presentations</p>
							<p>End Ceremonies</p>
						</div>
					</div>
				</div></div>
			</div>

		</div>
	</section>



	<!-- Sponsors Section -->
	<section id="sponsors" class="bg-cream">
		<div class="container">

			<div class="row">
				<div class="column12">
					<h1 class="blue">Our Sponsors</h1>
				</div>
			</div>

			<div class="row">
				<div class="column4 sponsor">&nbsp;</div>
				<div class="column4 sponsor">
					<div class="sponsor1 atlas">
						<img src="images/sponsors/ATLAS-transparent.png" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="column12">
					<div class="sponsorInterested">
						<div class="sponsorBtnContainer">
							<div class="btn btn-xl" id="sponsorEmailBtn">Interested in <span class="mobileOnly">&nbsp;</span>becoming a sponsor?</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="sponsorEmailDiv" class="row">
				<div class="column2">&nbsp;</div>
				<div class="column8">
				
					<div id="sponsorEmailOuterForm">
					
						<div id="sponsorEmailArrow"></div>
						
						<form id="sponsorEmailForm" action="signupScripts/email.php">
							
							<div id="sponsorEmailResult">Null</div>
							
							<div class="row">
								<div class="fieldWrapper column6">
									<div class="fieldInput"><i class="fa fa-user"></i><input type="text" placeholder="Your Name" name="name" id="sponsorName"/></div>
								</div>
								<div class="fieldWrapper column6">
									<div class="fieldInput"><i class="fa fa-envelope-o"></i><input type="text" placeholder="Your Email" name="email" id="sponsorEmail"/></div>
								</div>
							</div>
							<div class="row">
								<div class="fieldWrapper column12">
									<div class="fieldInput"><i class="fa fa-pencil-square-o"></i><input type="text" placeholder="Subject" name="subject" id="sponsorSubject"/></div>
								</div>
							</div>
							<div class="row">
								<div class="fieldWrapper column12">
									<div class="fieldInput textarea">
										<textarea name="message" placeholder="Message" id="sponsorMessage"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="fieldWrapper column12">
									<button id="sponsorEmailSubmit" class="btn btn-l right">Send &nbsp;<i class="fa fa-arrow-circle-o-right"></i></button>
								</div>
							</div>
						</form>
						
						<div id="sponsorEmailSuccess">
							<h3>Email successfully sent!</h3>
							<p>Thank you for contacting us, we'll get back to you shortly.</p>
						</div>
					
					</div>
					
				</div>
			</div>
			
		</div>
	</section>



	<!-- Info Section -->
	<section id="info" class="bg-grey">
		<div class="container">

			<div class="row">

				
				<div class="column6 beta infoSection hack-def">
					<i class="fa fa-question"></i>
					<h2 class="white">What does "T9" stand for?</h2>
					<p>
						T9 stands for Title IX, the ninth title of the United States Education Amendments of 1972.  It states:
					</p>
					<p>
						<span>
							No person in the United States shall, on the basis of sex, be excluded from participation in, be denied the benefits 
							of, or be subjected to discrimination under any education program or activity receiving federal financial assistance.
						</span>
					</p>
					<p>T9Hacks believes everyone deserves to learn, and we are here to help make that happen.</p>
				</div>
				<div class="column6 omega infoSection">
					<i class="fa fa-venus"></i>
					<h2 class="white">Why a women's hackathon?</h2>
					<p>
						Hackathons are a great way for students to become exposed to different technology, create new technology, and build 
						community.  However, most hackathons have very low female participation. We aim to create an opportunity and space for 
						women to explore creative technologies and solve real world problems.
					</p>
				</div>
			</div>
				
			<div class="row">

				<div class="column6 beta infoSection">
					<i class="fa fa-transgender-alt"></i>
					<h2 class="white">What about other genders?</h2>
					<p>
						We welcome all university students to participate; however, we especially encourage all students who self-identify as female to participate.
					</p>
				</div>
				<div class="column6 omega infoSection code-conduct">
					<i class="fa fa-heart-o"></i>
					<h2 class="white">Code of Conduct</h2>
					<p>
						At T9Hacks, we believe in creating a safe and welcoming environment for everyone.  Our organizers and our 
						participants follow the <a href="https://mlh.io/">MLH</a> code of conduct.
					</p>
					<a href="http://static.mlh.io/docs/mlh-code-of-conduct.pdf" class="btn btn-l" target="_blank">Learn More</a>
				</div>
			</div>

		</div>
	</section>



	<!-- Footer -->
	<?php include "includes/footer.php"; footer(); ?>


	<!-- Javascript -->
	<?php include "includes/js.php"; js(); ?>
	<script src="js/sponsorEmail.js"></script>
	
	<!-- Processing -->
	<script src="js/p5.min.js"></script>
	<script src="js/p5_starburst.js"></script>
	
	<!-- Clockwork -->
	<script type="text/javascript" src="js/kinetic.js"></script>
	<script type="text/javascript" src="js/jquery.final-countdown.min.js"></script>
	<script type="text/javascript">  
	    $('document').ready(function() {
	        'use strict';

	        
	    	$('.countdown').final_countdown({
	            'start': 1362139200,
	            'end': 1455984000,
	            'now': $.now()/1000        
	        });
	    });
	</script>
	

	</body>
</html>
