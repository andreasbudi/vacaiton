<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Difinite') }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
	  });

	</script>

	<style>
	meter {
	/* Reset the default appearance */
	-webkit-appearance: none;
		-moz-appearance: none;
			appearance: none;

	margin: 0 auto 1em;
	width: 100%;
	height: 0.5em;

	/* Applicable only to Firefox */
	background: none;
	background-color: rgba(0, 0, 0, 0.1);
	}

	meter::-webkit-meter-bar {
	background: none;
	background-color: rgba(0, 0, 0, 0.1);
	}

	/* Webkit based browsers */
	meter[value="1"]::-webkit-meter-optimum-value { background: red; }
	meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
	meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
	meter[value="4"]::-webkit-meter-optimum-value { background: green; }

	/* Gecko based browsers */
	meter[value="1"]::-moz-meter-bar { background: red; }
	meter[value="2"]::-moz-meter-bar { background: yellow; }
	meter[value="3"]::-moz-meter-bar { background: orange; }
	meter[value="4"]::-moz-meter-bar { background: green; }
	.fc-sun { color:red; }
	.fc-sat { color:red;  }
	</style>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <link href="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors -->
    <link href="../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
	<link rel="shortcut icon" href="../../assets/demo/default/media/img/logo/favicon.ico" />
	@toastr_css

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="/home" class="m-brand__logo-wrapper">
										<img alt="" src="../../assets/demo/default/media/img/logo/logo_default_dark.png"/>
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">
									<!-- BEGIN: Left Aside Minimize Toggle -->
									
									<!-- END -->

									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
								
									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>

									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>
						<!-- END: Brand -->

						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
								<i class="la la-close"></i>
							</button>
							<!-- END: Horizontal Menu -->

							<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="../../assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
											</a>
											<div class="m-dropdown__wrapper" style="width:295px;">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																<img src="../../assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{ (Auth::user()->name) }}
																</span>
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
																</li>
																<li class="m-nav__item">
																	<a href="{{route('employee.edit',Auth::user())}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																				<span class="m-nav__link-badge">
																					{{-- <span class="m-badge m-badge--success">
																						2
																					</span> --}}
																				</span>
																			</span>
																		</span>
																	</a>
																</li>
														
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="{{ route('logout')}}" onclick="event.preventDefault(); 
																	document.getElementById('logout-form').submit();" 
																	class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" style="color:blue;">
																	Logout
																	</a>
																	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																	@csrf
																	</form>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
								
									</ul>
								</div>
							</div>
							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>
			<!-- END: Header -->
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item 	m-aside-left  m-aside-left--skin-dark" >
					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark"  data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow" style="position:fixed; width:13%">

							@if (Auth::user()->role_id == '1')
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a href="/home" class="m-menu__link ">
									<i class="m-menu__link-icon fa fa-glass"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
										</span>
									</span>
								</a>
                            </li>
                            <li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="{{ route('leave.create')}}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-interface-7"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Apply Leave
											</span>
										</span>
									</span>
								</a>
                            </li>
							@elseif (Auth::user()->role_id == '2')
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
									<a href="{{route('approval.index')}}" class="m-menu__link ">
										<i class="m-menu__link-icon fa fa-glass"></i>
										<span class="m-menu__link-title">
											<span class="m-menu__link-wrap">
												<span class="m-menu__link-text">
													Dashboard
												</span>
											</span>
										</span>
									</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true">
								<a  href="{{ route('leave.create')}}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-interface-7"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Apply Leave
											</span>
										</span>
									</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="{{route('leave.index')}}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-folder"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Leave History
											</span>
										</span>
									</span>
								</a>
							</li>

						{{--	<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="{{route('approval.index')}}" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-folder"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Approval
											</span>
										</span>
									</span>
								</a>
							</li> --}}

							@elseif (Auth::user()->role_id == '3')
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
									<a  href="{{route('approval.index')}}" class="m-menu__link ">
										<i class="m-menu__link-icon fa fa-glass"></i>
										<span class="m-menu__link-title">
											<span class="m-menu__link-wrap">
												<span class="m-menu__link-text">
													Dashboard
												</span>
											</span>
										</span>
									</a>
								</li>

							@else
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="/show" class="m-menu__link ">
									<i class="m-menu__link-icon fa fa-glass"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
													Dashboard
											</span>
										</span>
									</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="{{ route('employee.create')}}" class="m-menu__link ">
									<i class="m-menu__link-icon la la-user-plus"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Add Employee
											</span>
										</span>
									</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="/showsupervisor" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-profile"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Add Supervisor
											</span>
										</span>
									</span>
								</a>
							</li>

						{{--	<li class="m-menu__item  m-menu__item" aria-haspopup="true" >
								<a  href="{{ route('role.create')}}" class="m-menu__link ">
									<i class="m-menu__link-icon la la-user-plus"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Add Role
											</span>
										</span>
									</span>
								</a>
							</li> --}}

							@endif
								
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					
                                <main>
                                    @yield('content')
                                </main>
					
				</div>

			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->

		<!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>

        <script src="../../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="../../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<script src="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
		<script src="../../assets/vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>

		<!-- <script src="../../assets/demo/default/custom/components/calendar/external-events.js" type="text/javascript"></script> -->
		
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<script src="../../assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
		
		@stack('scripts')
		
		@toastr_render
	</body>
	<!-- end::Body -->
</html>
