<?php 
function css($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo $p; ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo $p; ?>images/favicon.ico" type="image/x-icon">

<!-- Bootstrap Core CSS -->
<link href="<?php echo $p; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo $p; ?>plugins/agency/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Gruppo' rel='stylesheet' type='text/css'>

<!-- Custom CSS -->
<link href="<?php echo $p; ?>css/1140.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $p; ?>css/hackathon.css" rel="stylesheet" type="text/css" media="all">
<?php }?>