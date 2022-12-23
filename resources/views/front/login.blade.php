@extends('front.layout.register_layouts')
@section('content')

<body data-offset="90" data-spy="scroll" data-target=".navbar">

<section class="single-items center-block parallax contact-sec overlay-sec" id="contact" style="background: url(img/banner-6.jpg)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 contact-box text-center text-md-left">
                <div class="c-box wow fadeInRight">
                    <h4 class="small-heading">  <strong class="text-pink">Log In</strong></h4>
                    <p class="small-text">Login with your email or your username</p>
                    <form class="contact-form" id="contact-form-data" method="post" onsubmit="return do_login(event , this);">
                        @csrf
                        <div class="row my-form">
                            <div class="col-sm-12" id="result"></div>
                            <div class="col-12 col-md-12">
                                <input type="email" class="form-control" id="user_email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-12 col-md-12">
                                <input type="password" class="form-control" id="user_subject" name="password" placeholder="password" required>
                            </div>
                            <div class="d-flex justify-content-between w-100">
                              <div class="col">
                                <!-- Checkbox -->
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked="">
                                  <label class="form-check-label text-white" for="form2Example31"> Remember me </label>
                              </div>
                          </div>

                          <div class="col text-right">
                            <!-- Simple link -->
                            
                            <a href="{{ route('forgot-password') }}" class="text-white">Forgot password?</a>
                        </div>
                    </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-blue rounded-pill user-contact contact_btn" type="submit"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>Login
                                </button>
                            </div>

                             <div class="d-block text-center mt-3 w-100">
                               <a href="{{ url('/') }}" class="btn btn-blue">Back to home</a> <p class="text-white">Your don't have an account? <a href="{{ route('signup') }}">Signup</a></p>
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
  

    function do_login(e , form) {
            e.preventDefault();
            var btn = $(form).find('button[type="submit"]')
            $('.validation').remove()
            var btn_text = btn.text()
            
            formdata = new FormData($(form)[0]);
            $.ajax({
                  url: '{{ route('login') }}',
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
                        
                        //toastr[result.status](result.message)
                        window.location.href = result.redirect
                    }
                    if(result.status == 'error')
                    {
                        toastr[result.status](result.message)
                    }
                    blockui('hide');
                    btn.prop('disabled' , false);
                    btn.text(btn_text);
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
</script>

@endsection('scripts')