@extends('admin.layout.layouts')
@section('content')
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			@if( Session::has('success')) 

			<div class="alert alert-success" role="alert">

				{{ Session::get('success') }}

			</div>

			@endif
			
			@if( Session::has('error')) 

			<div class="alert alert-danger" role="alert">

				{{ Session::get('error') }}

			</div>

			@endif 
			<!--end col-->
			<div class="col-xxl-9">
				<div class="card mt-xxl-n5">
					<div class="card-header">
						<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
									<i class="fas fa-home"></i>Personal Details
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
										<i class="far fa-user"></i> Change Password
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body p-4">
						<div class="tab-content">
							<div class="tab-pane active" id="personalDetails" role="tabpanel">
								<form action="#" id="update_form" method="post" onsubmit="return update_form()">
									@csrf
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Name</label>
												<input type="text" name="name" class="form-control" placeholder="Name" value="<?= auth()->guard('admin')->user()->name; ?>" required>
											</div>
										</div>
										<!--end col-->
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Email Address</label>
												<input type="email" name="email" class="form-control" placeholder="Email" readonly value="<?= auth()->guard('admin')->user()->email; ?>" >
											</div>
										</div>

										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Phone</label>
												<input type="number" name="phone" class="form-control" placeholder="Phone" value="<?= auth()->guard('admin')->user()->phone; ?>" >
											</div>
										</div>
                                       

										<div class="col-lg-12">
											<div class="hstack gap-2 justify-content-end">
												<button type="submit" class="btn btn-primary" id="sub_btn">Updates</button>
											</div>
										</div>
                                        <!--end col-->
									</div>
                                    <!--end row-->
								</form>
							</div>
							
							<div class="tab-pane" id="changePassword" role="tabpanel">
								<form action="#" id="update_password" method="post" onsubmit="return update_password()">
									@csrf
									<div class="row g-2">
										<div class="col-lg-4">
											<div>
												<label for="oldpasswordInput" class="form-label">Old Password*</label>
												<input type="password" name="old_pass" class="form-control" placeholder="Enter current password">
											</div>
											<div id="result1"></div>
										</div>
										<!--end col-->
										<div class="col-lg-4">
											<div>
												<label for="newpasswordInput" class="form-label">New Password*</label>
												<input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
											</div>
										</div>
										<!--end col-->
										<div class="col-lg-4">
											<div>
												<label for="confirmpasswordInput" class="form-label">Confirm New Password*</label>
												<input type="password" name="cnew_pass" class="form-control" placeholder="Confirm password">
											</div>
										</div>
										<!--end col-->
										<div class="col-lg-12">
											<div class="text-end">
												<button type="submit" class="btn btn-success" id="update">Change Password</button>
											</div>
										</div>
										<!--end col-->
									</div>
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


<script type="text/javascript">
	function update_password() {
	$('.alert-danger').remove();
	$.ajax({
		url: "{{route('admin.change_password')}}",
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		data: new FormData($('#update_password')[0]),
		dataType: 'json',
		beforeSend: function() {
			$('#update').prop('disabled', true);
			$('#update').text('Processing..');
		},
		success: function(res) {
			$('#update').prop('disabled', false);
			$('#update').text('Update');
			if (res.status == 1) {

				window.location.reload();
				// alert(res.session)

			} else {

				$('#result1').html(res.message);
				for (var err in res.validation) {

					$("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
				}
			}
		}
	});
	return false;
}
</script>

<script type="text/javascript">
    function update_form() {
        $('.alert-danger').remove();
        $.ajax({
            url: "{{route('admin.update_profile')}}",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#update_form')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#sub_btn').prop('disabled', true);
                $('#sub_btn').text('Processing..');
            },
            success: function(res) {
                $('#sub_btn').prop('disabled', false);
                $('#sub_btn').text('Update');
                if (res.status == 1) {

                    window.location.reload();

                } else {

                    $('#result1').html(res.message);
                    for (var err in res.validation) {

                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
                    }
                }
            }
        });
        return false;
    }
</script>
@endsection('content')