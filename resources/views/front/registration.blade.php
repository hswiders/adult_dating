@extends('front.layout.register_layouts')

@section('content')
<style type="text/css">
    label.radio_label {
    width: 100%;
    background: #fff;
    margin: 5px 5px 5px 0;
    padding: 10px;
}
label.radio_label input {
    
    margin: 0!important;
   
}
.single-items 
{
    height: auto;
}
</style>
<body data-offset="90" data-spy="scroll" data-target=".navbar">

<section class="single-items center-block parallax contact-sec overlay-sec" id="contact" style="background: url(img/banner-6.jpg)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 contact-box text-center text-md-left">
                <div class="c-box wow fadeInRight">
                    <h4 class="small-heading"><strong class="text-pink">Sign Up</strong></h4>
                    <p class="small-text">Please Enter your details for signup</p>
                    @if( Session::has('message')) 
                        <?php echo Session::get('message'); ?>
                    @endif
                    <form class="contact-form" id="contact-form-data" method="post" onsubmit="return signup(event , this);" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-form">
                            <div class="col-sm-12" id="result"></div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="candidate_fname" name="first_name" placeholder="First Name" required="required">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="candidate_lname" name="last_name" placeholder="Last Name" required="required">
                            </div>
                            <div class="col-12 col-md-12">
                                <input type="email" class="form-control" id="user_email" name="email" placeholder="Email" required="required">
                            </div> 
                            <div class="col-12 col-md-12">
                                <input type="text" class="form-control" id="" name="username" placeholder="Username" required="required">
                            </div> 
                            <div class="col-12 col-md-12 ">
                                
                                <div class="select-date d-flex justify-content-between">
                                <select id="select-day" class="form-control" name="dob_d"></select>
                                <select id="select-month" class="form-control" name="dob_m">
                                    <option value="0">January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                    <option value="4">May</option>
                                    <option value="5">June</option>
                                    <option value="6">July</option>
                                    <option value="7">August</option>
                                    <option value="8">September</option>
                                    <option value="9">October</option>
                                    <option value="10">November</option>
                                    <option value="11">December</option>
                                </select>
                                <select id="select-year" class="form-control" name="dob_y"></select>
                                </div>
                                
                            </div>
                            <div class="col-12 col-md-12">
                                <select  id="country-dd" name="country" class="form-control  ">
                                      <option value="">Select Country</option>
                                      @foreach ($countries as $data)
                                      <option value="{{$data->id}}">
                                          {{$data->name}}
                                      </option>
                                      @endforeach
                                  </select>
                            </div>
                            <div class="col-12 col-md-12">
                                <select id="city-dd" name="city" class="form-control  ">
                                    <option value="">Select City</option>
                                  </select>
                                  
                            </div> 
                            
                            <div class="col-12 col-md-12 d-flex justify-content-between">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="gender" placeholder="" value="male" required="required">Male</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="gender" placeholder="" value="female" required="required">Female</label>
                            </div> 
                            <div class="col-12 col-md-12">
                                <select class="form-control" name="occupation">
                                    <option value="">-Select Occupation-</option>
                                    @forelse ($occupation as $element)
                                        <option value="{{ $element->id }}">{{ $element->title }}</option>
                                    @empty
                                        
                                    @endforelse
                                    
                                </select>
                            </div>
                            <div class="col-12 col-md-12">
                                <input type="password" class="form-control" id="user_subject" name="password" placeholder="Password" required="required">
                            </div>
                            <p id="result1"></p>
                            <div class="col-12 col-md-12">
                                <input type="password" class="form-control" id="user_subject" name="cpassword" placeholder="Confirm Password" required="required">
                            </div>
                           <div class="col-12">
                                <button class="btn btn-blue rounded-pill user-contact contact_btn" type="submit"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>Sign Up
                                </button>
                            </div>
                            <div class="d-block text-center mt-3 w-100">
                                <p class="text-white">Already a member? <a href="{{ route('signin') }}">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection('content')
@section('scripts')

<script type="text/javascript">
  

    function signup(e , form) {
            e.preventDefault();
            var btn = $(form).find('button[type="submit"]')
            var btn_text = btn.text();
            $('.validation').remove()
            formdata = new FormData($(form)[0]);
            $.ajax({
                  url: '{{ route('register') }}',
                  data: formdata,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'json',
                 beforeSend: function() {        
                    btn.prop('disabled' , true);
                    btn.text('Processing..');
                    blockui('show');
                  },
                 success: function(result)
                 {
                    if(result.status == 'success')
                    {
                        blockui('hide');
                        btn.prop('disabled' , false);
                        btn.text(btn_text);
                        //toastr[result.status](result.message)
                        window.location.href = result.redirect
                    }else{
                        blockui('hide');
                        btn.prop('disabled' , false);
                        btn.text(btn_text);
                        toastr[result.status](result.message)
                    }
                    
                  },
                  error :function($xhr,textStatus,res) {
                    btn.prop('disabled' , false);
                    btn.text(btn_text);
                    blockui('hide');
                    res = JSON.parse($xhr.responseText);

                    for (var err in res.errors) 
                    {
                        $("[name='" + err + "']").after("<div  class='label validation alert-danger'>" + res.errors[err] + "</div>");
                        $("[name='" + err + "']").focus();
                    }
                }
            });
           
            
        }

        var daysInMonth = [31,28,31,30,31,30,31,31,30,31,30,31],
    today = new Date(),
    // default targetDate is christmas
    targetDate = new Date(today.getFullYear(), 11, 25); 

setDate(targetDate);
setYears(80) // set the next five years in dropdown

$("#select-month").change(function() {
  var monthIndex = $("#select-month").val();
  setDays(monthIndex);
});

function setDate(date) {
  setDays(date.getMonth());
  $("#select-day").val(date.getDate());
  $("#select-month").val(date.getMonth());
  $("#select-year").val(date.getFullYear()); 
}

// make sure the number of days correspond with the selected month
function setDays(monthIndex) {
  var optionCount = $('#select-day option').length,
      daysCount = daysInMonth[monthIndex];
  
  if (optionCount < daysCount) {
    for (var i = optionCount; i < daysCount; i++) {
      $('#select-day')
        .append($("<option></option>")
        .attr("value", i + 1)
        .text(i + 1)); 
    }
  }
  else {
    for (var i = daysCount; i < optionCount; i++) {
      var optionItem = '#select-day option[value=' + (i+1) + ']';
      $(optionItem).remove();
    } 
  } 
}

function setYears(val) {
  var year = today.getFullYear() - 18;
  for (var i = 0; i < val; i++) {
      $('#select-year')
        .append($("<option></option>")
        .attr("value", year - i)
        .text(year - i)); 
    }
}

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
