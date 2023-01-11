@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Happy Hours Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Happy Hours</a></li>

							<li class="breadcrumb-item active">Happy Hours Management</li>

						</ol>

					</div>

				</div>

			</div>

		</div>

		<!-- end page title -->

		@if( Session::has('message')) 
			<?php echo Session::get('message'); ?>
		@endif

		@if( Session::has('error')) 
			<?php echo Session::get('error'); ?>
		@endif


	<div class="row">

			<div class="col-lg-12">

				<div class="card">

					<div class="card-header">

						<h4 class="card-title mb-0">Happy Hours list</h4>

					</div><!-- end card header -->

					<div class="card-body">

						<div id="customerList">

							<div class="row text-right mb-3">

								<div class="text-right">

									<a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Add</a>

								</div>

                            </div>

							<div class="table-responsive table-card mt-3 mb-1">

								<table class="table align-middle table-nowrap" id="example23">

									<thead class="table-light">

										<tr>

											<th>S.No</th>
											<th>Package</th>
											<th>Offer(%)</th>
											<th>Offer Date</th>
											<th>Status</th>
											<th>Action</th>

										</tr>

									</thead>

									<tbody class="list form-check-all">

										 @if(!blank($happy_hour))

										 	@php $i = 1; @endphp

										  @foreach ($happy_hour as $key => $value)
										  
										<tr>
											<td>{{ $i; }}</td>
											<td>{{ isset($value->packagee->title)?$value->packagee->title:'' }}</td>
											<td>{{ $value->percentage }}%</td>
											<td>{{ $value->date }}</td>
											@if($value->date == date('Y-m-d'))
											<td><span class="badge bg-success">Active</span></td>
											@else
											<td><span class="badge bg-danger">Expired</span></td>
											@endif
											<td>
												 <!-- <a href="javascript:;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$value->id;}}">Edit</a> -->

												<a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-happy-hour?id='.$value->id); }}" >Delete</a>

<div class="modal fade" id="updateModal{{$value->id;}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
	         <form class="contact-form" id="update_happy_hour{{$value->id}}" method="post" onsubmit="return update_happy_hour(event , {{$value->id}});"  enctype="multipart/form-data">
	            <div class="modal-body">
	            	<input type="hidden" name="id" value="{{$value->id}}">
	               @csrf
	                <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Package</label>
							<select  name="package" class="form-control" required>
								<option value="">---Select---</option>
								@foreach($package as $key=>$packV)
									<option <?= ($packV->id == $value->package)?'Selected':'';?> value="{{ $packV->id }}">{{ $packV->title }}</option>
								@endforeach
							</select>
						</div>
	                </div>
	                 <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Offer</label>
							<input type="number" min="1" step=".5" name="percentage" class="form-control" placeholder="Enter Offer.."  value="{{$value->percentage}}" required>
						</div>
	                </div>
	                <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Date</label>
							<input type="date" min="<?= date('Y-m-d');?>" max="<?= date('Y-m-d');?>"  name="date" class="form-control" placeholder="Date"  value="{{$value->date}}" required>
						</div>
	                </div>

	            </div>
	            <div class="modal-footer">
	               <button type="submit" class="btn btn-primary" id="saveBtn{{$value->id}}">Update</button>
	            </div>
	         </form>
	      </div>
	   </div>
	</div>
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

<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Happy Hours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
	         <form class="contact-form" id="add_happy_hour" method="post" onsubmit="return add_happy_hour(event);"  enctype="multipart/form-data">
	            <div class="modal-body">
	               @csrf
	                <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Package</label>
							<select  name="package" class="form-control" required>
								<option value="">---Select---</option>
								@foreach($package as $key=>$packV)
									<option value="{{ $packV->id }}">{{ $packV->title }}</option>
								@endforeach
							</select>
							<div id="pack_err"></div>
						</div>
	                </div>
	                <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Offer(%)</label>
							<input type="number" min="1" step=".5" name="percentage" class="form-control" placeholder="Enter Offer.."  value="" required>
						</div>
	                </div>
	                <div class="row">
	                     <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">Offer Date</label>
							<input type="date" min="<?= date('Y-m-d');?>" max="<?= date('Y-m-d');?>" name="date" class="form-control" placeholder="Date"  value="{{ date('Y-m-d') }}" required>
						</div>
	                </div>

	            </div>
	            <div class="modal-footer">
	               <button type="submit" class="btn btn-primary" id="saveBtn">Add</button>
	            </div>
	         </form>
	      </div>
	   </div>
	</div>
@endsection
@section('scripts')

<script type="text/javascript">
	function show_edit_form(id) 
{
	$('#edit_modal'+id).modal('show');
}
function e_modal_close(id){
	$('#edit_modal'+id).modal('hide');
}

	function show_add_form() 
{
	$('#add_modal').modal('show');
}
function a_modal_close(){
	$('#add_modal').modal('hide');
}

function add_happy_hour(e) {
    e.preventDefault();
    formdata = new FormData($('#add_happy_hour')[0]);
    $.ajax({
          url: '{{ route("admin.add-happy-hour") }}',
          data: formdata,
          processData: false,
          contentType: false,
          type: 'POST',
          dataType:'json',
         beforeSend: function() {        
            $('#saveBtn').prop('disabled' , true);
            $('#saveBtn').text('Processing..');
          },
         success: function(result)
         {
            if(result.status == 1)
            {
                $('#saveBtn').prop('disabled' , false);
                 location.reload();
            }else{
                $('#saveBtn').prop('disabled' , false);
                $('#pack_err').html(result.message);
                
			}

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



function update_happy_hour(e , id) {
            e.preventDefault();
            formdata = new FormData($('#update_happy_hour'+id)[0]);
            $.ajax({
                  url: '{{ route("admin.update-happy-hour") }}',
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