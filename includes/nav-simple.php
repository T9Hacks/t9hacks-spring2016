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
		<ul class="navbar-right">
 			<li><a href="<?php echo $p; ?>index.php" class="btn btn-l">Back to Home</a></li>
		</ul>

	</div>
</nav>
<?php }?>