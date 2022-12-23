<!DOCTYPE html>

<html lang="en">

 

<head>

     <meta charset="utf-8">

     <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

     <title>Dating App</title>

    

    <!-- Favicon -->

  <!--   <link href="https://megaone.acrothemes.com/innovative1/img/favicon.ico" rel="icon"> -->

    <!-- Bundle -->

    <link href="{{ url('/public/front') }}/css/bundle.min.css" rel="stylesheet">

    <link href="{{ url('/public/front') }}/css/revolution-settings.min.css" rel="stylesheet">

    <link href="{{ url('/public/front') }}/css/owl.carousel.min.css" rel="stylesheet">



    <!-- Plugin Css -->

    <link href="{{ url('/public/front') }}/css/jquery.fancybox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/public/front') }}/css/line-awesome.min.css">

    <link rel="stylesheet" href="{{ url('/public/front') }}/css/slick-theme.css">

    <link rel="stylesheet" href="{{ url('/public/front') }}/css/slick.css">

    <!-- Style Sheet -->

    <link href="{{ url('/public/front') }}/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>



@yield('content')



<footer>

 <div class="footer-bottom text-center m-0">

        <div class="container">

            <p class="company-about fadeIn">© 2022 All Rights Reserved.</p>    

        </div>

    </div>

</footer>

<!--Footer End-->



<!--Scroll Top-->

<a class="scroll-top-arrow" href="javascript:void(0);"><i class="bi bi-arrow-up"></i></a>

<!--Scroll Top End-->



<!-- JavaScript -->

{{-- <script src="{{ url('/public/front') }}/js/bundle.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Plugin Js -->

<script src="{{ url('/public/front') }}/js/jquery.appear.js"></script>

<script src="{{ url('/public/front') }}/js/jquery.fancybox.min.js"></script>

<script src="{{ url('/public/front') }}/js/parallaxie.min.js"></script>

<script src="{{ url('/public/front') }}/js/wow.min.js"></script>

<!-- REVOLUTION JS FILES -->

<script src="{{ url('/public/front') }}/js/owl.carousel.min.js"></script>

<script src="{{ url('/public/front') }}/js/slick.js"></script>

<script src="{{ url('/public/front') }}/js/slick.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  />

<script type="text/javascript">
      function blockui(action='show') {
          if (action == 'show') 
          {
            $.blockUI({message:'<div class="spinner-border text-primary" role="status"></div>',css:{backgroundColor:"transparent",border:"0"},overlayCSS:{backgroundColor:"#fff",opacity:.8}})
          }
          else
          {
             $.unblockUI()
          }
        }
</script>
@if( Session::has('success')) 
<script type="text/javascript">
    toastr['success']('{{  Session::get('success') }}', 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
</script>
    
@endif
@if( Session::has('error')) 

    <script type="text/javascript">
    toastr['error']('{{  Session::get('error') }}', 'Error!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
</script>
@endif
@yield('scripts')


</body>



</html>