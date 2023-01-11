@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Nationality Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Nationality</a></li>

							<li class="breadcrumb-item active">Nationality Management</li>

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

						<h4 class="card-title mb-0">Nationality list</h4>

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

											<th>Title</th>

											<th>Action</th>

										</tr>

									</thead>

									<tbody class="list form-check-all">

										 @if(!blank($nationality))

										 	@php $i = 1; @endphp

										  @foreach ($nationality as $key => $value)

										<tr>

										

											<td>{{ $i; }}</td>

											<td>{{ $value->title }}</td>

											<td>
												<!-- <a class="btn btn-warning btn-sm" href="javascript:void(0)"  onclick="show_edit_form({{$value->id}})">Edit</a> -->
												 <a href="javascript:;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{$value->id;}}">Edit</a>

												<a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-nationality?id='.$value->id); }}" >Delete</a>
											</td>

										

										</tr>

										@php $i++; @endphp 


	<div class="modal fade" id="updateModal{{$value->id;}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Natinal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
	         <form class="contact-form" id="update_natinality{{$value->id}}" method="post" onsubmit="return update_natinality(event , {{$value->id}});"  enctype="multipart/form-data">
	            <div class="modal-body">
	            	<input type="hidden" name="id" value="{{$value->id}}">
	               @csrf
	                <div class="row">
	                     <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">National</label>
								<input type="text" name="title" class="form-control" placeholder="Enter national name.."  value="{{$value->title}}" required>
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
                <h5 class="modal-title">Add National Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
	         <form class="contact-form" id="add_natinality" method="post" onsubmit="return add_natinality(event);"  enctype="multipart/form-data">
	            <div class="modal-body">
	               @csrf
	                <div class="row">
	                    <div class="mb-3 col-md-12">
							<label for="emailInput" class="form-label">National</label>
							<input type="text" name="title" class="form-control" placeholder="Enter national name.."  value="" required>
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

function add_natinality(e) {
    e.preventDefault();
    formdata = new FormData($('#add_natinality')[0]);
    $.ajax({
          url: '{{ route("admin.add-nationality") }}',
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
            }else{
                $('#saveBtn').prop('disabled' , false);

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



function update_natinality(e , id) {
            e.preventDefault();
            formdata = new FormData($('#update_natinality'+id)[0]);
            $.ajax({
                  url: '{{ route("admin.update-nationality") }}',
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