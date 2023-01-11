@extends('admin.layout.layouts')

@section('content')

<div class="page-content">

	<div class="container-fluid">

		<!-- start page title -->

		<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Package Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>

							<li class="breadcrumb-item active">Package Management</li>

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

						<h4 class="card-title mb-0">Package list</h4>

					</div><!-- end card header -->

					<div class="card-body">

						<div id="customerList">

							<div class="row text-right mb-3">

								<div class="text-right">

									<a href="{{ route('admin.add-package') }}"  class="btn btn-success btn-xs float-right">Add</a>

								</div>

                            </div>

							<div class="table-responsive table-card mt-3 mb-1">

								<table class="table align-middle table-nowrap" id="example23">

									<thead class="table-light">

										<tr>

											<th>S.No</th>

											<th>Title</th>
											<th>Coins(c)</th>
											<th>Price($)</th>
											<th>Action</th>

										</tr>

									</thead>

									<tbody class="list form-check-all">

                      <?php
                        if(!blank($package)){
                          $cnt=0;
                          foreach($package as $key => $value){
                            $cnt++;
                            ?>
                            <tr>
                            <td><?php echo $cnt; ?></td>
                            <td>{{ $value->title }}</td>
                            <td>c{{ $value->coins }}</td>
                            <td>${{ $value->price }}</td>
                            <td>
                      <a class="btn btn-warning btn-sm" href="{{ url('admin/edit-package?id='.$value->id); }}">Edit</a>

                        <a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-package?id='.$value->id); }}" >Delete</a>
                      </td>
                    </tr>
                    
                            <?php
                          }
                        }
                      ?>
										<!--  @if(!blank($package))

										 	@php $i = 1; @endphp

										  @foreach ($package as $key => $value)

										<tr>

										

											<td>{{ $i; }}</td>

											<td>{{ $value->title }}</td>
											<td>c{{ $value->coins }}</td>
											<td>${{ $value->price }}</td>
											<td>
											<a class="btn btn-warning btn-sm" href="{{ url('admin/edit-package?id='.$value->id); }}">Edit</a>

												<a onclick="return confirm('are you want to delete this?')" class="btn btn-danger btn-sm" href="{{ url('admin/delete-package?id='.$value->id); }}" >Delete</a>
											</td>
										

										</tr>

										@php $i++; @endphp 

 -->
	<!-- <div class="modal fade" id="edit_modal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	   <div class="modal-dialog" id="modal_data">
	      <div class="modal-content">
	         <div class="modal-header">
	            <h5 class="modal-title" id="modal_title">Edit Package </h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="e_modal_close(<?php echo $value['id'] ?>)">
	            <span aria-hidden="true">&times;</span>
	            </button>
	         </div>
	         
	      </div>
	   </div>
	</div> -->




										<!--  @endforeach

										@endif -->

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
@section('scripts')



<script type="text/javascript">

	/*function show_edit_form(id) 
{
	$('#edit_modal'+id).modal('show');
}
function e_modal_close(id){
	$('#edit_modal'+id).modal('hide');
}*/
/*
function update_package(e, id){

  e.preventDefault();
  formdata = new FormData($('#update_package'+id)[0]);
 	$.ajax({
 		url:'{{ route("admin.update-package") }}',
 		data: formdata,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'json',
         beforeSend: function() {        
                    $('#saveBtn'+id).prop('disabled' , true);
                    $('#saveBtn'+id).text('Processing..');
                  },
        success:function(result){
        	//console.log(data);
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
  return false;
}*/

/*$(document).ready(function() {
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields =50;

  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});
*/

</script>
<script type="text/javascript">
	

	$(document).ready(function() {
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields =50;

  function totalFields() {
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});

</script>
@endsection