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

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							Permission Nodes <small>Permission Nodes</small>

						</h3>

						<ul class="breadcrumb">

							<li>	<i class="icon-home"></i>	<a href="index.html">Home</a> 	<i class="icon-angle-right"></i>	</li>

							<li>	<a href="#">Settings</a>	<i class="icon-angle-right"></i> </li>

							<li> <a href="#">Permission Nodes</a> </li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<div class="portlet box grey">

							<div class="portlet-title">

								<div class="caption"><i class="icon-sitemap"></i>All Nodes</div>

								<div class="actions">
									
									<a href="javascript:;" id="role-tree-collapse" class="btn blue"> Collapse All</a>

									<a href="javascript:;" id="role-tree-expand" class="btn yellow"> Expand All</a>
									
									<a href="javascript:;" class="btn green easy-pie-chart-reload"><i class="icon-repeat"></i> Reload</a>
									
								</div>

							</div>

							<div class="portlet-body fuelux">

								<ul class="tree" id="role-tree">

									<li>
										<span class="node-tools" data-value="0">
											<i class="icon-plus" title="Add" data-target="#node-dialog" data-action="add"></i>	
										</span>
										<a href="#" data-role="branch" class="tree-toggle" data-toggle="branch" >Group</a>										
										
										<?php if(is_array($all_nodes)){?>
										
										<ul class="branch in">
										
										<?php foreach ($all_nodes as $gkey => $group){?>

											<li>
												<span class="node-tools" data-value="<?php echo $group['info']['node_id'];?>">
													<i class="icon-plus" title="Add" data-target="#node-dialog" data-action="add"></i>
													<i class="icon-edit" title="Edit" data-target="#node-dialog" data-action="edit"></i>
													<i class="icon-remove" title="Remove" data-target="#node-dialog" data-action="remove"></i>
												</span>
												<a href="#" class="tree-toggle" data-toggle="branch" > 
													<span class="node-info"><?php echo $gkey; ?> [ <?php echo $group['info']['remark'];?> ]</span>												
												</a>
												
												<?php if(isset($group['model']) && is_array($group['model'])){?>

												<ul class="branch in">
												
													<?php foreach ($group['model'] as $mkey => $model){?>
													
													<li>
														<span class="node-tools" data-value="<?php echo $model['info']['node_id'];?>">
															<i class="icon-plus" title="Add" data-target="#node-dialog" data-action="add"></i>
															<i class="icon-edit" title="Edit" data-target="#node-dialog" data-action="edit"></i>
															<i class="icon-remove" title="Remove" data-target="#node-dialog" data-action="remove"></i>
														</span>
														<a href="#" class="tree-toggle" data-toggle="branch" >
															<span class="node-info"><?php echo $mkey;?>[ <?php echo $model['info']['remark'];?> ]</span>															
														</a>
														
														<?php if (isset($model['action']) && is_array($model['action'])){?>
														
														<ul class="branch in">
														
															<?php foreach ($model['action'] as $action){?>

															<li>
																<span class="node-tools" data-value="<?php echo $action['node_id'];?>">
																	<i class="icon-edit" title="Edit" data-target="#node-dialog" data-action="edit"></i>
																	<i class="icon-remove" title="Remove" data-target="#node-dialog" data-action="remove"></i>
																</span>
																<a href="javascript:;" data-role="leaf" >																		
																	<i class="icon-leaf"></i> <?php echo $action['name'].' [ '.$action['remark'].' ]'?>													
																</a>																
															</li>
															
															<?php }?>

														</ul>
														
														<?php }?>
														
													</li>
													
													<?php }?>
													
												</ul>
												<?php }?>

											</li>
											<?php }?>

										</ul>
										<?php }?>
									</li>

								</ul>

							</div>

						</div>

					</div>

				</div>

				<!-- END PAGE CONTENT-->

			</div>

			<!-- END PAGE CONTAINER--> 

		</div>

		<!-- END PAGE --> 
	
	</div>
	<div id="node-dialog" role="dialog" class="modal fade" aria-hidden="true" aria-labelledby="dialog-header-title" tabindex="-1"></div>
	
	<!-- END CONTAINER -->
	<script>
		$(document).ready(function(){
			App.init();
			
			$('#node-dialog').delegate('button.save-node','click',function(){
				$('#node-form .control-group.error').removeClass('error').find('span.help-block').remove();
				$.ajax({
					url:'index.php?route=setting/permission_node/save_node',
					type:'post',
					data:$('#node-form input[type="text"],#node-form input[type="hidden"],#node-form input[type="radio"]:checked,#node-form select'),
					dataType: 'json',
					success: function(json) {
						$('.alert').remove();
						if (json['error']) {
							for (i in json['error']) {
								$('#node-dialog input[name="' + i+'"]').parent().parent().addClass('error');
								$('#node-dialog input[name="' + i+'"]').after('<span class="help-block">' + json['error'][i] + '</span>');
							}
						}
						if (json['success']) {
							$('#node-dialog .modal-body').prepend('<div class="alert alert-success">'+json['success']+'</div>');
							$('#node-dialog input[name][type="text"]').val('');
						}
					}
				});
			});

			$('#role-tree .node-tools i').bind('click',function(){
				$('#node-dialog').html('');
				$.get('index.php?route=setting/permission_node/render_form',{node_id:$(this).parent().attr('data-value'),action:$(this).attr('data-action')},function(html){
					$('#node-dialog').html(html).modal();
				})
			});


			$('#node-dialog').delegate('input[type="radio"]','click',function (event) {
		        if (!$(this).parent().hasClass("checked")) {
		            $('input[name="'+$(this).attr("name")+'"]').each(function () {
		                $(this).parent().removeClass("checked");
		                $(this).removeAttr("checked");
		            });
		            $(this).parent().addClass("checked");
		            $(this).attr("checked","checked");
		        }
		    });

			$('#role-tree-collapse').click(function () {
                $('.tree-toggle', $('#role-tree > li > ul')).addClass("closed");
                $('.branch', $('#role-tree > li > ul')).removeClass("in");
            });

            $('#role-tree-expand').click(function () {
                $('.tree-toggle', $('#role-tree > li > ul')).removeClass("closed");
                $('.branch', $('#role-tree > li > ul')).addClass("in");
            });
		})

	</script>
	<style>
		#role-tree i{cursor:pointer;}
		.node-info{clear:both;}.node-tools{float:right;margin-right:100px;}
	</style>
<?php echo $footer; ?>