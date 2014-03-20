<?php echo $header; ?>

	<!-- BEGIN HEADER -->

	<div class="header navbar navbar-inverse navbar-fixed-top">
		<?php echo $top; ?>
	</div>

	<!-- END HEADER -->
	
	<!-- BEGIN CONTAINER -->

	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->

		<div class="page-sidebar nav-collapse collapse">
			<?php echo $sidebar; ?>
		</div>
		
		<!-- END SIDEBAR -->
		
		<!-- BEGIN PAGE -->

		<div class="page-content" style="min-height:1071px !important">

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							User Profile <small>user profile sample</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>	<a href="index.html">Home</a> 	<i class="icon-angle-right"></i>

							</li>

							<li>

								<a href="#">Extra</a>	<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">User Profile</a></li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid profile">

					<div class="span12">
					
						<!-- BEGIN ALERT -->
						
						<div class="portlet-body">
								<?php if($warning){?>
								<div class="alert">	<button class="close" data-dismiss="alert"></button><?php echo $warning;?>	</div>
								<?php }?>
								
								<?php if($success){?>
								<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><?php echo $success;?>	</div>
								<?php }?>
								
								<?php if($error){?>
								<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><?php echo $error;?>	</div>
								<?php }?>
							</div>

						<!-- END ALERT -->
						<!--BEGIN TABS-->

						<div class="tabbable tabbable-custom tabbable-full-width">

							<ul class="nav nav-tabs">

								<li class=""><a href="#tab_1_1" data-toggle="tab">Overview</a></li>

								<li class=""><a href="#tab_1_2" data-toggle="tab">Profile Info</a></li>

								<li class=""><a href="#tab_1_3" data-toggle="tab">Account</a></li>

								<li class=""><a href="#tab_1_4" data-toggle="tab">Projects</a></li>

								<li class="active"><a href="#tab_1_6" data-toggle="tab">Help</a></li>

							</ul>

							<div class="tab-content">

								<div class="tab-pane row-fluid" id="tab_1_1">

									<ul class="unstyled profile-nav span3">

										<li><img src="asset/image/profile-img.png" alt=""> <a href="#" class="profile-edit">edit</a></li>

										<li><a href="#">Projects</a></li>

										<li><a href="#">Messages <span>3</span></a></li>

										<li><a href="#">Friends</a></li>

										<li><a href="#">Settings</a></li>

									</ul>

									<div class="span9">

										<div class="row-fluid">

											<div class="span8 profile-info">

												<h1>John Doe</h1>

												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.</p>

												<p><a href="#">www.mywebsite.com</a></p>

												<ul class="unstyled inline">

													<li><i class="icon-map-marker"></i> Spain</li>

													<li><i class="icon-calendar"></i> 18 Jan 1982</li>

													<li><i class="icon-briefcase"></i> Design</li>

													<li><i class="icon-star"></i> Top Seller</li>

													<li><i class="icon-heart"></i> BASE Jumping</li>

												</ul>

											</div>

											<!--end span8-->

											<div class="span4">

												<div class="portlet sale-summary">

													<div class="portlet-title">

														<div class="caption">Sales Summary</div>

														<div class="tools">	<a class="reload" href="javascript:;"></a>	</div>

													</div>

													<ul class="unstyled">

														<li>

															<span class="sale-info">TODAY SOLD <i class="icon-img-up"></i></span> 

															<span class="sale-num">23</span>

														</li>

														<li>

															<span class="sale-info">WEEKLY SALES <i class="icon-img-down"></i></span> 

															<span class="sale-num">87</span>

														</li>

														<li>

															<span class="sale-info">TOTAL SOLD</span> 

															<span class="sale-num">2377</span>

														</li>

														<li>

															<span class="sale-info">EARNS</span> 

															<span class="sale-num">$37.990</span>

														</li>

													</ul>

												</div>

											</div>

											<!--end span4-->

										</div>

										<!--end row-fluid-->

										<div class="tabbable tabbable-custom tabbable-custom-profile">

											<ul class="nav nav-tabs">

												<li class="active"><a href="#tab_1_11" data-toggle="tab">Latest Customers</a></li>

												<li class=""><a href="#tab_1_22" data-toggle="tab">Feeds</a></li>

											</ul>

											<div class="tab-content">

												<div class="tab-pane active" id="tab_1_11">

													<div class="portlet-body" style="display: block;">

														<table class="table table-striped table-bordered table-advance table-hover">

															<thead>

																<tr>

																	<th><i class="icon-briefcase"></i> Company</th>

																	<th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>

																	<th><i class="icon-bookmark"></i> Amount</th>

																	<th></th>

																</tr>

															</thead>

															<tbody>

																<tr>

																	<td><a href="#">Pixel Ltd</a></td>

																	<td class="hidden-phone">Server hardware purchase</td>

																	<td>52560.10$ <span class="label label-success label-mini">Paid</span></td>

																	<td><a class="btn mini green-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td> <a href="#">	Smart House	</a>  </td>

																	<td class="hidden-phone">Office furniture purchase</td>

																	<td>5760.00$ <span class="label label-warning label-mini">Pending</span></td>

																	<td><a class="btn mini blue-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td><a href="#">FoodMaster Ltd	</a></td>

																	<td class="hidden-phone">Company Anual Dinner Catering</td>

																	<td>12400.00$ <span class="label label-success label-mini">Paid</span></td>

																	<td><a class="btn mini blue-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td><a href="#">WaterPure Ltd</a></td>

																	<td class="hidden-phone">Payment for Jan 2013</td>

																	<td>610.50$ <span class="label label-danger label-mini">Overdue</span></td>

																	<td><a class="btn mini red-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td><a href="#">Pixel Ltd</a></td>

																	<td class="hidden-phone">Server hardware purchase</td>

																	<td>52560.10$ <span class="label label-success label-mini">Paid</span></td>

																	<td><a class="btn mini green-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td><a href="#">Smart House	</a>  </td>

																	<td class="hidden-phone">Office furniture purchase</td>

																	<td>5760.00$ <span class="label label-warning label-mini">Pending</span></td>

																	<td><a class="btn mini blue-stripe" href="#">View</a></td>

																</tr>

																<tr>

																	<td><a href="#">FoodMaster Ltd</a></td>

																	<td class="hidden-phone">Company Anual Dinner Catering</td>

																	<td>12400.00$ <span class="label label-success label-mini">Paid</span></td>

																	<td><a class="btn mini blue-stripe" href="#">View</a></td>

																</tr>

															</tbody>

														</table>

													</div>

												</div>

												<!--tab-pane-->

												<div class="tab-pane" id="tab_1_22">

													<div class="tab-pane active" id="tab_1_1_1">

														<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 290px;"><div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1" style="overflow: hidden; width: auto; height: 290px;">

															<ul class="feeds">

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success"> <i class="icon-bell"></i>	</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					You have 4 pending tasks.

																					<span class="label label-important label-mini">	Take action <i class="icon-share-alt"></i></span>

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">Just now	</div>

																	</div>

																</li>

																<li>

																	<a href="#">

																		<div class="col1">

																			<div class="cont">

																				<div class="cont-col1">

																					<div class="label label-success">   <i class="icon-bell"></i>	</div>

																				</div>

																				<div class="cont-col2">

																					<div class="desc">	New version v1.4 just lunched!   </div>

																				</div>

																			</div>

																		</div>

																		<div class="col2">

																			<div class="date">	20 mins	</div>

																		</div>

																	</a>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-important">  <i class="icon-bolt"></i>	</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">Database server #12 overloaded. Please fix the issue. </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	24 mins	</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">  <i class="icon-bullhorn"></i>	</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">	New order received. Please take care of it.  </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	30 mins	</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">    <i class="icon-bullhorn"></i>	</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">	New order received. Please take care of it.    </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	40 mins	</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-warning">    <i class="icon-plus"></i></div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">	New user registered.      </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	1.5 hours</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-success">       <i class="icon-bell-alt"></i></div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					Web server hardware needs to be upgraded. 

																					<span class="label label-inverse label-mini">Overdue</span>             

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	2 hours	</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label">        <i class="icon-bullhorn"></i></div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">New order received. Please take care of it.    </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	3 hours	</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-warning">     <i class="icon-bullhorn"></i>	</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">	New order received. Please take care of it.    </div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">	5 hours	</div>

																	</div>

																</li>


																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label">                       

																					<i class="icon-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					New order received. Please take care of it.                 

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">                        

																					<i class="icon-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					New order received. Please take care of it.                 

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			22 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label">                       

																					<i class="icon-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					New order received. Please take care of it.                 

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			21 hours

																		</div>

																	</div>

																</li>

																<li>

																	<div class="col1">

																		<div class="cont">

																			<div class="cont-col1">

																				<div class="label label-info">                        

																					<i class="icon-bullhorn"></i>

																				</div>

																			</div>

																			<div class="cont-col2">

																				<div class="desc">

																					New order received. Please take care of it.                 

																				</div>

																			</div>

																		</div>

																	</div>

																	<div class="col2">

																		<div class="date">

																			22 hours

																		</div>

																	</div>

																</li>

															</ul>

														</div><div class="slimScrollBar ui-draggable" style="background-color: rgb(161, 178, 189); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div>

													</div>

												</div>

												<!--tab-pane-->

											</div>

										</div>

									</div>

									<!--end span9-->

								</div>

								<!--end tab-pane-->

								<div class="tab-pane profile-classic row-fluid" id="tab_1_2">

									<div class="span2"><img src="asset/image/profile-img.png" alt=""> <a href="#" class="profile-edit">edit</a></div>

									<ul class="unstyled span10">

										<li><span>User Name:</span> JDuser</li>

										<li><span>First Name:</span> John</li>

										<li><span>Last Name:</span> Doe</li>

										<li><span>Counrty:</span> Spain</li>

										<li><span>Birthday:</span> 18 Jan 1982</li>

										<li><span>Occupation:</span> Web Developer</li>

										<li><span>Email:</span> <a href="#">john@mywebsite.com</a></li>

										<li><span>Interests:</span> Design, Web etc.</li>

										<li><span>Website Url:</span> <a href="#">http://www.mywebsite.com</a></li>

										<li><span>Mobile Number:</span> +1 646 580 DEMO (6284)</li>

										<li><span>About:</span> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</li>

									</ul>

								</div>

								<!--tab_1_2-->

								<div class="tab-pane row-fluid profile-account" id="tab_1_3">

									<div class="row-fluid">

										<div class="span12">

											<div class="span3">

												<ul class="ver-inline-menu tabbable margin-bottom-10">

													<li class="">

														<a data-toggle="tab" href="#tab_1-1">

														<i class="icon-cog"></i> 

														Personal info

														</a> 

														<span class="after"></span>                                    

													</li>

													<li class=""><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> Change Avatar</a></li>

													<li class=""><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> Change Password</a></li>

													<li class="active"><a data-toggle="tab" href="#tab_4-4"><i class="icon-eye-open"></i> Privacity Settings</a></li>

												</ul>

											</div>

											<div class="span9">

												<div class="tab-content">

													<div id="tab_1-1" class="tab-pane">

														<div style="height: auto;" id="accordion1-1" class="accordion collapse in">

															<form action="#">

																<label class="control-label">First Name</label>

																<input type="text" placeholder="John" class="m-wrap span8">

																<label class="control-label">Last Name</label>

																<input type="text" placeholder="Doe" class="m-wrap span8">

																<label class="control-label">Mobile Number</label>

																<input type="text" placeholder="+1 646 580 DEMO (6284)" class="m-wrap span8">

																<label class="control-label">Interests</label>

																<input type="text" placeholder="Design, Web etc." class="m-wrap span8">

																<label class="control-label">Occupation</label>

																<input type="text" placeholder="Web Developer" class="m-wrap span8">

																<label class="control-label">Counrty</label>

																<div class="controls">

																	<input type="text" class="span8 m-wrap" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;US&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">

																	<p class="help-block"><span class="muted">Start typing to auto complete!. E.g: US</span></p>

																</div>

																<label class="control-label">About</label>

																<textarea class="span8 m-wrap" rows="3"></textarea>

																<label class="control-label">Website Url</label>

																<input type="text" placeholder="http://www.mywebsite.com" class="m-wrap span8">

																<div class="submit-btn">

																	<a href="#" class="btn green">Save Changes</a>

																	<a href="#" class="btn">Cancel</a>

																</div>

															</form>

														</div>

													</div>

													<div id="tab_2-2" class="tab-pane">

														<div style="height: auto;" id="accordion2-2" class="accordion collapse in">

															<form action="#">

																<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>

																<br>

																<div class="controls">

																	<div class="thumbnail" style="width: 291px; height: 170px;">

																		<img src="asset/image/photo4.jpg" alt="">

																	</div>

																</div>

																<div class="space10"></div>

																<div class="fileupload fileupload-new" data-provides="fileupload">

																	<div class="input-append">

																		<div class="uneditable-input">

																			<i class="icon-file fileupload-exists"></i> 

																			<span class="fileupload-preview"></span>

																		</div>

																		<span class="btn btn-file">

																		<span class="fileupload-new">Select file</span>

																		<span class="fileupload-exists">Change</span>

																		<input type="file" class="default">

																		</span>

																		<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>

																	</div>

																</div>

																<div class="clearfix"></div>

																<div class="controls">

																	<span class="label label-important">NOTE!</span>

																	<span>You can write some information here..</span>

																</div>

																<div class="space10"></div>

																<div class="submit-btn">

																	<a href="#" class="btn green">Submit</a>

																	<a href="#" class="btn">Cancel</a>

																</div>

															</form>

														</div>

													</div>

													<div id="tab_3-3" class="tab-pane">

														<div style="height: auto;" id="accordion3-3" class="accordion collapse in">
														
															<form id="change-password-form"  method="post" action="<?php echo $action;?>">
															
																<div class="control-group">

																<label class="control-label">Current Password</label>

																<input type="password" class="m-wrap span7" name="old_password" id="old-password">
																
																</div>
																
																<div class="control-group">

																<label class="control-label">New Password</label>

																<input type="password" class="m-wrap span7" name="new_password" id="new-password">
																
																</div>
																
																<div class="control-group">

																<label class="control-label">Re-type New Password</label>

																<input type="password" class="m-wrap span7" name="r_password" id="r-password">
																
																</div>

																<div class="submit-btn">

																	<input type="submit" class="btn green change-password-button" value="Change Password">
																	
																	<input type="hidden" name="action" value="change_password" />

																	<a href="#" class="btn">Cancel</a>

																</div>

															</form>

														</div>

													</div>

													<div id="tab_4-4" class="tab-pane active">

														<div style="height: auto;" id="accordion4-4" class="accordion collapse in">

															<form action="#">

																<div class="profile-settings row-fluid">

																	<div class="span9">

																		<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..</p>

																	</div>

																	<div class="control-group span3">

																		<div class="controls">

																			<label class="radio">

																			<div class="radio"><span><input type="radio" name="optionsRadios1" value="option1"></span></div>

																			Yes

																			</label>

																			<label class="radio">

																			<div class="radio"><span class="checked"><input type="radio" name="optionsRadios1" value="option2" checked=""></span></div>

																			No

																			</label>  

																		</div>

																	</div>

																</div>

																<!--end profile-settings-->

																<div class="profile-settings row-fluid">

																	<div class="span9">

																		<p>Enim eiusmod high life accusamus terry richardson ad squid wolf moon</p>

																	</div>

																	<div class="control-group span3">

																		<div class="controls">

																			<label class="checkbox">

																			<div class="checker"><span><input type="checkbox" value=""></span></div> All

																			</label>

																			<label class="checkbox">

																			<div class="checker"><span><input type="checkbox" value=""></span></div> Friends

																			</label>

																		</div>

																	</div>

																</div>

																<!--end profile-settings-->

																<div class="profile-settings row-fluid">

																	<div class="span9">

																		<p>Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson</p>

																	</div>

																	<div class="control-group span3">

																		<div class="controls">

																			<label class="checkbox">

																			<div class="checker"><span><input type="checkbox" value=""></span></div> Yes

																			</label>

																		</div>

																	</div>

																</div>

																<!--end profile-settings-->

																<div class="profile-settings row-fluid">

																	<div class="span9">

																		<p>Cliche reprehenderit enim eiusmod high life accusamus terry</p>

																	</div>

																	<div class="control-group span3">

																		<div class="controls">

																			<label class="checkbox">

																			<div class="checker"><span><input type="checkbox" value=""></span></div> Yes

																			</label>

																		</div>

																	</div>

																</div>

																<!--end profile-settings-->

																<div class="profile-settings row-fluid">

																	<div class="span9">

																		<p>Oiusmod high life accusamus terry richardson ad squid wolf fwopo</p>

																	</div>

																	<div class="control-group span3">

																		<div class="controls">

																			<label class="checkbox">

																			<div class="checker"><span><input type="checkbox" value=""></span></div> Yes

																			</label>

																		</div>

																	</div>

																</div>

																<!--end profile-settings-->

																<div class="space5"></div>

																<div class="submit-btn">

																	<a href="#" class="btn green">Save Changes</a>

																	<a href="#" class="btn">Cancel</a>

																</div>

															</form>

														</div>

													</div>

												</div>

											</div>

											<!--end span9-->                                   

										</div>

									</div>

								</div>

								<!--end tab-pane-->

								<div class="tab-pane" id="tab_1_4">

									<div class="row-fluid add-portfolio">

										<div class="pull-left">

											<span>502 Items sold this week</span>

										</div>

										<div class="pull-left">

											<a href="#" class="btn icn-only green">Add a new Project <i class="m-icon-swapright m-icon-white"></i></a>                          

										</div>

									</div>

									<!--end add-portfolio-->

									<div class="row-fluid portfolio-block">

										<div class="span5 portfolio-text">

											<img src="asset/image/logo_metronic.jpg" alt="">

											<div class="portfolio-text-info">

												<h4>Metronic - Responsive Template</h4>

												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>

											</div>

										</div>

										<div class="span5" style="overflow:hidden;">

											<div class="portfolio-info">

												Today Sold

												<span>187</span>

											</div>

											<div class="portfolio-info">

												Total Sold

												<span>1789</span>

											</div>

											<div class="portfolio-info">

												Earns

												<span>$37.240</span>

											</div>

										</div>

										<div class="span2 portfolio-btn">

											<a href="#" class="btn bigicn-only"><span>Manage</span></a>                      

										</div>

									</div>

									<!--end row-fluid-->

									<div class="row-fluid portfolio-block">

										<div class="span5 portfolio-text">

											<img src="asset/image/logo_azteca.jpg" alt="">

											<div class="portfolio-text-info">

												<h4>Metronic - Responsive Template</h4>

												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>

											</div>

										</div>

										<div class="span5">

											<div class="portfolio-info">

												Today Sold

												<span>24</span>

											</div>

											<div class="portfolio-info">

												Total Sold

												<span>660</span>

											</div>

											<div class="portfolio-info">

												Earns

												<span>$7.060</span>

											</div>

										</div>

										<div class="span2 portfolio-btn">

											<a href="#" class="btn bigicn-only"><span>Manage</span></a>                      

										</div>

									</div>

									<!--end row-fluid-->

									<div class="row-fluid portfolio-block">

										<div class="span5 portfolio-text">

											<img src="asset/image/logo_conquer.jpg" alt="">

											<div class="portfolio-text-info">

												<h4>Metronic - Responsive Template</h4>

												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>

											</div>

										</div>

										<div class="span5" style="overflow:hidden;">

											<div class="portfolio-info">

												Today Sold

												<span>24</span>

											</div>

											<div class="portfolio-info">

												Total Sold

												<span>975</span>

											</div>

											<div class="portfolio-info">

												Earns

												<span>$21.700</span>

											</div>

										</div>

										<div class="span2 portfolio-btn">

											<a href="#" class="btn bigicn-only"><span>Manage</span></a>                      

										</div>

									</div>

									<!--end row-fluid-->

								</div>

								<!--end tab-pane-->

								<div class="tab-pane row-fluid active" id="tab_1_6">

									<div class="row-fluid">

										<div class="span12">

											<div class="span3">

												<ul class="ver-inline-menu tabbable margin-bottom-10">

													<li class="">

														<a data-toggle="tab" href="#tab_1">

														<i class="icon-briefcase"></i> 

														General Questions

														</a> 

														<span class="after"></span>                                    

													</li>

													<li class=""><a data-toggle="tab" href="#tab_2"><i class="icon-group"></i> Membership</a></li>

													<li class=""><a data-toggle="tab" href="#tab_3"><i class="icon-leaf"></i> Terms Of Service</a></li>

													<li class=""><a data-toggle="tab" href="#tab_1"><i class="icon-info-sign"></i> License Terms</a></li>

													<li class=""><a data-toggle="tab" href="#tab_2"><i class="icon-tint"></i> Payment Rules</a></li>

													<li class="active"><a data-toggle="tab" href="#tab_3"><i class="icon-plus"></i> Other Questions</a></li>

												</ul>

											</div>

											<div class="span9">

												<div class="tab-content">

													<div id="tab_1" class="tab-pane">

														<div style="height: auto;" id="accordion1" class="accordion collapse in">

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_1" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?

																	</a>

																</div>

																<div class="accordion-body collapse in" id="collapse_1">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	Pariatur cliche reprehenderit enim eiusmod highr brunch ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	Food truck quinoa nesciunt laborum eiusmod nim eiusmod high life accusamus  ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_4" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	High life accusamus terry richardson ad ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_4">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_5" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_5">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_6" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">

																	Wolf moon officia aute non cupidatat skateboard dolor brunch ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_6">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

														</div>

													</div>

													<div id="tab_2" class="tab-pane">

														<div style="height: auto;" id="accordion2" class="accordion collapse in">

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_1" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Cliche reprehenderit, enim eiusmod high life accusamus enim eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse in" id="collapse_2_1">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Pariatur cliche reprehenderit enim eiusmod high life non cupidatat skateboard dolor brunch ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_2">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_3" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Food truck quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_3">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_4" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	High life accusamus terry richardson ad squid enim eiusmod high ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_4">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_5" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_5">

																	<div class="accordion-inner">

																		<p>

																			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																		</p>

																		<p> 

																			moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor

																		</p>

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_6" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Wolf moon officia aute non cupidatat skateboard dolor brunch ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_6">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_2_7" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_2_7">

																	<div class="accordion-inner">

																		<p>

																			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																		</p>

																		<p> 

																			moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor

																		</p>

																	</div>

																</div>

															</div>

														</div>

													</div>

													<div id="tab_3" class="tab-pane active">

														<div style="height: auto;" id="accordion3" class="accordion collapse in">

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_1" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Cliche reprehenderit, enim eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse in" id="collapse_3_1">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_2" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Pariatur skateboard dolor brunch ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_2">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_3" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Food truck quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_3">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_4" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	High life accusamus terry richardson ad squid enim eiusmod high ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_4">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_5" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high  eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_5">

																	<div class="accordion-inner">

																		<p>

																			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																		</p>

																		<p> 

																			moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor

																		</p>

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_6" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_6">

																	<div class="accordion-inner">

																		Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_7" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high life accusamus aborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_7">

																	<div class="accordion-inner">

																		<p>

																			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																		</p>

																		<p> 

																			moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor

																		</p>

																	</div>

																</div>

															</div>

															<div class="accordion-group">

																<div class="accordion-heading">

																	<a href="#collapse_3_8" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed">

																	Reprehenderit enim eiusmod high life accusamus terry quinoa nesciunt laborum eiusmod ?

																	</a>

																</div>

																<div class="accordion-body collapse" id="collapse_3_8">

																	<div class="accordion-inner">

																		<p>

																			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.

																		</p>

																		<p> 

																			moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmodBrunch 3 wolf moon tempor

																		</p>

																	</div>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

											<!--end span9-->                                   

										</div>

									</div>

								</div>

								<!--end tab-pane-->

							</div>

						</div>

						<!--END TABS-->

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

		   App.init(); 

	          $('#change-password-form').validate({
		            errorElement: 'label', //default input error message container
		            errorClass: 'help-inline', // default input error message class
		            focusInvalid: false, // do not focus the last invalid input
		            rules: {
		                old_password: {
		                    required: true,
		                    remote:{
		                    	type:"POST",
		                    	 url:"index.php?route=common/profile/validate",  
		                    	data:{
		                    		action:'check_oldpswd',
		                    		old_password:function(){
		                    			return $('#old-password').val();
		                    		}
		                    	}
		                    }
		                },
		                new_password: {
		                    required: true
		                },
		                r_password: {
		                	equalTo: "#new-password"
		                }
		            },

		            messages: {
		                old_password: {
		                    required: "Current Password is required.",
		                    remote:"No Match!"
		                },
		                new_password: {
		                    required: "New Password is required."
		                }
		            },

		            invalidHandler: function (event, validator) { //display error alert on form submit   
		                $('.alert-error', $('#change-password-form')).show();
		            },

		            highlight: function (element) { // hightlight error inputs
		                $(element).closest('.control-group')
		                    .addClass('error'); // set error class to the control group
		            },

		            success: function (label) {
		                label.closest('.control-group')
		                		.removeClass('error');
		                label.remove();
		            },

		            errorPlacement: function (error, element) {
		                error.addClass('help-small').insertAfter(element);
		            }
		        });

		});

	</script>
	
<?php echo $footer; ?>