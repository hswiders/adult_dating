<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title>Adult</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.4.1/css/all.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:300,400,500,600" rel="stylesheet"> 
	<link rel="stylesheet" href="{{ url('/public/front') }}/assets/css/vendor.bundle.css">
	<link rel="stylesheet" href="{{ url('/public/front') }}/assets/css/app.bundle.css">
	<link rel="stylesheet" href="{{ url('/public/front') }}/assets/css/theme-a.css">
	<link rel="stylesheet" href="{{ url('/public/front') }}/assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  />
	<link rel="stylesheet" href="{{ asset('plugins/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css') }}"  />
	

	<style type="text/css">
		li.logo-icon {
    padding: 16px;
}
.blockUI.blockMsg.blockPage , .blockUI.blockOverlay {
    z-index: 9999!important;
}
	</style>
</head>

<body>
	<div id="app_wrapper">
		<header id="app_topnavbar-wrapper">
			<nav role="navigation" class="navbar topnavbar">
				<div class="nav-wrapper">
					<div id="logo_wrapper" class="nav navbar-nav">
						<ul>
							<li class="logo-icon">
								 <a href="{{ url('/') }}"><img src="{{ url('/public/front') }}/assets/img/logo.png" style="width:100px" alt="Logo"></a>
							</li>
						</ul>
					</div>
					<ul class="nav navbar-nav left-menu hidden-lg">
						<li class="menu-icon">
							<a href="javascript:void(0)" role="button" data-toggle-state="app_sidebar-menu-collapsed" data-key="leftSideBar">
								<i class="mdi mdi-backburger"></i>
							</a>
						</li>
					</ul>
					<!-- <ul class="nav navbar-nav left-menu">
						<li>
							<a href=" ">
								<div class="logo">
									<img src="assets/img/logo.png" style="width:100px" alt="Logo">
								</div> 
							</a>
						</li>					
					</ul> -->
					<ul class="nav navbar-nav pull-right">
						 
						<li class="dropdown hidden-xs hidden-sm">
							<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
								@if (getUnreadNotifications(auth()->user()->id))
									<span class="badge mini status danger"></span>
								@endif
								
								<i class="zmdi zmdi-notifications"></i>
							</a>
							<ul class="dropdown-menu dropdown-lg-menu dropdown-menu-right dropdown-alt">
								<li class="dropdown-menu-header">
									<ul class="card-actions icons  left-top">
										<li class="withoutripple">
											{{-- <a href="javascript:void(0)" class="withoutripple">
												<i class="zmdi zmdi-settings"></i>
											</a> --}}
										</li>
									</ul>
									<h5>NOTIFICATIONS</h5>
									<ul class="card-actions icons right-top">
										{{-- <li>
											<a href="javascript:void(0)" >
												<i class="zmdi zmdi-check-all"></i>
											</a>
										</li> --}}
									</ul>
								</li>
								@forelse (getNotifications(auth()->user()->id) as $element)
								@php
									$others = unserialize($element->other);

								@endphp
									<li>
									<div class="card">
										<a href="javascript:void(0)" data-url="{{ $others['redirect_to'] }}" onclick="markAsRead('{{ $element->id }}' , this , 'yes')" class="pull-right dismiss" data-dismiss="close">
											<i class="zmdi zmdi-close"></i>
										</a>
										<div class="card-body">
											<a href="javascript:void(0)" data-url="{{ $others['redirect_to'] }}" onclick="markAsRead('{{ $element->id }}' , this)" style="padding: 0;line-height: 1;">
											<ul class="list-group ">
												<li class="list-group-item ">
													<span class="pull-left"><img src="assets/img/profiles/11.jpg" alt="" class="img-circle max-w-40 m-r-10 "></span>
													<div class="list-group-item-body">
														{{-- <div class="list-group-item-heading">Dakota Johnson</div> --}}
														<div class="list-group-item-text">{{ $element->message }}</div>
													</div>
												</li>
											</ul>
											</a>
										</div>
									</div>
								</li>
								@empty
									<li>
										<div class="card">
											<div class="card-body">
												<p>No Notification found!</p>
											</div>
										</div>
									</li>
								@endforelse
								
								<li class="dropdown-menu-footer">
									<a href="javascript:void(0)">
										All notifications
									</a>
								</li>
							</ul>
						</li>

						<li >
							<a class="comming_soon" href="dashboard_wallet.php" data>
								<i class="fas fa-wallet"></i>
							</a>
						</li>
						
						<li class="last">
							@php 
		$profileimage= asset(auth()->user()->profileimage); 
		@endphp
							<a href="javascript:void(0)" data-toggle-state="sidebar-overlay-open" data-key="rightSideBar">
								<div class="set-image-text">
									<img src="{{ $profileimage }}">
									<span>{{ auth()->user()->first_name }}</span>
									<label class="status-show online">
										<i class="badge mini status succuess"></i>
									</label>
								</div>
							</a>
						</li>



					</ul>
				</div> 
			</nav>
		</header>

	@include('front.users.layouts.sidebar')
	@yield('content')
	@include('front.users.layouts.footer')
	@yield('right_sidebar')
	@yield('scripts')