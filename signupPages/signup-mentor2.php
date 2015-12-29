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
		
		
			<div class="row signupTop" id="mentorTop">
				<div class="signupWrapper">
				
					<div class="row">
						<div class="column12">
							<h2>Mentor Sign-up</h2>
						</div>
					</div>
					
					<hr class="noTop"/>
				
					<div id="mentorLoading" class="signupLoading"><i class="fa fa-spinner fa-pulse"></i></div>
					
					<form id="mentorForm" class="signupForm" action="../signupScripts/register.php" method="post" enctype="multipart/form-data">
					
						<div id="mentorResult" class="signupResult"></div>
					
						<?php 
						if($numFriends > 0) {
						?>
							<div class="row">
								<div class="column12">
									<h3>Your Information</h3>
								</div>
							</div>
						<?php 
						}
						?>
						
						<div class="row">
							<p class="column12">
								Thank you for volunteering as a mentor! To sign-up we need your name, email, and phone number.
							</p>
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-user"></i><input type="text" placeholder="Name" name="name" id="mentorName"/></div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-envelope-o"></i><input type="text" placeholder="Email" name="email" id="mentorEmail"/></div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-mobile"></i><input type="text" placeholder="Phone Number" name="phone" id="mentorPhone"/></div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-building-o"></i><input type="text" placeholder="Company/Organization" name="company" id="mentorCompany"/></div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-group"></i><input type="text" placeholder="Position" name="position" id="mentorPosition"/></div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column12 checkboxes">
								<div class="column12 alpha">
									<p>We will be providing food for everyone who comes to the hackathon.  Which meals are you planning on being present for?</p>
								</div>
								<div class="fieldCheckbox">
									<input class="tgl tgl-flip" name="breakfast" id="mentorBreakfast" type="checkbox">
	   								<label class="tgl-btn" data-tg-off="Breakfast" data-tg-on="Breakfast" for="mentorBreakfast"></label>
								</div>
								<div class="fieldCheckbox">
									<input class="tgl tgl-flip" name="lunch" id="mentorLunch" type="checkbox" checked="checked">
	   								<label class="tgl-btn" data-tg-off="Lunch" data-tg-on="Lunch" for="mentorLunch"></label>
								</div>
								<div class="fieldCheckbox">
									<input class="tgl tgl-flip" name="dinner" id="mentorDinner" type="checkbox">
	   								<label class="tgl-btn" data-tg-off="Dinner" data-tg-on="Dinner" for="mentorDinner"></label>
								</div>
							</div>
						</div>
						
						<div class="row">
							<p class="column12">
								As a mentor, you will be working with groups in particular topics.  Which area(s) would you like to be a mentor for?
							</p>
							
							<div class="fieldWrapper column12 areas">
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorWebDesign' type='checkbox' name="webDesign" value="Web Design">
	   								<label class='tgl-btn' data-tg-off='Web Design' data-tg-on='Web Design' for='mentorWebDesign'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorWebDev' type='checkbox' name="webDev" value="Web Development">
	   								<label class='tgl-btn' data-tg-off='Web Development' data-tg-on='Web Development' for='mentorWebDev'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorAndroid' type='checkbox' name="android" value="Android Development">
	   								<label class='tgl-btn' data-tg-off='Android Development' data-tg-on='Android Development' for='mentorAndroid'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentoriOS' type='checkbox' name="iOS" value="iOS Development">
	   								<label class='tgl-btn' data-tg-off='iOS Development' data-tg-on='iOS Development' for='mentoriOS'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorUIUX' type='checkbox' name="uiux" value="UI/UX Design">
	   								<label class='tgl-btn' data-tg-off='UI/UX Design' data-tg-on='UI/UX Design' for='mentorUIUX'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorGaming' type='checkbox' name="gaming" value="Gaming">
	   								<label class='tgl-btn' data-tg-off='Gaming' data-tg-on='Gaming' for='mentorGaming'></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorPrint' type='checkbox' name="print" value="Print Media">
	   								<label class='tgl-btn' data-tg-off="Print Media" data-tg-on="Print Media" for="mentorPrint"></label>
								</div>
								<div class="fieldRadio">
									<input class='tgl tgl-flip' id='mentorArduino' type='checkbox' name="arduino" value="Arduino/Electronics">
	   								<label class='tgl-btn' data-tg-off='Arduino/Electronics' data-tg-on='Arduino/Electronics' for='mentorArduino'></label>
								</div>
							</div>
						</div>
						
						<?php 
						if($numFriends > 0) {
							?>
							<hr/>
							<hr/>
							<div class="row">
								<div class="column12">
									<h3>Colleague Registration</h3>
									<p>
										By registering your colleague(s), you will start their registration.  They will then be sent an 
										email asking them to complete this process.
									</p>
								</div>
							</div>
							<?php 
							for($i=0; $i<$numFriends; $i++) {
								$fid = $i+1;
								?>
								<hr/>
								<div class="row">
									<div class="column12">
										<h3>Colleague #<?php echo $fid; ?></h3>
									</div>
								</div>
								<div class="row">
									<div class="fieldWrapper column6">
										<div class="fieldInput"><i class="fa fa-user"></i><input type="text" placeholder="Name" name="friendName<?php echo $fid; ?>" id="friendName<?php echo $fid; ?>" /></div>
									</div>
									<div class="fieldWrapper column6">
										<div class="fieldInput"><i class="fa fa-envelope-o"></i><input type="text" placeholder="Email" name="friendEmail<?php echo $fid; ?>" id="friendEmail<?php echo $fid; ?>" /></div>
									</div>
								</div>
								<?php
							}
							?>
							<hr/>
							<?php 
						}
						?>
						
						<div class="row">
							<div class="fieldWrapper column12">
								<a href="signup-mentor1.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Back</a>
								<input type="text" name="honeypot" placeholder="Leave Blank" class="honeypot" />
								<input type="hidden" name="type" value="mentor" />
								<input type="hidden" name="friends" value="<?php echo $numFriends; ?>"/>
								<button id="mentorConfirmationBtn" class="btn btn-l right confirmationBtn">Confirmation &nbsp;<i class="fa fa-arrow-circle-o-right"></i></button>
							</div>
						</div>
						
					</form>
					
					<div id="mentorConfirmation" class="signupConfirmation">
						
						<div class="row">
							<p class="column12">
								Please confirm your registeration information and submit when you are done.  An email will be sent to you with your confirmation.
							</p>
						</div>
						
						<?php 
						if($numFriends > 0) {
						?>
							<hr class="noTop"/>
							<div class="row">
								<div class="column12">
									<h3>Your Information</h3>
								</div>
							</div>
						<?php 
						}
						?>
						
						<div class="row">
							<div class="column2">&nbsp;</div>
							<div class="column8">
								<table class="confirmationTable">
								<tbody>
									<tr><td>Name</td>		<td id="mName"></td></tr>
									<tr><td>Email</td>		<td id="mEmail"></td></tr>
									<tr><td>Phone</td>		<td id="mPhone"></td></tr>
									
									<tr><td>Company</td>	<td id="mCompany"></td></tr>
									<tr><td>Position</td>	<td id="mPosition"></td></tr>
									
									<tr><td>Breakfast</td>	<td id="mBreakfast"></td></tr>
									<tr><td>Lunch</td>		<td id="mLunch"></td></tr>
									<tr><td>Dinner</td>		<td id="mDinner"></td></tr>
									
									<tr><td>Web Design</td>				<td id="mWebDesign"></td></tr>
									<tr><td>Web Development</td>		<td id="mWebDev"></td></tr>
									<tr><td>Android Development</td>	<td id="mAndroid"></td></tr>
									<tr><td>iOS Development</td>		<td id="miOS"></td></tr>
									<tr><td>UI/UX Design</td>			<td id="mUIUX"></td></tr>
									<tr><td>Gaming</td>					<td id="mGaming"></td></tr>
									<tr><td>Print Media</td>			<td id="mPrint"></td></tr>
									<tr><td>Arduino/Electronics</td>	<td id="mArduino"></td></tr>
								</tbody>
								</table>
							</div>
						</div>
						
						<?php 
						if($numFriends > 0) {
							for($i=0; $i<$numFriends; $i++) {
								$fid = $i+1;
								?>
								<hr/>
								<div class="row">
									<div class="column12">
										<h3>Colleague #<?php echo $fid; ?></h3>
									</div>
								</div>
								<div class="row">
									<div class="column2">&nbsp;</div>
									<div class="column8">
										<table class="confirmationTable">
										<tbody>
											<tr><td>Name</td>		<td id="fName<?php echo $fid; ?>"></td></tr>
											<tr><td>Email</td>		<td id="fEmail<?php echo $fid; ?>"></td></tr>
										</tbody>
										</table>
									</div>
								</div>
								<?php
							}
							?>
							<hr/>
							<?php 
						}
						?>
						
						<div class="row">
							<div class="fieldWrapper column12">
								<a href="signup.php" id="mentorBack" class="backBtn backToEditBtn"><i class="fa fa-angle-double-left"></i> Back to Edit</a>
								<button id="mentorSubmitBtn" class="btn btn-l right" data-friends="<?php echo $numFriends; ?>">Submit &nbsp;<i class="fa fa-arrow-circle-o-right"></i></button>
							</div>
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