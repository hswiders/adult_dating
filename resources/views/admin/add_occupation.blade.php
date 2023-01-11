@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

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

		<div class="row">

			@if( Session::has('message')) 



				<?php echo Session::get('message'); ?>



			@endif

			<!--end col-->

			<div class="col-xxl-9">

				<div class="card mt-xxl-n5">

					<div class="card-header">

						<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

							<li class="nav-item">

								<i class="fas fa-home"></i>Add Occupation

							</li>

						</ul>

					</div>

					<div class="card-body p-4">

						<div class="tab-content">

							<div class="tab-pane active" id="personalDetails" role="tabpanel">

								<form action="#" id="add_occupation" method="post" onsubmit="return add_occupation()">

									@csrf

									<div class="row">

											<div class="mb-3">

												<label for="firstnameInput" class="form-label">Title</label>

												<input type="text" name="title" class="form-control" value="" required>

											

											</div>

											

										<div class="col-lg-12">

											<div class="hstack gap-2 justify-content-end">

												<button type="submit" class="btn btn-primary" id="sub_btn">Add</button>

											</div>

										</div>

                                        <!--end col-->

									</div>

                                    <!--end row-->

								</form>

							</div>

							

						

						</div>

					</div>

				</div>

			</div>

		</div>

        <!--end row-->



	</div>

    <!-- container-fluid -->

</div><!-- End Page-content -->
@endsection

@section('scripts')

<script type="text/javascript">

    function add_occupation() {

        $('.alert-danger').remove();

        $.ajax({

            url: "{{route('admin.add_occupation')}}",

            type: 'POST',

            cache: false,

            contentType: false,

            processData: false,

            data: new FormData($('#add_occupation')[0]),

            dataType: 'json',

            beforeSend: function() {

                $('#sub_btn').prop('disabled', true);

                $('#sub_btn').text('Processing..');

                $('#error-desc').html('');

            },

            success: function(res) {

							$('#sub_btn').prop('disabled', false);

							$('#sub_btn').text('Add');

							if (res.status == 1) {



									window.location.href = "{{route('admin.occupation')}}";



							} else {



								$('#result1').html(res.message);

								for (var err in res.validation) {

									

									if(err=='answer'){

										$('#error-desc').html("<div class='label alert-danger'>" + res.validation[err] + "</div>");

									} else {

										$("[name='" + err + "']").after("<div class='label alert-danger'>" + res.validation[err] + "</div>");

									}



										

								}

							}

            }

        });

        return false;

    }

</script>

@endsection



