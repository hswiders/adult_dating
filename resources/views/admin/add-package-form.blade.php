@extends('admin.layout.layouts')

@section('content')
<style>
	
	.class-link{
  color:#6cc417;
  text-decoration:none;
}

.class-link:hover{
 color:#ffbb00; 
}
</style>
<div class="page-content">

	<div class="container-fluid">

			<div class="row">

			<div class="col-12">

				<div class="page-title-box d-sm-flex align-items-center justify-content-between">

					<h4 class="mb-sm-0">Add Package Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Add Package Management</a></li>

							<li class="breadcrumb-item active">Add Package Management</li>

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

								<i class="fas fa-home"></i>Add Package

							</li>

						</ul>

					</div>

					<div class="card-body p-4">

						<div class="tab-content">

							<div class="tab-pane active" id="personalDetails" role="tabpanel">

							<form action="#" id="add_package" method="post" onsubmit="return add_package(event)">

									@csrf

									<div class="row">

											<div class="mb-3 col-md-12">

												<label for="firstnameInput" class="form-label">Title</label>

												<input type="text" name="title" class="form-control" value="" required>

											</div>	

										<div class="mb-3 col-md-12">
											<label for="CoinsInput" class="form-label">Coins</label>

												<input type="number" min="1" name="coins" class="form-control" value="" required>
											

										</div>
										<div class="mb-3 col-md-12">

												<label for="PriceInput" class="form-label">Price</label>

												<input type="number" min="1" name="price" class="form-control" value="" required>
											</div>
<!-- 											 <div class="mb-3 col-md-12 dynamic-field" id="dynamic-field-1">
			      
								        <div class="form-group">
								          <label for="ItemInput" class="hidden-md">Item</label>
								          <input type="text" id="field" class="form-control" required name="item[]" />
								        </div>   
								  
										  <div class="col-md-2 mt-30 append-buttons">
												    <div class="clearfix">
												      <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>
												      	+
												      </button>
												      <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>-
												      </button>
												    </div>
										  </div>		  

								</div>  -->

							 <div class="row" style="align-items: center;">
								  <div class="col-md-12 dynamic-field" id="dynamic-field-1">
								    <div class="row" >
								      
								      <div class="col-md-12">
								        <div class="form-group">
								          <label for="ItemInput" class="hidden-md">Item</label>
								          <input type="text" id="field" class="form-control" required name="item[]" />
								         
								          <p id="itemErr"></p>
								        </div>
								      </div>
								     
								            </div>
								  </div>
								  <div class="col-md-2 mt-30 append-buttons">
								    <div class="clearfix">
								      <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>+
								      </button>
								      <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>-
								      </button>
								    </div>
								  </div>
							</div>
					</div>
 
											<div class="hstack gap-2 justify-content-end">

												<button type="submit" class="btn btn-primary" id="sub_btn">Add</button>

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



function add_package(e) {
    e.preventDefault();
    formdata = new FormData($('#add_package')[0]);
       $('.alert-danger').remove();
   $.ajax({
   	 url: '{{ route("admin.add-packages-data") }}',
          data: formdata,
          processData: false,
          contentType: false,
          type: 'POST',
          dataType:'json',
          beforeSend: function() {        
            $('#sub_btn').prop('disabled' , true);
            $('#sub_btn').text('Processing..');
          },
          success:function(result){
          	//console.log(data);
          	$('#sub_btn').prop('disabled' , false);
          	$('#sub_btn').text('Add');
          	if(result.status == 1)
            {
               //  $('#sub_btn').prop('disabled' , false);
                 window.location.href = "{{route('admin.package-management')}}"; 
            }else{
            	$("#itemErr").html(result.message);
               //console.log(result.validation);
                 for (var err in result.validation) 
	            {
	                $("[name='" + err + "']").after("<div  class='label validation alert-danger'>" + result.validation[err] + "</div>");
	              //  $("[name='" + err + "']").focus();
	            }
            }
                //location.reload();
              

          }
        
   })
    return false;
}


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

