@extends('admin.layout.layouts')
@section('content')
<div class="page-content">
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Users Management</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
							<li class="breadcrumb-item active">Users Management</li>
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
						<h4 class="card-title mb-0">Users list</h4>
					</div><!-- end card header -->
					<div class="card-body">
						<div id="customerList">
							<div class="row text-right mb-3">
								<div class="text-right">
									<!-- <a href="{{ url('admin/add-occupation'); }}" class="btn btn-success btn-xs float-right">Add</a> -->
								</div>
                            </div>
							<div class="table-responsive table-card mt-3 mb-1">
								<table class="table align-middle table-nowrap" id="example23">
									<thead class="table-light">
										<tr>
											<th>S.No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="list form-check-all">
										 @if($user)
										 	@php $i = 1; @endphp
										  @foreach ($user as $key => $value)
										<tr>
										
											<td>{{ $i; }}</td>
											<td>{{ $value->first_name }} {{ $value->last_name }}</td>
											<td>{{ $value->email }}</td>
											@if($value->status == 1)
											<td><span class="badge btn-success">Active<span></td>
											@else
											<td><span class="badge btn-danger">Blocked</span></td>
											@endif
											<td>
												@if($value->status == 1)
												 <a class="btn btn-danger btn-sm" onclick="change_status({{ $value->id }},{{ 0 }})" id="btn_load{{ $value->id }}" >Block</a>
												 @else
												 <a class="btn btn-success btn-sm" onclick="change_status({{ $value->id }},{{ 1 }});" id="btn_load{{ $value->id }}">Unblock</a>
												 @endif
												 <a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-user?id='.$value->id); }}" >Delete</a>

												  <a class="btn btn-success btn-sm" href="{{ url('admin/edit-user?id='.$value->id); }}" >Edit</a>
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
@endsection('content')

<script>
   function change_status(id,status)
   {
    //alert(status);
    if(confirm('Are you sure?'))
    {
    $.ajax({
          type: "POST",
          url: "{{ route('admin.change-status') }}",
          data: {id:id,status:status , _token:'{{ csrf_token() }}'},
          dataType: "json",
          beforeSend:function(){
           //$('#btn_load'+id).prop('disabled',true);
           $('#btn_load'+id).text('Processing..');
        },
          success: function(data){
            if(data.status == 1)  //json status return by controller
            {
               window.location.reload();
            }
            else
            {
              $('.error-msg').html(data.message);
              //$('#submit'+id).prop('disabled',false);
              $('#btn_load'+id).hide();
            }
              
          },
          
     });
    }

   }
</script>