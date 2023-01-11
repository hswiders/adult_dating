@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Occupation Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Occupation</a></li>

							<li class="breadcrumb-item active">Occupation Management</li>

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

						<h4 class="card-title mb-0">Occupation list</h4>

					</div><!-- end card header -->

					<div class="card-body">

						<div id="customerList">

							<div class="row text-right mb-3">

								<div class="text-right">

									<a href="{{ url('admin/add-occupation'); }}" class="btn btn-success btn-xs float-right">Add</a>

								</div>

                            </div>

							<div class="table-responsive table-card mt-3 mb-1">

								<table class="table align-middle table-nowrap" id="example23">

									<thead class="table-light">

										<tr>

											<th>S.No</th>

											<th>Title</th>

											<th>Action</th>

										</tr>

									</thead>

									<tbody class="list form-check-all">

										 @if($occupation)

										 	@php $i = 1; @endphp

										  @foreach ($occupation as $key => $value)

										<tr>

										

											<td>{{ $i; }}</td>

											<td>{{ $value->title }}</td>

											<td>
												<a class="btn btn-warning btn-sm" href="{{ url('admin/edit-occupation?id='.$value->id); }}" >Edit</a>

												<a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-occupation?id='.$value->id); }}" >Delete</a>
											</td>

										

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

@endsection