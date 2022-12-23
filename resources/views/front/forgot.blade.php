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
                    <h4 class="small-heading"><strong class="text-pink">Forgot Password</strong></h4>
                    <p class="small-text">Please Enter your registered Email</p>
                    @if( Session::has('message')) 
                        <?php echo Session::get('message'); ?>
                    @endif
                    <form class="contact-form"  method="post" id="handleAjax" action="{{route('do-forgot')}}" name="postform">
                        <div class="row my-form">
                            
                            <div class="col-12 col-md-12">
                                @csrf
                                <input type="email" class="form-control" id="user_email" value="{{old('email')}}" name="email" placeholder="Email" required="required">
                            </div> 
                            <div class="col-12">
                                <button class="btn btn-blue rounded-pill user-contact contact_btn" type="submit"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>Forgot
                                </button>
                            </div>
                            <div class="d-block text-center mt-3 w-100">
                                <p class="text-white">Want to login? <a href="{{ route('signin') }}">Click here</a></p>
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

 <script>
    $(function() {
    // handle submit event of form
      $(document).on("submit", "#handleAjax", function() {
        var e = this;
        // change login button text before ajax
        $(this).find("[type='submit']").html("Processing..");
         $('.alert-danger').remove();
        $.post($(this).attr('action'), $(this).serialize(), function(data) {

          $(e).find("[type='submit']").html("Forgot Password");
          if (data.status) { // If success then redirect to login url
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
              window.location = data.redirect_location;
            })
            
          }
        }).fail(function(response) {
            // handle error and show in html
          $(e).find("[type='submit']").html("Forgot Password");
          $(".alert").remove();
          var erroJson = JSON.parse(response.responseText);
          
          for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }
        });
        return false;
      });
    });
  </script>
@endsection
