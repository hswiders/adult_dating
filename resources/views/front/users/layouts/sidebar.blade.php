<aside id="app_sidebar-left">
			<nav id="app_main-menu-wrapper" class="scrollbar">
				<div class="sidebar-inner sidebar-push">
					<div class="card profile-menu" id="profile-menu"> 
						<ul class="submenu">
							<li>
								<a href="page-profile.html" class="comming_soon"><i class="zmdi zmdi-account"></i> Profile</a>
							</li>
							<li>
								<a href="app-mail.html" class="comming_soon"><i class="zmdi zmdi-email"></i> Messages</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="comming_soon"><i class="zmdi zmdi-settings"></i> Account Settings</a>
							</li>
							<li>
								<a href="{{  route('user-logout')  }}"><i class="zmdi zmdi-sign-in"></i> Sign Out</a>
							</li>
						</ul>
					</div>
					<ul class="nav nav-pills nav-stacked" id="left-side-menu"> 
						<li class=""><a href="{{  route('user-dashboard')  }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>
						<li class=""><a href="{{route('user-list',['close'])}}" class=""><i class="zmdi zmdi-male-female"></i>Close to you</a></li>
						<li class=""><a href="{{route('user-list',['online'])}}" class=""><i class="zmdi zmdi-check-circle-u"></i>Online Now</a></li>
						<li class=""><a href="{{route('user-list',['country'])}}" class=""><i class="zmdi zmdi-pin-account"></i>New Аrrivals {{getCountry(auth()->user()->country , 'name')}}</a></li>
						<li class=""><a href="{{route('user-list',['all'])}}" class=""><i class="zmdi zmdi-globe"></i>New Аrrivals World</a></li>
						<li class=""><a href="social_status.php" class="comming_soon"><i class="zmdi zmdi-sort-amount-asc"></i>Social Status</a></li>
						<li class=""><a href="host_you.php" class="comming_soon"><i class="zmdi zmdi-label"></i>To host you</a></li>
						<li class=""><a href="host_them.php" class="comming_soon"><i class="zmdi zmdi-wallpaper"></i>To host them</a></li>
						<li class=""><a href="travel_together.php" class="comming_soon"><i class="zmdi zmdi-thumb-up-down"></i>Travel together</a></li>
						
						</ul>
					</div>
				</nav>
			</aside>
			