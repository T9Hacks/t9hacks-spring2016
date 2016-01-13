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
	echo '<meta property="og:type"				content="website" />';
	echo '<meta property="fb:app_id"			content="1734809350067997" />';
	echo '<meta property="og:image"				content="http://www.t9hacks.org/images/block_t9purple.jpg" />';
	echo '<meta property="og:site_name"			content="T9Hacks" />';
	switch($page) {
		case 4:
			?>
			<!-- Facebook Share Mark-up -- SIGN UP END MENTOR -->
			<meta property="og:url"                content="http://www.t9hacks.org/signup.php" />
			<meta property="og:title"              content="I'm mentoring at T9Hacks! // CU's first female hackathon // Feb 20-21" />
			<meta property="og:description"        content="T9Hacks ia a 24-hour women's hackathon at CU Boulder's ATLAS Institute aimed at increasing women participation in technology and design fields.  Sign up to participate or become a mentor!" />
			<?php 
			break;
		case 3:
			?>
			<!-- Facebook Share Mark-up -- SIGN UP END PARTICIPANT -->
			<meta property="og:url"                content="http://www.t9hacks.org/signup.php" />
			<meta property="og:title"              content="I'm going to T9Hacks! // CU's first female hackathon // Feb 20-21" />
			<meta property="og:description"        content="T9Hacks ia a 24-hour women's hackathon at CU Boulder's ATLAS Institute aimed at increasing women participation in technology and design fields.  Sign up to participate or become a mentor!" />
			<?php 
			break;
		case 2:
			?>
			<!-- Facebook Share Mark-up -- SIGN UP START -->
			<meta property="og:url"                content="http://www.t9hacks.org/signup.php" />
			<meta property="og:title"              content="Sign Up for T9Hacks! // Feb 20-21" />
			<meta property="og:description"        content="T9Hacks ia a 24-hour women's hackathon at CU Boulder's ATLAS Institute aimed at increasing women participation in technology and design fields.  Sign up to participate or become a mentor!" />
			<?php 
			break;
		case 1: 
		default:
			?>
			<!-- Facebook Share Mark-up -- HOME -->
			<meta property="og:url"                content="http://www.t9hacks.org" />
			<meta property="og:title"              content="T9Hacks // Feb 20-21" />
			<meta property="og:description"        content="T9Hacks ia a 24-hour women's hackathon at CU Boulder's ATLAS Institute aimed at increasing women participation in technology and design fields!" />
			<?php 
			break;
	}
}


?>