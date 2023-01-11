<aside id="app_sidebar-left">
			<nav id="app_main-menu-wrapper" class="scrollbar">
				<div class="sidebar-inner sidebar-push">
					
					<ul class="nav nav-pills nav-stacked"> 
						<li class=""><a href="{{route('wallet-dashboard')}}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>
						
						@if (auth()->user()->gender == 'male')

						<li class=""><a href="{{route('select-package')}}"><i class="zmdi zmdi-male-female"></i>Load Coins/Credits</a></li>
						<li class=""><a href="{{route('price-list')}}"><i class="zmdi zmdi-sort-amount-asc"></i>Price list</a></li>
						@else
						<li class="comming_soon"><a href="javascript:;"><i class="zmdi zmdi-check-circle-u"></i>Account Balance</a></li>
						@endif
						
						{{-- <li class=""><a href="your_power.php"><i class="zmdi zmdi-pin-account"></i>Your power</a></li> --}}
						<!-- <li class=""><a href="#"><i class="zmdi zmdi-globe"></i>Auto Messages</a></li> -->
						

						
						
						 
						</ul>
					</div>
				</nav>
			</aside>