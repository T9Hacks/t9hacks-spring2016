<?php 
function nav($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Navigation -->
<nav class="navbar navbar-fixed-top navbar-shrink-perm">
	<div class="container">

		<!-- Brand -->
		<div class="navbar-header page-scroll">
			<a class="navbar-brand" href="<?php echo $p; ?>index.php">T9Hacks</a>
		</div>
			
		<!-- Collect the nav links, forms, and other content for toggling -->
		<ul class="nav-simple navbar-right">
 			<li><a href="<?php echo $p; ?>index.php" class="btn btn-l">Back to Home</a></li>
		</ul>
		
		<!-- MLH Trust Badge -->
		<a id="mlh-trust-badge" href="https://mlh.io/seasons/s2016/events?utm_source=s2016&utm_medium=TrustBadge&utm_campaign=s2016" target="_blank">
			<img src="https://s3.amazonaws.com/logged-assets/trust-badge/s2016.png" alt="MLH Official - Spring 2016">
		</a>

	</div>
</nav>



<?php }?>