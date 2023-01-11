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

					<h4 class="mb-sm-0">Edit Package Management</h4>

					<div class="page-title-right">

						<ol class="breadcrumb m-0">

							<li class="breadcrumb-item"><a href="javascript: void(0);">Edit Package Management</a></li>

							<li class="breadcrumb-item active">Edit Package Management</li>

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

								<i class="fas fa-home"></i>Edit Package

							</li>

						</ul>

					</div>

					<div class="card-body p-4">

						<div class="tab-content">

							<div class="tab-pane active" id="personalDetails" role="tabpanel">

			 <form class="contact-form" id="update_package{{$value->id}}" method="post" onsubmit="return update_package(event , <?php echo $value['id'] ?>);"  enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="id" value="{{$value->id}}">
                 @csrf
                  <div class="row">
                    <input type="hidden" value="<?php echo $value['id'] ?>" name="package_id">
                      <div class="col-lg-12">
              <label for="TitleInput" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter education name.."  value="{{$value->title}}" required>
            </div>
            <div class="col-lg-12">
              <label for="CoinsInput" class="form-label">Coins(c)</label>
                <input type="text" name="coins" class="form-control" placeholder="Enter Price"  value="{{$value->coins}}" required>
            </div>
          <div class="col-lg-12">
              <label for="PriceInput" class="form-label">Price($)</label>
                <input type="text" name="price" class="form-control" placeholder="Enter Price"  value="{{$value->price}}" required>
            </div>
                  </div>
                 @php
                    $package_title =  App\Models\PackageItem::where('package_id',$value->id)->orderBy('id','desc')->get();
                    
                  @endphp 
                    @foreach ($package_title as $package_title_val) 
                    
                    <div class="row">
                  <div class="col-lg-12 check_package_length">
                      <input type="hidden" name="package_list_id[]" value="<?php echo $package_title_val['id'] ?>">
                        <div class="form-group">
                          <label for="ItemInput" class="hidden-md">Item</label>

                          <input type="text" id="newfield1" value="<?php echo $package_title_val['item'] ?>" class="form-control" required name="item[]" />
                      <!--  <a  href="{{ url('admin/delete-package-list-Item?id='.$package_title_val->id); }}" onclick="return confirm('are you want to delete this?')" data-href="{{ url('admin/delete-package-list-Item?id='.$package_title_val->id); }}" class="btn btn-danger btn-sm">&times;</a> -->
                      <a href="#" class="btn btn-danger btn-sm" onclick="delete_packageList('{{$package_title_val->id}}',event) ">&times;</a>
                  </div>
                                   
                  </div>
                
              </div>
                 @endforeach
                   <div class="row" style="align-items: center;">
                  <div class="col-md-12 dynamic-field" id="dynamic-field-1">
                    <div class="row" >
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="ItemInput" class="hidden-md">Item</label>
                          <input type="text" id="field" class="form-control" name="additem[]" />
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
              <div class="modal-footer">
                <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                 <button type="submit" class="btn btn-primary" id="saveBtn{{$value->id}}">Update</button>
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

@endsection



@section('scripts')

<script type="text/javascript">


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
           $('#saveBtn'+id).prop('disabled' , false);
           $('#saveBtn'+id).text('Update');
          if(result.status == 1)
               
                    {
                      
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
                        
        }
         /*error :function($xhr,textStatus,res) {
                   for (var err in res.errors) 
                    {
                        $("[name='" + err + "']").after("<div  class='label validation alert-danger'>" + res.errors[err] + "</div>");
                        $("[name='" + err + "']").focus();
                    }
                }*/

  });
  return false;
}

function delete_packageList(id,e){
   e.preventDefault();
  var length = $(".check_package_length").length;

 // alert($(".check_package_length").length);
 if($(".check_package_length").length >1){
    if(confirm("Are you Sure?")){
   var token = '{{ csrf_token() }}';
      $.ajax({
        
        url:'{{ route("admin.delete-package-list-Item") }}',
        data:{id:id ,'_token': token},
        type: 'POST',
        dataType:'json',
        success:function(result){
        //  console.log(data);
          if(result.status == 1)
                    {
                        //$('#saveBtn'+id).prop('disabled' , false);
                        location.reload();
                    }
         
        }
     });

  }
   
  //alert($("#data_url"+id).attr("data-href"))
 }else{
    alert("At least one package item is required you can't delete package item");
  //  window.location.href='$("#data_url"+id).attr("data-href")';
 }
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

