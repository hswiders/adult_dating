@extends('front.users.layouts.header')
<style type="text/css">
  #app_sidebar-left
  {
    display: none;
  }
</style>
    @section('content')
      <section class="left_align_content mt-65">
  <div class="m-3 pt-3">
    <div class="card">
      <header class="card-heading p-2">
        <h2 class="card-title h3 text-black fw-bold">{{$title}}</h2>
        <p class="m-0 p-0">{{$subtitle}}</p>
        <div class="card-search"> 
          <form class="form-horizontal" id="search_members">
            <div class="form-group is-empty">
              <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"> <i class="zmdi zmdi-close"></i></a>
              <input type="text" placeholder="Search and press enter..." name="search_key1" id="search_key1" class="form-control" autocomplete="off">
              @csrf
              <input type="hidden" name="page_type" value="pin_by">
            </div>
         </form>
        </div>
        <ul class="card-actions icons right-top">
                      <li>
                        <a href="javascript:void(0)" data-card-search="open">
                          <i class="zmdi zmdi-search"></i>
                        </a>
                      </li>
                  </ul>
      </header>
    </div>
    <div class="row mx-3" id="filter_data">
      {!! (string)view('front.users.ajax_data.user_listing-layout2', ['members' => $members,'type'=>$type]) !!}
    </div>
  </div>

        
@endsection
@section('right_sidebar')

@include('front.users.layouts.sidebar_profile')

@endsection
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
  //search_members(1);
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

 