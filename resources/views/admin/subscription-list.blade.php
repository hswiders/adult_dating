@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Subscription</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Occupation</a></li>

							<li class="breadcrumb-item active">Subscription Management</li>

						</ol>

					</div>

				</div>

			</div>

		</div>

		<!-- end page title -->

		@if( Session::has('message')) 



			<?php echo Session::get('message'); ?>



		@endif





		<div class="row">

			<div class="col-lg-12">

				<div class="card">

					<div class="card-header">

						<h4 class="card-title mb-0">Subscription list</h4>

					</div><!-- end card header -->

					<div class="card-body">

						<div id="customerList">

							<div class="row text-right mb-3">

								<div class="text-right">

									<a href="#" class="btn btn-success btn-xs float-right">Add</a>

								</div>

                            </div>

							<div class="table-responsive table-card mt-3 mb-1">

								<table class="table align-middle table-nowrap" id="example23">

									<thead class="table-light">

										<tr>

											<th>S.No</th>

											<th>User name</th>

											<th>Package Title</th>
											<th>Price($)</th>
											<th>Coins(c)</th>
											<th>Payment Method</th>
											<th>Action</th>
										</tr>

									</thead>

									<tbody class="list form-check-all">

										@if($subscription)
										@php $i = 1; @endphp
										@foreach($subscription as $key=>$value)
											
										<tr>
											<td>{{$i;}}</td>

										</tr>

										@php $i++; @endphp 
										@endforeach

										@endif


									</tbody>

								</table>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

        <!-- container-fluid -->

</div>

@endsection('content')