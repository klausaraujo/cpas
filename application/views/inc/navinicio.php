	<link rel="stylesheet"
	href="<?=base_url()?>public/css/nav.css" />
<!-- Preloader -->
	<div class="preloader-it" style="display: none;">
		<div class="la-anim-1 la-animate"></div>
	</div>
	<!-- /Preloader -->
		<!-- Top Menu Items -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="nav-wrap">
				<div class="mobile-only-brand pull-left">
					<div class="nav-header pull-left">
						<div class="logo-wrap">
							<a href="javascript:;">
								<img class="brand-img" src="<?=base_url()?>public/images/logo-brand-responsive.jpg" alt="Sireed">
								<span class="brand-text full"><img src="<?=base_url()?>public/images/logo-brand-full.png" alt="Sireed"></span>
								<span class="brand-text responsive"><img src="<?=base_url()?>public/images/logo-brand-responsive.jpg" alt="Sireed"></span>
							</a>
						</div>
					</div>	
					<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
					<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search hidden-xs hidden-sm hidden-md hidden-lg"></i></a>
					<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
					<form id="search_form" role="search" class="top-nav-search collapse pull-left d-none">
						<div class="input-group">
							<input type="text" name="example-input1-group2" id="busquedaEvento" class="form-control" placeholder="Buscar...">
							<span class="input-group-btn">
							<button type="button" class="btn  btn-default" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
							</span>
						</div>						
						<div id="suggesstion-box"></div>
					</form>
				</div>
				<div id="mobile_only_nav" class="mobile-only-nav pull-right">
					<ul class="nav navbar-right top-nav pull-right">
						
						<li class="dropdown alert-drp" style="display:none;">
							<a href="<?=base_url()?>/demo-1/index.html#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge"></span></a>
							<ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
								<li>
									<div class="notification-box-head-wrap">
										<span class="notification-box-head pull-left inline-block">Notificaciones</span>
										<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> Limpiar todo </a>
										<div class="clearfix"></div>
										<hr class="light-grey-hr ma-0">
									</div>
								</li>
								<li>
									<div class="slimScrollDiv"><div class="streamline message-nicescroll-bar">										
										<div class="sl-item">
											<a href="javascript:void(0)">
												<div class="icon bg-yellow">
													<i class="zmdi zmdi-trending-down"></i>
												</div>
												<div class="sl-content">
													<span class="inline-block capitalize-font  pull-left truncate head-notifications txt-warning">Server #2 not responding</span>
													<span class="inline-block font-11 pull-right notifications-time">1pm</span>
													<div class="clearfix"></div>
													<p class="truncate">Some technical error occurred needs to be resolved.</p>
												</div>
											</a>	
										</div>
										<hr class="light-grey-hr ma-0">
										
									</div><div class="slimScrollBar"></div><div class="slimScrollRail"></div></div>
								</li>
								<li>
									<div class="notification-box-bottom-wrap">
										<hr class="light-grey-hr ma-0">
										<a class="block text-center read-all" href="javascript:void(0)"> Leer todo </a>
										<div class="clearfix"></div>
									</div>
								</li>
							</ul>
						</li>
						
						<li style="display:none;">
							<a id="open_right_sidebar" href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-settings  top-nav-icon"></i></a>
						</li>
						<?php $imagen = $this->session->userdata("avatar"); ?>
						<!-- Datos de Usuario -->
						<li class="dropdown auth-drp">
							<a href="<?=base_url()?>/demo-1/index.html#" class="dropdown-toggle pr-0" data-toggle="dropdown" aria-expanded="true">
							<img src="<?=base_url()?>public/images/perfil/<?=$imagen?>" alt="user_auth" class="user-auth-img img-circle"><span class="user-online-status"></span><span class="user-auth-name inline-block"><?=$this->session->userdata("nombre")?> <?=$this->session->userdata("apellido")?> <span class="ti-angle-down"></span></span></a>
							<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
								<li>
									<a href="<?=base_url()?>usuario/perfil"><i class="zmdi zmdi-account"></i><span>Perf&iacute;l</span></a>
								</li>
								<li style="display:none;">
									<a href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
								</li>
								<li>
									<a href="<?=base_url()?>usuario/inbox"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
								</li>
								<li style="display:none;">
									<a href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
								</li>
								<li class="divider" style="display:none"></li>
								<li class="sub-menu show-on-hover" style="display:none">
									<a href="<?=base_url()?>/demo-1/index.html#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
									<ul class="dropdown-menu open-left-side">
										<li>
											<a href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
										</li>
										<li>
											<a href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
										</li>
										<li>
											<a href="<?=base_url()?>/demo-1/index.html#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
										</li>
									</ul>	
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?=base_url()?>login/logout"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
								</li>
							</ul>
						</li>
					</ul>
				</div>	
				</div>
			</nav>
			<!-- /Top Menu Items -->
			
			<!-- Left Sidebar Menu -->
			<div class="fixed-sidebar-left">
				<div class="slimScrollDiv" >
				<ul class="nav navbar-nav side-nav nicescroll-bar">
					<li class="navigation-header">
						<span><?=TITULO_MAIN?></span> 
						<hr>
					</li>
					<li>
						<a href="<?=base_url()?>"><div class="pull-left"><i class="fa fa-home mr-20"></i><span class="right-nav-text"></span></div>Inicio</a>
					</li>
					
					<?php 
						$listaModulos = $this->session->userdata("modulos");
						foreach($listaModulos as $row): ?>
					<li>
					<?php  if($row->estado>0){ ?>
						<a href="<?=base_url()?><?=$row->url?>">
							<div class="pull-left"><i class="<?=$row->mini?> mr-20"></i><span class="right-nav-text"></span></div><?=$row->menu?>
						</a>
					<?php 
                    }else{
					   ?>
						<a href="javascript:;" class="disabled" style="color: #CCC!important"><div class="pull-left disabled"><i class="<?=$row->mini?> mr-20"></i><span class="right-nav-text"></span></div><?=$row->menu?></a>
					<?php 
					}
					?>
					</li>
					<?php endforeach; ?>
					
				</ul>
				<div class="slimScrollBar"></div>
				<div class="slimScrollRail"></div>
				</div>
			</div>
			<!-- /Left Sidebar Menu -->
			
			<!-- Right Sidebar Menu -->
			<div class="fixed-sidebar-right">
				<ul class="right-sidebar">
					<li>
						<div class="tab-struct custom-tab-1">
							<ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
								<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="chat_tab_btn" href="<?=base_url()?>/demo-1/index.html#chat_tab">chat</a></li>
								<li role="presentation" class="">
									<a data-toggle="tab" id="messages_tab_btn" role="tab" href="<?=base_url()?>/demo-1/index.html#messages_tab" aria-expanded="false">messages</a>
								</li>
								<li role="presentation" class="">
									<a data-toggle="tab" id="todo_tab_btn" role="tab" href="<?=base_url()?>/demo-1/index.html#todo_tab" aria-expanded="false">todo</a>
								</li>
							</ul>
							<div class="tab-content" id="right_sidebar_content">
								<div id="chat_tab" class="tab-pane fade active in" role="tabpanel">
									<div class="chat-cmplt-wrap">
										<div class="chat-box-wrap">
											<div class="add-friend">
												<a href="javascript:void(0)" class="inline-block txt-grey">
													<i class="zmdi zmdi-more"></i>
												</a>	
												<span class="inline-block txt-dark">users</span>
												<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
												<div class="clearfix"></div>
											</div>
											<form role="search" class="chat-search pl-15 pr-15 pb-15">
												<div class="input-group">
													<input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
													<span class="input-group-btn">
													<button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
													</span>
												</div>
											</form>
											<div id="chat_list_scroll" style="height: 489px;">
												<div class="slimScrollDiv"><div class="nicescroll-bar">
													<ul class="chat-list-wrap">
														<li class="chat-list">
															<div class="chat-body">
																<a href="javascript:void(0)">
																	<div class="chat-data">
																		<img class="user-img img-circle" src="" alt="user">
																		<div class="user-data">
																			<span class="name block capitalize-font">Mitsuko Heid</span>
																			<span class="time block truncate txt-grey">I thankful.</span>
																		</div>
																		<div class="status online"></div>
																		<div class="clearfix"></div>
																	</div>
																</a>
																<a href="javascript:void(0)">
																	<div class="chat-data">
																		<img class="user-img img-circle" src="" alt="user">
																		<div class="user-data">
																			<span class="name block capitalize-font">Ezequiel Merideth</span>
																			<span class="time block truncate txt-grey">Patience is bitter.</span>
																		</div>
																		<div class="status offline"></div>
																		<div class="clearfix"></div>
																	</div>
																</a>
																<a href="javascript:void(0)">
																	<div class="chat-data">
																		<img class="user-img img-circle" src="" alt="user">
																		<div class="user-data">
																			<span class="name block capitalize-font">Angelic Lauver</span>
																			<span class="time block truncate txt-grey">Every burden is a blessing.</span>
																		</div>
																		<div class="status away"></div>
																		<div class="clearfix"></div>
																	</div>
																</a>
															</div>
														</li>
													</ul>
												</div>
												<div class="slimScrollBar"></div>
												<div class="slimScrollRail"></div></div>
											</div>
										</div>
										<div class="recent-chat-box-wrap">
											<div class="recent-chat-wrap">
												<div class="panel-heading ma-0">
													<div class="goto-back">
														<a id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
															<i class="zmdi zmdi-chevron-left"></i>
														</a>	
														<span class="inline-block txt-dark">ryan</span>
														<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
														<div class="clearfix"></div>
													</div>
												</div>
												<div class="panel-wrapper collapse in">
													<div class="panel-body pa-0">
														<div class="chat-content" style="height: 480px;">
															<div class="slimScrollDiv"><ul class="nicescroll-bar pt-20">
																<li class="friend">
																	<div class="friend-msg-wrap">
																		<img class="user-img img-circle block pull-left" src="" alt="user">
																		<div class="msg pull-left">
																			<p>Hello Jason, how are you, it's been a long time since we last met?</p>
																			<div class="msg-per-detail text-right">
																				<span class="msg-time txt-light">2:30 PM</span>
																			</div>
																		</div>
																		<div class="clearfix"></div>
																	</div>	
																</li>
																<li class="self mb-10">
																	<div class="self-msg-wrap">
																		<div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
																			<div class="msg-per-detail text-right">
																				<span class="msg-time txt-light">2:31 pm</span>
																			</div>
																		</div>
																		<div class="clearfix"></div>
																	</div>	
																</li>
																<li class="self">
																	<div class="self-msg-wrap">
																		<div class="msg block pull-right">  How about you?
																			<div class="msg-per-detail text-right">
																				<span class="msg-time txt-light">2:31 pm</span>
																			</div>
																		</div>
																		<div class="clearfix"></div>
																	</div>	
																</li>
																<li class="friend">
																	<div class="friend-msg-wrap">
																		<img class="user-img img-circle block pull-left" src="" alt="user">
																		<div class="msg pull-left"> 
																			<p>Not too bad.</p>
																			<div class="msg-per-detail  text-right">
																				<span class="msg-time txt-light">2:35 pm</span>
																			</div>
																		</div>
																		<div class="clearfix"></div>
																	</div>	
																</li>
															</ul><div class="slimScrollBar"></div><div class="slimScrollRail"></div></div>
														</div>
														<div class="input-group">
															<input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
															<div class="input-group-btn emojis">
																<div class="dropup">
																	<button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-mood"></i></button>
																	<ul class="dropdown-menu dropdown-menu-right">
																		<li><a href="javascript:void(0)">Action</a></li>
																		<li><a href="javascript:void(0)">Another action</a></li>
																		<li class="divider"></li>
																		<li><a href="javascript:void(0)">Separated link</a></li>
																	</ul>
																</div>
															</div>
															<div class="input-group-btn attachment">
																<div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
																	<input type="file" class="upload">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
									
								<div id="messages_tab" class="tab-pane fade" role="tabpanel">
									<div class="message-box-wrap">
										<div class="msg-search">
											<a href="javascript:void(0)" class="inline-block txt-grey">
												<i class="zmdi zmdi-more"></i>
											</a>	
											<span class="inline-block txt-dark">messages</span>
											<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-search"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="set-height-wrap" style="height: 540px;">
											<div class="slimScrollDiv"><div class="streamline message-box nicescroll-bar">
												<a href="javascript:void(0)">
													<div class="sl-item unread-message">
														<div class="sl-avatar avatar avatar-sm avatar-circle">
															<img class="img-responsive img-circle" src="" alt="avatar">
														</div>
														<div class="sl-content">
															<span class="inline-block capitalize-font   pull-left message-per">Clay Masse</span>
															<span class="inline-block font-11  pull-right message-time">12:28 AM</span>
															<div class="clearfix"></div>
															<span class=" truncate message-subject">Themeforest message sent via your envato market profile</span>
															<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsu messm quia dolor sit amet, consectetur, adipisci velit</p>
														</div>
													</div>
												</a>
												<a href="javascript:void(0)">
													<div class="sl-item">
														<div class="sl-avatar avatar avatar-sm avatar-circle">
															<img class="img-responsive img-circle" src="" alt="avatar">
														</div>
														<div class="sl-content">
															<span class="inline-block capitalize-font   pull-left message-per">Evie Ono</span>
															<span class="inline-block font-11  pull-right message-time">1 Feb</span>
															<div class="clearfix"></div>
															<span class=" truncate message-subject">Pogody theme support</span>
															<p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
														</div>
													</div>
												</a>
											</div><div class="slimScrollBar"></div><div class="slimScrollRail"></div></div>
										</div>
									</div>
								</div>
								<div id="todo_tab" class="tab-pane fade" role="tabpanel">
									<div class="todo-box-wrap">
										<div class="add-todo">
											<a href="javascript:void(0)" class="inline-block txt-grey">
												<i class="zmdi zmdi-more"></i>
											</a>	
											<span class="inline-block txt-dark">todo list</span>
											<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
											<div class="clearfix"></div>
										</div>
										<div class="set-height-wrap" style="height: 540px;">
											<!-- Todo-List -->
											<div class="slimScrollDiv"><ul class="todo-list nicescroll-bar">												
												<li class="todo-item">
													<div class="checkbox checkbox-warning">
														<input type="checkbox" id="checkbox03" checked="">
														<label for="checkbox03">Decide The Live Discussion Time</label>
													</div>
												</li>
												<li>
													<hr class="light-grey-hr">
												</li>
											</ul>
											<div class="slimScrollBar"></div>
											<div class="slimScrollRail"></div>
											</div>
											<!-- /Todo-List -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<!-- /Right Sidebar Menu -->
				
			<!-- Right Setting Menu -->
			<div class="setting-panel">
				<div class="slimScrollDiv"><ul class="right-sidebar nicescroll-bar pa-0">
					<li class="layout-switcher-wrap">
						<ul>
							<li>
								<span class="layout-title">Cabecera fija</span>
								<span class="layout-switcher">
									<input type="checkbox" id="switch_3" class="js-switch" data-color="00acf0" data-secondary-color="#dedede" data-size="small" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(222, 222, 222) 0px 0px 0px 0px inset; border-color: rgb(222, 222, 222); background-color: rgb(222, 222, 222); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
								</span>	
								<h6 class="mt-30 mb-15">Color men&uacute;</h6>
								<ul class="theme-option-wrap">
									<li id="theme-1"><i class="zmdi zmdi-check"></i></li>
									<li id="theme-2" class="active-theme"><i class="zmdi zmdi-check"></i></li>
								</ul>
								<h6 class="mt-30 mb-15">Color Cabecera</h6>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-blue" value="navbar-top-blue">
									<label class="capitalize-font" for="navbar-top-blue"> blue </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-skyblue" value="navbar-top-skyblue">
									<label class="capitalize-font" for="navbar-top-skyblue"> skyblue </label>
								</div>
								
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-purple" value="navbar-top-purple">
									<label class="capitalize-font" for="navbar-top-purple"> purple </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-pink" value="navbar-top-pink">
									<label class="capitalize-font" for="navbar-top-pink"> pink </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-red" value="navbar-top-red">
									<label class="capitalize-font" for="navbar-top-red"> red </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-yellow" value="navbar-top-yellow">
									<label class="capitalize-font" for="navbar-top-yellow"> yellow </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-green" value="navbar-top-green">
									<label class="capitalize-font" for="navbar-top-green"> green </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-teal" value="navbar-top-teal">
									<label class="capitalize-font" for="navbar-top-teal"> teal </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-violet" value="navbar-top-violet">
									<label class="capitalize-font" for="navbar-top-violet"> violet </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-chrome" value="navbar-top-chrome">
									<label class="capitalize-font" for="navbar-top-chrome"> chrome </label>
								</div>
								<div class="radio mb-5">
									<input type="radio" name="radio-topbar-color" id="navbar-top-orange" value="navbar-top-orange">
									<label class="capitalize-font" for="navbar-top-orange"> orange </label>
								</div>
								
								<div class="radio mb-35">
									<input type="radio" name="radio-topbar-color" id="navbar-top-light" value="navbar-top-light">
									<label class="capitalize-font" for="navbar-top-light"> light </label>
								</div>
								<button id="reset_setting" class="btn  btn-info btn-xs btn-outline btn-rounded mb-10">reset</button>
							</li>
						</ul>
					</li>
				</ul><div class="slimScrollBar"></div><div class="slimScrollRail"></div></div>
			</div>
			<button id="setting_panel_btn" style="display:none;" class="btn btn-info btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
			<!-- /Right Setting Menu -->