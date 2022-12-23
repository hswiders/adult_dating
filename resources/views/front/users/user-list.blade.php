@extends('front.users.layouts.header')

    @section('content')
      <section id="content_outer_wrapper">
        <div id="content_wrapper">
          <div class="d-flex align-items-center justify-content-between mx-3 my-3">
            <div class="">
            <h3 class="h3 m-0">{{$title}}</h3>
            <p class="m-0">{{$sub_title}}</p>
          </div>
          <button  class="filter_icon" data-toggle="modal" data-target="#filterModal"><i class="fas fa-filter" aria-hidden="true"></i></button>
          </div>

          <hr class="mx-3">

          <div id="content" class="container-fluid">
            <div class="content-body" id="filter_data">
              {{--  --}}

          
              <!-- ENDS $dashboard_content -->
            </div>
            <div id="pagination_link"></div>
          </div>
          <!-- ENDS $content -->
        </div>
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Members
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="search_members">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group is-empty">
                        <label for="search_key-filter" class="col-md-1 control-label"><i class="zmdi zmdi-search-in-page"></i></label>
                        <div class="col-md-11">
                          <input type="text" class="form-control" name="search_key" id="search_key-filter" placeholder="Search By Name">
                          <input type="hidden" name="page_type"  value="{{ $page_type }}">
                        </div>
                      </div>
            </div>
            
             </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group is-empty">
                        <label for="country-dd" class="col-md-2 control-label"><i class="zmdi zmdi-globe-alt"></i></label>
                        <div class="col-md-10">
                          <select  id="country-dd" name="country" class="form-control  ">
                              <option value="">Select Country</option>
                              @foreach ($countries as $data)
                              <option value="{{$data->id}}">
                                  {{$data->name}}
                              </option>
                              @endforeach
                          </select>
                         
                        </div>
                      </div>
            </div>
            @csrf
            <div class="col-md-6">
              <div class="form-group is-empty">
                        <label for="city-dd" class="col-md-2 control-label"><i class="zmdi zmdi-accounts"></i></label>
                        <div class="col-md-10">
                          <select id="city-dd" name="city" class="form-control  ">
                            <option value="">Select City</option>
                          </select>
                          
                        </div>
                      </div>
            </div>
          </div>
             <div class="row">
            
            <div class="col-md-6">
              <div class="form-group is-empty">
                        <label for="age-from" class="col-md-2 control-label"><i class="zmdi zmdi-cake"></i></label>
                        <div class="col-md-10">
                          <input type="number" class="form-control age_pick" name="age_from" id="age-from" placeholder="Age From">
                        </div>
                      </div>
            </div>
            <div class="col-md-6">
              <div class="form-group is-empty">
                        <label for="age-to" class="col-md-2 control-label"><i class="zmdi zmdi-cake"></i></label>
                        <div class="col-md-10">
                          <input type="number" class="form-control age_pick" name="age_to" id="age-to" placeholder="Age To">
                        </div>
                      </div>
            </div>
          </div>
                      
                      
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="search_members(1 ,'reset')">Clear All</button>
        <button type="button" class="btn btn-primary" onclick="search_members(1 )">Search</button>
      </div>
    </div>
  </div>
</div>
@endsection('content')
<!-- Modal -->

@section('scripts')

<script type="text/javascript">
    jQuery(function ($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('#left-side-menu').find('a').each(function () {
          console.log(path)
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    });
</script>
<script type="text/javascript">
/*Filter Search Function START =========================*/

  function search_members(page=1 , reset=0)
    {
        $('#filterModal').modal('hide');
        
        $('#filter_data').html('<div class="text-center"><div class="preloader pl-lg pls-pink "><svg class="pl-circular" viewBox="25 25 50 50"> <circle class="plc-path" cx="50" cy="50" r="20"></circle></svg></div></div>');
        //$.blockUI();
         if (reset) {$("#search_members").get(0).reset();}
        form_data = new FormData($('#search_members')[0]);
      
        $.ajax({
            url:"{{ route('members-search') }}",
            method:"POST",
            dataType:"JSON",
            cache:false,
            contentType: false,
            processData: false,
            data:form_data,
            
            success:function(data)
            {
              
              console.log(data)
                $('#filter_data').html(data.members_list);
                $('#pagination_link').html(data.pagination_link);
                
            }
        })
    }

   $(document).on('click', '.pagination li a', function(event){
      event.preventDefault();
      var page = $(this).data('ci-pagination-page');
      search_members(event , page);
  });
$(document).ready(function() {
  search_members(1);
});
$(document).on('keyup', '#search_key', function(event) {
  if($(this).val().length > 3)
  {
    search_members(1);
  }
  if($(this).val() == '')
  {
    search_members(1);
  }
});

$(document).on('change', '.age_pick', function(event) {
  event.preventDefault();
  if($(this).val() < 18)
  {
        $(this).val(18)
  }
  if ($(this).attr('name') == 'age_to') 
  {
    
    if($(this).val() < $('[name="age_from"]').val())
    {
          $(this).val($('[name="age_from"]').val())
    }
  }
});

/*Filter Search Function END =========================*/
</script>

<script>
        $(document).ready(function () {
          
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#city-dd").html('');
                 blockui()
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                         
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                         blockui('hide')
                    }
                });
            });
        });
    </script>
@endsection('scripts')

 