	
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	
	
	<!--[if lt IE 9]>
		<script src="<?=base_url()?>file_css_admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?=base_url()?>file_css_admin/assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?=base_url()?>file_css_admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=base_url()?>file_css_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url()?>file_css_admin/assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?=base_url()?>file_css_admin/assets/js/theme/default.min.js"></script>
	<script src="<?=base_url()?>file_css_admin/assets/js/apps.min.js"></script>
	<?php 
		if(!empty($script_js)){
			echo $script_js;
		}
	?>
	<!-- ================== END BASE JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			$('form').bind("keypress", function(e) {
			  if (e.keyCode == 13) {               
			    e.preventDefault();
			    return false;
			  }
			});

		});
		$(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
	</script>

</body>

</html>
