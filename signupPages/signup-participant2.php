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
		
		// get key
		$key = null;
		$regType = 1; // new
		// check if key exists
		if(array_key_exists("key", $_GET)) {
			$key = $_GET['key'];
			$numFriends = 0;
			
			// get data
			include '../signupScripts/finishRegistration.php';
			$data = getParticipantData($key);
			//echo '<pre>'.print_r($data, true).'</pre>'; die();
			
			// get registration type
			$t = -1;
			if(array_key_exists("t", $_GET))
				$t = $_GET["t"];
			if($t == 2)
				$regType = 2; // need to complete
			else
				$regType = 3; // update
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
					<div class="team-title">
						<h1>Sign-up for T9Hacks</h1>
					</div>
				</div>
			</div>
			
		
			<div class="row signupTop" id="participantTop">
				<div class="signupWrapper">
				
					<div class="row">
						<div class="column12">
							<h2>Participant Sign-up</h2>
						</div>
					</div>
					
					<hr class="noTop"/>
				
					<div id="participantLoading" class="signupLoading"><i class="fa fa-spinner fa-pulse"></i></div>
					
					<form id="participantForm" class="signupForm" action="../signupScripts/register.php" method="post" enctype="multipart/form-data">
					
						<div id="participantResult" class="signupResult"></div>
						
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
								To register we require a few pieces of information.  Please register with your university email account.
							</p>
							
							<div class="fieldWrapper column6">
								<div class="fieldInput"><i class="fa fa-user"></i><input type="text" placeholder="Full Name" name="name" id="participantName" value="<?php echo (!is_null($key)) ? $data["name"] : ""; ?>"/></div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-envelope-o"></i>
									<input type="text" placeholder="Email" name="email" id="participantEmail" value="<?php echo (!is_null($key)) ? $data["email"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-university"></i>
									<input type="text" placeholder="College" name="college" id="participantCollege" value="<?php echo (!is_null($key)) ? $data["college"] : ""; ?>"/>
								</div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-graduation-cap"></i>
									<input type="text" placeholder="Major" name="major" id="participantMajor" value="<?php echo (!is_null($key)) ? $data["major"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-mobile"></i>
									<input type="text" placeholder="Phone Number" name="phone" id="participantPhone" value="<?php echo (!is_null($key)) ? $data["phone"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<p class="column12">
								By participating in T9Hacks, you get special access to our sponsors, their recruiters, and 
								additional technology opportunities.  The following information is optional and will be shared with our sponsors.
								We will never allow the sale of your information to any third-parties.
							</p>
							
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-linkedin"></i>
									<input type="text" placeholder="Linkedin" name="linkedin" id="participantLinkedin" value="<?php echo (!is_null($key)) ? $data["linkedin"] : ""; ?>"/>
								</div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput" id="upload">
									<i class="fa fa-file-text-o"></i>
									<input type="text" id="resumeName" name="resumeOld" placeholder="Upload Resume" value="<?php echo (!is_null($key)) ? $data["resume"] : ""; ?>" />
									<input type="file" id="resumeUploadInput" name="resume" class="upload"/>
									<span id="resumeUploadBtn" class="btn btn-med">Upload</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-globe"></i>
									<input type="text" placeholder="Personal Website" name="website" id="participantWebsite" value="<?php echo (!is_null($key)) ? $data["website"] : ""; ?>"/>
								</div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-github"></i>
									<input type="text" placeholder="Github" name="github" id="participantGithub" value="<?php echo (!is_null($key)) ? $data["github"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-building-o"></i>
									<input type="text" placeholder="Company/Organization" name="company" id="participantCompany" value="<?php echo (!is_null($key)) ? $data["company"] : ""; ?>"/>
								</div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-group"></i>
									<input type="text" placeholder="Position" name="position" id="participantPosition" value="<?php echo (!is_null($key)) ? $data["position"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-facebook"></i>
									<input type="text" placeholder="Facebook" name="facebook" id="participantFacebook" value="<?php echo (!is_null($key)) ? $data["facebook"] : ""; ?>"/>
								</div>
							</div>
							<div class="fieldWrapper column6">
								<div class="fieldInput">
									<i class="fa fa-twitter"></i>
									<input type="text" placeholder="Twitter" name="twitter" id="participantTwitter" value="<?php echo (!is_null($key)) ? $data["twitter"] : ""; ?>"/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<p class="column12">
								As part of your registeration, you will receive a free T9Hacks t-shirt.  This t-shirt will be in a standard unisex size.  
								What size would you like?
							</p>
							
							<div class="fieldWrapper column12">
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-xs' type='radio' name="shirt" value="X-Small" <?php echo (!is_null($key) && $data['shirt'] == "X-Small" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='X-Small' data-tg-on='X-Small' for='shirt-xs'></label>
								</div>
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-s' type='radio' name="shirt" value="Small" <?php echo (!is_null($key) && $data['shirt'] == "Small" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='Small' data-tg-on='Small' for='shirt-s'></label>
								</div>
								<div class="fieldRadio">
									<?php 
										$checked = "";
										if(is_null($key)|| $data['shirt'] == "Medium" || empty($data['shirt']) || is_null($data['shirt'])) {
											$checked = 'checked="checked"';
										}
									?>
									<input class="tgl tgl-flip" id='shirt-med' type='radio' name="shirt" value="Medium" <?php echo $checked; ?>>
	   								<label class='tgl-btn' data-tg-off='Medium' data-tg-on='Medium' for='shirt-med'></label>
								</div>
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-lg' type='radio' name="shirt" value="Large" <?php echo (!is_null($key) && $data['shirt'] == "Large" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='Large' data-tg-on='Large' for='shirt-lg'></label>
								</div>
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-xl' type='radio' name="shirt" value="X-Large" <?php echo (!is_null($key) && $data['shirt'] == "X-Large" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='X-Large' data-tg-on='X-Large' for='shirt-xl'></label>
								</div>
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-xxl' type='radio' name="shirt" value="XX-Large" <?php echo (!is_null($key) && $data['shirt'] == "XX-Large" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='XX-Large' data-tg-on='XX-Large' for='shirt-xxl'></label>
								</div>
								<div class="fieldRadio">
									<input class="tgl tgl-flip" id='shirt-none' type='radio' name="shirt" value="None" <?php echo (!is_null($key) && $data['shirt'] == "None" ) ? 'checked="checked"' : ""; ?>>
	   								<label class='tgl-btn' data-tg-off='None' data-tg-on='None' for='shirt-none'></label>
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
									<h3>Friend Registration</h3>
									<p>
										By registering your friend(s), you guarantee them a spot at T9Hacks.  They will then be sent an 
										email asking them to complete their registration.
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
										<h3>Friend #<?php echo $fid; ?></h3>
									</div>
								</div>
								<div class="row">
									<div class="fieldWrapper column6">
										<div class="fieldInput">
											<i class="fa fa-user"></i>
											<input type="text" placeholder="Name" name="friendName<?php echo $fid; ?>" id="friendName<?php echo $fid; ?>" />
										</div>
									</div>
									<div class="fieldWrapper column6">
										<div class="fieldInput">
											<i class="fa fa-envelope-o"></i>
											<input type="text" placeholder="Email" name="friendEmail<?php echo $fid; ?>" id="friendEmail<?php echo $fid; ?>" />
										</div>
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
								<a href="signup-participant1.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Back</a>
								<input class="honeypot" type="text" name="honeypot" placeholder="Leave Blank"/>
								<input type="hidden" name="type" value="participant" />
								<input type="hidden" name="key" value="<?php echo ( !is_null($key) ? $key : "-1" ); ?>" />
								<input type="hidden" name="regType" value="<?php echo $regType; ?>" />
								<input type="hidden" name="friends" value="<?php echo $numFriends; ?>"/>
								<button id="participantConfirmationBtn" class="btn btn-l right confirmationBtn">Confirmation &nbsp;<i class="fa fa-arrow-circle-o-right"></i></button>
							</div>
						</div>
							
					</form>
					
					<div id="participantConfirmation" class="signupConfirmation">
						
						<div class="row">
							<p class="column12">
								Please confirm your registeration information and submit when you are done.  An email will be sent to you with your ticket.
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
									<tr><td>Name</td>		<td id="pName"></td></tr>
									<tr><td>Email</td>		<td id="pEmail"></td></tr>
									<tr><td>College</td>	<td id="pCollege"></td></tr>
									<tr><td>Major</td>		<td id="pMajor"></td></tr>
									<tr><td>Phone</td>		<td id="pPhone"></td></tr>
									
									<tr><td>Linkedin</td>	<td id="pLinkedin"></td></tr>
									<tr><td>Resume</td>		<td id="pResume"></td></tr>
									<tr><td>Website</td>	<td id="pWebsite"></td></tr>
									<tr><td>Github</td>		<td id="pGithub"></td></tr>
									<tr><td>Company</td>	<td id="pCompany"></td></tr>
									<tr><td>Position</td>	<td id="pPosition"></td></tr>
									<tr><td>Facebook</td>	<td id="pFacebook"></td></tr>
									<tr><td>Twitter</td>	<td id="pTwitter"></td></tr>
									
									<tr><td>Shirt Size</td>	<td id="pShirt"></td></tr>
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
										<h3>Friend #<?php echo $fid; ?></h3>
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
								<a href="#" id="participantBack" class="backBtn backToEditBtn"><i class="fa fa-angle-double-left"></i> Back to Edit</a>
								<button id="participantSubmitBtn" class="btn btn-l right" data-friends="<?php echo $numFriends; ?>">Submit &nbsp;<i class="fa fa-arrow-circle-o-right"></i></button>
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