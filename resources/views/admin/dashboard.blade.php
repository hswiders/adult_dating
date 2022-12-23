@extends('admin.layout.layouts')
@section('content')
<div class="page-content">
	<div class="container-fluid">

		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Dashboard</h4>

					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>

				</div>
			</div>
		</div>
		<!-- end page title -->

		<div class="row">
			<div class="col">

				<div class="h-100">
					<div class="row mb-3 pb-1">
						<div class="col-12">
							<div class="d-flex align-items-lg-center flex-lg-row flex-column">
								<div class="flex-grow-1">
									<h4 class="fs-16 mb-1">Hello</h4>
									<p class="text-muted mb-0">Here's what's happening with your app today.</p>
								</div>

							</div><!-- end card header -->
						</div>
						<!--end col-->
					</div>
					<!--end row-->

					<div class="row">
						<!-- <div class="col-xl-3 col-md-6">
							<div class="card card-animate">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="flex-grow-1 overflow-hidden">
											<p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Users</p>
										</div>

									</div>
									<div class="d-flex align-items-end justify-content-between mt-4">
										<div>
											<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target=""> </h4>
											<a href="/admin/users" class="text-decoration-underline">View Users</a>
										</div>
										<div class="avatar-sm flex-shrink-0">
											<span class="avatar-title bg-soft-success rounded fs-3">
												<i class="bx bx-user-circle text-success"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div> --><!-- end col -->
						<!-- <div class="col-xl-3 col-md-6">
							
							<div class="card card-animate">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="flex-grow-1 overflow-hidden">
											<p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Categories</p>
										</div>

									</div>
									<div class="d-flex align-items-end justify-content-between mt-4">
										<div>
											<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target=""> </h4>
											<a href="/admin/category" class="text-decoration-underline">View Categories</a>
										</div>
										<div class="avatar-sm flex-shrink-0">
											<span class="avatar-title bg-soft-success rounded fs-3">
												<i class="bx bx-party text-success"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div> --><!-- end col -->



					</div> <!-- end row-->



					<!-- end row-->

					<!-- end row-->

				</div> <!-- end .h-100-->

			</div> <!-- end col -->


		</div>

	</div>
	<!-- container-fluid -->
</div>
@endsection('content')