@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Blog Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Blog</a></li>

							<li class="breadcrumb-item active">Blog Management</li>

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

						<h4 class="card-title mb-0">Blog list</h4>

					</div><!-- end card header -->

					<div class="card-body">

						<div id="customerList">

							<div class="row text-right mb-3">

								<div class="text-right">

									<!-- <a href="{{ url('admin/add-occupation'); }}" class="btn btn-success btn-xs float-right">Add</a> -->
									<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>

								</div>

                            </div>

							<div class="table-responsive table-card mt-3 mb-1">

								<table class="table align-middle table-nowrap" id="example23">

									<thead class="table-light">

										<tr>
											<th>S.No</th>
											<th>Title</th>
											<th>Description</th>
                      <th>Image</th>
											<th>Action</th>
										</tr>

									</thead>

									<tbody class="list form-check-all">

										 @if($blog_list)

										 	@php $i = 1; @endphp

										  @foreach ($blog_list as $key => $value)

										<tr>
											<td>{{ $i; }}</td>
											<td>{{ $value->title }}</td>
											<td><?php echo $value->description ?></td>
                      <td>
                          @if(!empty($value->image))
                            <img style="height: 100px;width: 100px;" src="{{ url('/public/admin') }}/blog_image/{{ $value->image }}">
                          @endif
                      </td>
											<td>
											<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $value->id }}">Edit</button>

												<a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-blog?id='.$value->id); }}" >Delete</a>
											</td>
					<!-- edit modal -->
					<div class="modal" id="editModal{{ $value->id }}">                 
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                             <div class="modal-header bg-light p-3">
                              <h4 class="modal-title p-0">Edit Blog</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            
                            <!-- Modal body -->
                            <form id="edit_blog" method="post" action="#" onsubmit="return edit_blog(this , {{ $value->id }} )" >
                            	@csrf
                                <div class="modal-body">
                                <div class="col-md-12 py-3">
                                  <div>
                                    <label>Title</label>
                                    <input type="text" class="form-control" value="{{$value->title}}"  name="title" required>
                                    <input type="hidden" class="form-control" value="{{$value->id}}" name="id" >
                                  </div>
                                   <div>
                                    <label>Description</label>
                                    <textarea class="form-control ckeditor" id="myTextarea<?= $value['id'];?>" name="description" placeholder="Enter Content">{{ $value->description }}</textarea>
                                  </div>
                                  <div class="error_msg<?= $value['id'];?>"></div>


                                   <div>
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="file">
                                  </div><br>
                                  @if(!empty($value->image))
                                    <img style="height: 100px;width: 100px;" src="{{ url('/public/admin') }}/blog_image/{{ $value->image }}">
                                  @endif
                                   
                                  <div class="mt-3 text-center">
                                      <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                                  </div>
                                    
                                      
                                    </div>
                               </div>
                            </form>
                            
                          </div>
                        </div>
                      </div>
                      <!-- edit modal -->

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

        <!-- add modal -->
					<div class="modal" id="addModal">                 
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                             <div class="modal-header bg-light p-3">
                              <h4 class="modal-title p-0">Add Blog</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            
                            <!-- Modal body -->
                            <form id="addBlog" method="post" action="#" onsubmit="return addBlog()" enctype="multipart/FormData">
                            	@csrf
                                <div class="modal-body">
                                <div class="col-md-12 py-3">
                                  <div>
                                    <label>Title</label>
                                    <input type="text" class="form-control" value=""  name="title" required>
                                  </div>
                                   <div>
                                    <label>Description</label>
                                    <textarea class="form-control ckeditor" name="description" placeholder="Enter Content"></textarea>
                                  </div>

                                   <div>
                                    <label>Image</label>
                                    <input type="file" class="form-control" value=""  name="file" required>
                                  </div>

                                   
                                  <div class="mt-3 text-center">
                                      <button type="submit"  id="sub_btn" class="btn btn-success">Add</button>
                                  </div>
                                    
                                      
                                    </div>
                               </div>
                            </form>
                            
                          </div>
                        </div>
                      </div>
                   <!-- add modal -->

</div>

@endsection
@section('scripts')

<script type="text/javascript">
    function addBlog() {
    	
        $('.alert-danger').remove();
        $.ajax({
            url: "{{route('admin.add-blog')}}",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#addBlog')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#sub_btn').prop('disabled', true);
                $('#sub_btn').text('Processing..');
            },
            success: function(res) {
							$('#sub_btn').prop('disabled', false);
							$('#sub_btn').text('Add');
							if (res.status == 1) {

									window.location.href = "{{route('admin.blog')}}";

							} else {

								$('#result1').html(res.message);
								for (var err in res.validation) {
									$("[name='" + err + "']").after("<div class='label alert-danger'>" + res.validation[err] + "</div>");
								}
							}
            }
        });
        return false;
    }
</script>
<script type="text/javascript">
function edit_blog(el , id) {
    $('.alert-danger').remove();
    for (instance in CKEDITOR.instances)
    {
        CKEDITOR.instances[instance].updateElement();
    }

    var myTextarea = $("#myTextarea"+id).val();
     if (!myTextarea) {
      
        $('.error_msg'+id).html('<span class="text-danger">This field is required</span>')
        return false;
     }
      $.ajax({
      url: "{{route('admin.edit-blog')}}",
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($(el)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#update'+id).prop('disabled' , true);
        $('#update'+id).text('Processing..');
      },
      success : function(res){
        $('#update'+id).prop('disabled' , false);
        $('#update'+id).text('Update');
        if (res.status == 1) {
            window.location.href = "{{route('admin.blog')}}";
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;    
}

    </script>
@endsection
