@extends('admin.layout.layouts')
@section('content')
<div class="page-content">
	<div class="container-fluid">
			<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Payment Setting</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Payment</a></li>
							<li class="breadcrumb-item active">Payment Setting</li>
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
								<i class="fas fa-home"></i>Update Payment Setting
							</li>
						</ul>
					</div>
					<div class="card-body p-4">
						<div class="tab-content">
							<div class="tab-pane active" id="personalDetails" role="tabpanel">
								<form action="#" id="update_paymentSetting{{$payment_setting->id}}" method="post" onsubmit="return update_paymentSetting(event , {{$payment_setting->id}});"  enctype="multipart/form-data">

									@csrf
									<div class="row">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Men Send Message Price</label>
												<input type="number" min="1" step=".5" name="men_send_msg_price" class="form-control" value="{{$payment_setting->men_send_msg_price}}" required>
												<input type="hidden" name="id" value="{{$payment_setting->id}}" required>
											</div>

											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Men Send Image Price</label>
												<input type="number" min="1" step=".5" name="men_send_image_price" class="form-control" value="{{$payment_setting->men_send_image_price}}" required>
											</div>
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Men Send Video Price</label>
												<input type="number" min="1" step=".5" name="men_send_video_price" class="form-control" value="{{$payment_setting->men_send_video_price}}" required>
											</div>
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Men Receive Video Price</label>
												<input type="number" min="1" step=".5" name="men_recieve_video_price" class="form-control" value="{{$payment_setting->men_recieve_video_price}}" required>
											</div>
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Men Receive Image Price</label>
												<input type="number" min="1" step=".5" name="men_recieve_image_price" class="form-control" value="{{$payment_setting->men_recieve_image_price}}" required>
											</div>
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Women Commission</label>
												<input type="number" min="1" step=".5" name="women_commission" class="form-control" value="{{$payment_setting->women_commission}}" required>
											</div>
											
										<div class="col-lg-12">
											<div class="hstack gap-2 justify-content-end">
												<button type="submit" class="btn btn-primary" id="saveBtn{{$payment_setting->id}}">Update</button>
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
   function update_paymentSetting(e , id) {
            e.preventDefault();
            formdata = new FormData($('#update_paymentSetting'+id)[0]);
            $.ajax({
                  url: '{{ route("admin.update-paymentSetting") }}',
                  data: formdata,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'json',
                 beforeSend: function() {        
                    $('#saveBtn'+id).prop('disabled' , true);
                    $('#saveBtn'+id).text('Processing..');
                  },
                 success: function(result)
                 {
                    if(result.status == 1)
                    {
                        $('#saveBtn'+id).prop('disabled' , false);
                    }else{
                        $('#saveBtn'+id).prop('disabled' , false);

                    }
                        location.reload();
                    
                  },
                  error :function($xhr,textStatus,res) {
                   for (var err in res.errors) 
                    {
                        $("[name='" + err + "']").after("<div  class='label validation alert-danger'>" + res.errors[err] + "</div>");
                        $("[name='" + err + "']").focus();
                    }
                }
            });
           
            
        }
</script>
@endsection

