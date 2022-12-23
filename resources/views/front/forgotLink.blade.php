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
                    <form action="{{ route('reset.password.post') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Reset Password
                              </button>
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

@endsection('scripts')
