<?php 
function footer($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- Footer -->
<footer>
	<div class="container">

		<div class="row">
			<div class="column4">
				<span class="copyright">
					<!-- <i class="fa fa-copyright"></i> &nbsp;T9Hacks <span id="copyrightYear"></span> -->
					20-21 February 2016
				</span>
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
					<a href="<?php echo $p; ?>team.php">Meet our team</a>
				</div>
			</div>
		</div>
	
	</div>
</footer>
<script>
	var today = new Date();
	var year = today.getFullYear();
	document.getElementById("copyrightYear").innerHTML = year;
</script>
<?php }?>
