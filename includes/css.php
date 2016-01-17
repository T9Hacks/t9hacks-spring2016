<?php 
function css($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo $p; ?>images/favicon.ico" type="image/x-icon">

<!-- Bootstrap Core CSS -->
<link href="<?php echo $p; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo $p; ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

<!-- Custom CSS -->
<link href="<?php echo $p; ?>css/1140.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $p; ?>css/hackathon.css" rel="stylesheet" type="text/css" media="all">
<?php 
}

// $page = 1 => home
// $page = 2 => sign up page (start)
// $page = 3 => finishd participant sign up
// $page = 4 => finished mentor sign up
function facebookMeta($page) {
	echo '<meta property="fb:app_id"			content="1734809350067997" />';
	echo '<meta property="og:site_name"			content="T9Hacks" />';
	echo '<meta property="og:type"				content="website" />';
	echo '<meta property="og:image"				content="http://www.t9hacks.org/images/block_t9purple.jpg" />';
	echo '<meta property="og:description"		content="T9Hacks is a 24 hour women\'s hackathon at the University of Colorado Boulder\'s ATLAS Institute that brings together college students for two days of creativity, building, and hacking. Sign up to participate or become a mentor!" />';
	
	switch($page) {
		case 4:
			// Facebook Share Mark-up -- SIGN UP END MENTOR
			echo '<meta property="og:url"			content="http://www.t9hacks.org/signup.php" />';
			echo '<meta property="og:title"			content="I\'m mentoring at T9Hacks! // A women\'s hackathon promoting gender diversity in technology" />';
			break;
		case 3:
			// Facebook Share Mark-up -- SIGN UP END PARTICIPANT
			echo '<meta property="og:url"			content="http://www.t9hacks.org/signup.php" />';
			echo '<meta property="og:title"			content="I\'m going to T9Hacks! // A women\'s hackathon promoting gender diversity in technology" />';
			break;
		case 2:
			// Facebook Share Mark-up -- SIGN UP START
			echo '<meta property="og:url"			content="http://www.t9hacks.org/signup.php" />';
			echo '<meta property="og:title"			content="Sign Up for T9Hacks! // A women\'s hackathon promoting gender diversity in technology" />';
			break;
		case 1: 
		default:
			// Facebook Share Mark-up -- HOME
			echo '<meta property="og:url"			content="http://www.t9hacks.org" />';
			echo '<meta property="og:title"			content="T9Hacks // A women\'s hackathon promoting gender diversity in technology" />';
			break;
	}
}


?>