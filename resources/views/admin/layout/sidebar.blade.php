<div class="app-menu navbar-menu">

	<!-- LOGO -->

	<div class="navbar-brand-box">

		<!-- Dark Logo-->

		<a href="{{route('admin.dashboard')}}" class="logo logo-dark">

			<span class="logo-sm">

				<!-- <img src="{{ url('/public/admin') }}/images/logo-01.png" alt="" style="height:auto;width:100px;"> -->

				{{ env('APP_LOGO_NAME') }}

			</span>

			<span class="logo-lg">

				<!-- <img src="{{ url('/public/admin') }}/images/logo-01.png" alt="" style="height:auto;width:100px;"> -->

				{{ env('APP_LOGO_NAME') }}

			</span>

		</a>

		<!-- Light Logo-->

		<a href="{{route('admin.dashboard')}}" class="logo logo-light">

			<span class="logo-sm">

				<!-- <img src="{{ url('/public/admin') }}/images/logo-01.png" alt="" style="height:auto;width:100px;"> -->

				{{ env('APP_LOGO_NAME') }}

			</span>

			<span class="logo-lg">

				<!-- <img src="{{ url('/public/admin') }}/images/logo-01.jpg" alt="" style="height:auto;width:100px;"> -->

				{{ env('APP_LOGO_NAME') }}

			</span>

		</a>

		<button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">

				<i class="ri-record-circle-line"></i>

		</button>

	</div>



	<div id="scrollbar">

		<div class="container-fluid">



			<div id="two-column-menu">

			</div>

			<ul class="navbar-nav" id="navbar-nav">

				<li class="menu-title"><span data-key="t-menu">Menu</span></li>

				<li class="nav-item">

					<a href="{{ route('admin.dashboard') }}" class="nav-link" data-key="t-one-page"><i class="ri-dashboard-2-line"></i> Dashboard </a>

				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

						<i class="ri-user-2-line"></i> <span data-key="t-dashboards">Users Management</span>

					</a>
					<div class="menu-dropdown collapse" id="sidebarDashboards" style="">

						<ul class="nav nav-sm flex-column">

							<li class="nav-item">

								<a href="{{ route('admin.user') }}" class="nav-link" data-key="t-analytics">User List</a>

							</li>

						</ul>

					</div>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.occupation') }}">

						<i class="ri-briefcase-line"></i> <span data-key="t-dashboards">Occupation</span>

					</a>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.nationality') }}">
						<i class="ri-flag-line"></i> <span data-key="t-dashboards">Nationality</span>

					</a>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.languages') }}">
						<i class="ri-home-4-line"></i> <span data-key="t-dashboards">Language</span>

					</a>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.education') }}">
						<i class="ri-community-line"></i></i> <span data-key="t-dashboards">Education</span>

					</a>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.faqs') }}">

						<i class="ri-questionnaire-fill"></i> <span data-key="t-dashboards">Faqs Management</span>

					</a>
				</li>


				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.blog') }}">

						<i class="ri-file-list-line"></i> <span data-key="t-dashboards">Blog Management</span>

					</a>
				</li>

				<li class="nav-item">

					<a class="nav-link menu-link" href="#sidebarDashboards1" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards1">

						<i class="ri-user-2-line"></i> <span data-key="t-dashboards">Package Management</span>

					</a>
					<div class="menu-dropdown collapse" id="sidebarDashboards1" style="">

						<ul class="nav nav-sm flex-column">

							<li class="nav-item">

								<a class="nav-link menu-link" href="{{ route('admin.package-management') }}">

									<i class="ri-bank-line"></i> <span data-key="t-dashboards">Package List</span>

								</a>

							</li>
							<li class="nav-item">

								<a class="nav-link menu-link" href="{{ route('admin.subscription') }}">

									<i class="ri-bank-line"></i> <span data-key="t-dashboards">Subscription</span>

								</a>

							</li>
						</ul>

					</div>
				</li>
				<!-- <li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.package-management') }}">

						<i class="ri-bank-line"></i> <span data-key="t-dashboards">Package Management</span>

					</a>
					<div class="menu-dropdown collapse" id="sidebarDashboards" style="">

						<ul class="nav nav-sm flex-column">

							<li class="nav-item">

								<a href="#" class="nav-link" data-key="t-analytics">Subscription</a>

							</li>

						</ul>

					</div>
				</li> -->

				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.happy-hour') }}">

						<i class="ri-gift-line"></i> <span data-key="t-dashboards">Happy Hours Management</span>

					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link menu-link" href="{{ route('admin.payment-setting') }}">

						<i class="ri-bank-card-2-line"></i> <span data-key="t-dashboards">Payment Setting</span>

					</a>
				</li>

			</ul>

		</div>

        <!-- Sidebar -->

	</div>



	<div class="sidebar-background"></div>

</div>