<?php 
function js($up = false) {
	$p = ($up) ? "../" : "";
?>
<!-- jQuery -->
<script src="<?php echo $p; ?>js/jquery-1.11.3.min.js" type="text/javascript"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $p; ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo $p; ?>plugins/agency/js/cbpAnimatedHeader.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo $p; ?>plugins/agency/js/agency.js"></script>

<!-- Google Analytics -->
<script src="<?php echo $p; ?>js/analyticstracking.js"></script>
<?php }?>