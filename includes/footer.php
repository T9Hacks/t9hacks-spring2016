<?php 
function footer($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Footer -->
<footer>
	<div class="container">

		<div class="row">
			<div class="column4 location">
				<p>
					<span class="fa fa-clock-o"></span>
					<span class="text">20-21 February 2016</span>
				</p>
                <p>
                	<span class="fa fa-map-marker"></span>
                	<span class="text">
                		<a href="http://www.colorado.edu/" target="_blank">University of Colorado Boulder</a>
                		<br/> 
                		<a href="http://atlas.colorado.edu/" target="_blank">ATLAS Institute</a>
                	</span>
                </p>
                <p>
                	<span class="fa fa-location-arrow"></span>
                	<span class="text">
                		<a href="https://www.google.com/maps/place/ATLAS+Institute,+University+of+Colorado/@40.0076244,-105.2721198,17z/data=!3m1!4b1!4m2!3m1!1s0x876bec3384ff175f:0xe59d1ef9575505f5" target="_blank">Black Box Experimental Studio</a>
                	</span>
                </p>
			</div>
			<div class="column4">
				<ul class="socialButtons">
					<li>
						<a href="https://www.facebook.com/groups/414618935414757" target="_blank"><i class="fa fa-facebook"></i></a>
					</li>
					<li>
						<a href="https://github.com/T9Hacks" target="_blank"><i class="fa fa-github"></i></a>
					</li>
					<li>
						<a href="https://twitter.com/T9Hacks" target="_blank"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="https://www.linkedin.com/groups/8448877" target="_blank"><i class="fa fa-linkedin"></i></a>
					</li>
				</ul>
			</div>
			<div class="column4">
				<div class="quicklinks">
					<p><a href="<?php echo $p; ?>team.php">Meet our team</a></p>
				</div>
				<div class="copyright">
					<p>Made by T9 Hackers</p>
					<p>T9Hacks &nbsp;<i class="fa fa-copyright"></i>&nbsp; <?php echo date("Y"); ?></p>
				</div>
			</div>
		</div>
	
	</div>
</footer>
<?php }?>
