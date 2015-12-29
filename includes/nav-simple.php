<?php 
function nav($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Navigation -->
<nav class="navbar navbar-shrink navbar-fixed-top">
	<div class="container">

		<div class="navbar-header page-scroll">
			<a class="navbar-brand" href="<?php echo $p; ?>index.php">T9Hacks</a>
		</div>
			
		<div>
			<ul class="navbar-right">
 				<li><a href="<?php echo $p; ?>index.php" class="btn btn-l">Back to Home</a></li>
			</ul>
		</div>

	</div>
</nav>
<?php }?>