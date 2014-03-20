<?php echo $header; ?>

	<!-- BEGIN HEADER -->

	<div class="header navbar navbar-inverse navbar-fixed-top">
		<?php echo $top; ?>
	</div>

	<!-- END HEADER -->
	
	<!-- BEGIN CONTAINER -->

	<div class="page-container">
		<!-- BEGIN SIDEBAR -->

		<div class="page-sidebar nav-collapse collapse">
			<?php echo $sidebar; ?>
		</div>
		
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->

		<div class="page-content">



			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">
					

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							Permission Denied! <small>Permission Denied!</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">Home</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">Extra</a>

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">Permission Denied!</a></li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->          

				<div class="row-fluid">

					<div class="span12 page-500">

						<div class=" number">	Denied!	</div>

						<div class=" details">

							<h3>Opps, Permission Denied!.</h3>

							<p>	<?php echo $text_permission;?><br /></p>

						</div>

					</div>

				</div>

				<!-- END PAGE CONTENT-->

			</div>

			<!-- END PAGE CONTAINER-->       

		</div>

		<!-- END PAGE -->     
		

	</div>

	<!-- END CONTAINER -->
	
	<script>

		jQuery(document).ready(function() {    

		   App.init(); // initlayout and core plugins

		});

	</script>
<?php echo $footer; ?>