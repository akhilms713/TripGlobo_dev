	<script src="<?php echo base_url(); ?>assets/js/gsap/main-gsap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/provab-login.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/provab-api.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/raphael-min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/provab-chat.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/provab-custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/provab-demo.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/sidebar_stack.js"></script>
	<script type="text/javascript" language="JavaScript">
		if(false){
			document.onkeypress = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
				   //alert('No F-12');
					return false;
				}
			}
			document.onmousedown = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
					//alert('No F-keys');
					return false;
				}
			}
			document.onkeydown = function (event) {
				event = (event || window.event);
				if (event.keyCode == 123) {
					//alert('No F-keys');
					return false;
				}
			}
			function disableText(e){return false;}
			function reEnable(){return true;}
			document.onselectstart = new Function ("return false");
			if (window.sidebar){document.onmousedown = disableText;document.onclick = reEnable;}
			window.onkeydown = function(e){if(e.ctrlKey == true){return false;}};
		}
	</script>
