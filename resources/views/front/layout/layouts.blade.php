<!DOCTYPE html>

<html lang="en">

 

<head>

     <meta charset="utf-8">

     <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

     <title>Dating App</title>

    

    <!-- Favicon -->

    <!-- <link href="https://megaone.acrothemes.com/innovative1/img/favicon.ico" rel="icon"> -->

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



<body data-offset="90" data-spy="scroll" data-target=".navbar">



<!--start loader-->

<div class="loader center-block">

    <div class="spinner">

        <div class="spinner-container container1">

            <div class="circle1"></div>

            <div class="circle2"></div>

            <div class="circle3"></div>

            <div class="circle4"></div>

        </div>

        <div class="spinner-container container2">

            <div class="circle1"></div>

            <div class="circle2"></div>

            <div class="circle3"></div>

            <div class="circle4"></div>

        </div>



    </div>

</div>

<!--loader end-->



<!--Header Start-->

<header>

    <!--Navigation-->

    <nav class="navbar navbar-top-default navbar-expand-lg navbar-simple nav-box-round">

        <div class="container">

            <a href="{{ url('/') }}" title="Logo" class="logo scroll">

                <img src="{{ url('/public/front') }}/img/logo.png" alt="logo" class="logo-light default">

                <img src="{{ url('/public/front') }}/img/logo.png" alt="logo" class="logo-dark">

            </a>



            <!--Nav Links-->

            <div class="collapse navbar-collapse" id="megaone">

                <div class="navbar-nav ml-auto">

                    <a class="nav-link scroll" href="{{ route('home') }}">Home<span></span></a>

                    <a class="nav-link scroll" href="#services">About<span></span></a>

                    <a class="nav-link scroll" href="#corporate">How its Work<span></span></a>

                    <a class="nav-link scroll" href="#rules">Rules<span></span></a>

                    <a class="nav-link scroll" href="#reviews">Contact<span></span></a>

                    <a class="nav-link scroll" href="#download-app">Our App<span></span></a>

                    <a class="nav-link " href="{{ route('signup') }}">Register<span></span></a>

                    <a class="nav-link" href="{{ route('signin') }}">Login<span></span></a>

                </div>

            </div>



            <!--Side Menu Button-->

                <!-- <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">

                    <span></span>

                    <span></span>

                    <span></span>

                </a> -->

        </div>

    </nav>



    <!--Side Nav-->

    <div class="side-menu hidden">

        <div class="inner-wrapper">

            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>

            <nav class="side-nav w-100">

                <ul class="navbar-nav">

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#home">Home</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#services">Services</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#portfolio-area">Portfolio</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#pricing">Pricing</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#reviews">Reviews</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link scroll" href="#contact">Contact Us</a>

                    </li>

                </ul>

            </nav>



            <div class="side-footer text-white w-100">

                <ul class="social-icons-simple">

                    <li><a class="facebook-text-hvr" href="javascript:void(0)"><i class="fab fa-facebook-f"></i> </a> </li>

                    <li><a class="instagram-text-hvr" href="javascript:void(0)"><i class="fab fa-instagram"></i> </a> </li>

                    <li><a class="twitter-text-hvr" href="javascript:void(0)"><i class="fab fa-twitter"></i> </a> </li>

                </ul>

                <p class="text-white">&copy; {{date('Y')}} {{env('APP_NAME')}}. Made by Webwiders</p>

            </div>

        </div>

    </div>



    <a id="close_side_menu" href="javascript:void(0);"></a>

    <!-- End side menu -->

</header>

<!--Header end-->



@yield('content')





<!--Footer Start-->

<footer class="text-center footer-section">

    <div class="container">

        <div class="footer-top">

            <div class="container">

                <div class="row g-3 justify-content-center g-lg-0">

                    <div class="col-lg-4 col-sm-6 col-12">

                        <div class="footer-top-item lab-item">

                            <div class="lab-inner">

                                <div class="lab-thumb">

                                    <img src="{{ url('/public/front') }}/img/01.png" alt="Phone-icon">

                                </div>

                                <div class="lab-content">

                                    <span>Phone Number : +987 654 3210</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">

                        <div class="footer-top-item lab-item">

                            <div class="lab-inner">

                                <div class="lab-thumb">

                                    <img src="{{ url('/public/front') }}/img/02.png" alt="email-icon">

                                </div>

                                <div class="lab-content">

                                    <span>Email : admin@example.com</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">

                        <div class="footer-top-item lab-item">

                            <div class="lab-inner">

                                <div class="lab-thumb">

                                    <img src="{{ url('/public/front') }}/img/03.png" alt="location-icon">

                                </div>

                                <div class="lab-content">

                                    <span>Address : 30 North West New York 240</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="footer-lower row mt-5">

            <div class="col-md-4">

                <div class="footer-block text-left">

                    <h2 class="text-pink">About Dating</h2>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, neque, quos. Quis vitae, nihil ipsam repellendus magnam cupiditate, optio consequatur esse architecto animi maiores incidunt natus aspernatur, minima illo sapiente.</p>

                </div>

            </div>



            <div class="col-md-4">

                <div class="footer-block text-left">

                    <h2 class="text-pink">Explore Our</h2>

                    <ul class="list-unstyled">

                        <li>

                            <a href="#">About us</a>

                        </li>

                        <li>

                            <a href="#">Report Abuse</a>

                        </li>

                        <li>

                            <a href="#">Price List</a>

                        </li>

                        <li>

                            <a href="#">FAQ</a>

                        </li>

                        <li>

                            <a href="#">Online Safety</a>

                        </li>

                        <li>

                            <a href="#">Kids Protection</a>

                        </li>

                        <li>

                            <a href="#">About us</a>

                        </li>

                    </ul>

                </div>

            </div>



            <div class="col-md-4">

                <div class="footer-social footer-block text-left">

                    <h2 class="text-pink">Follow us</h2>

                    <ul class="list-unstyled">

                        <li><a class="wow fadeInUp" href="javascript:void(0);"><i class="bi bi-facebook"></i></a></li>

                        <li><a class="wow fadeInDown" href="javascript:void(0);"><i class="bi bi-instagram"></i></a></li>

                        <li><a class="wow fadeInUp" href="javascript:void(0);"><i class="bi bi-twitter"></i></a></li>

                        <li><a class="wow fadeInDown" href="javascript:void(0);"><i class="bi bi-youtube"></i></a></li>

                    </ul>

                </div>

            </div>

        </div>

    </div>



    <div class="footer-bottom text-center">

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


<script src="{{ url('/public/front') }}/js/bundle.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}

<!-- Plugin Js -->

<script src="{{ url('/public/front') }}/js/jquery.appear.js"></script>

<script src="{{ url('/public/front') }}/js/jquery.fancybox.min.js"></script>

<script src="{{ url('/public/front') }}/js/parallaxie.min.js"></script>

<script src="{{ url('/public/front') }}/js/wow.min.js"></script>

<!-- REVOLUTION JS FILES -->

<script src="{{ url('/public/front') }}/js/owl.carousel.min.js"></script>

<script src="{{ url('/public/front') }}/js/slick.js"></script>

<script src="{{ url('/public/front') }}/js/slick.min.js"></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJRG4KqGVNvAPY4UcVDLcLNXMXk2ktNfY"></script> -->

<!-- <script src="js/map.js"></script> -->

<!-- custom script -->



<script src="{{ url('/public/front') }}/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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


<script>

//     const $card = document.querySelectorAll('.card');

// let bounds;



// function rotateToMouse(e) {

//   const mouseX = e.clientX;

//   const mouseY = e.clientY;

//   const leftX = mouseX - bounds.x;

//   const topY = mouseY - bounds.y;

//   const center = {

//     x: leftX - bounds.width / 2,

//     y: topY - bounds.height / 2

//   }

//   const distance = Math.sqrt(center.x**2 + center.y**2);

  

//   $card.forEach(eva => {

//     eva.style.transform = `

//     scale3d(1.07, 1.07, 1.07)

//     rotate3d(

//       ${center.y / 100},

//       ${-center.x / 100},

//       0,

//       ${Math.log(distance)* 2}deg

//     )

//   `;

//   })

  

//   // $card.querySelector('.glow').style.backgroundImage = `

//   //   radial-gradient(

//   //     circle at

//   //     ${center.x * 2 + bounds.width/2}px

//   //     ${center.y * 2 + bounds.height/2}px,

//   //     #ffffff55,

//   //     #0000000f

//   //   )

//   // `;

// }

// $card.forEach(eva => {

//     eva.addEventListener('mouseenter', () => {

//       bounds = eva.getBoundingClientRect();

//       document.addEventListener('mousemove', rotateToMouse);

//     });

// });



// $card.forEach(eva => {

//     eva.addEventListener('mouseleave', () => {

//       document.removeEventListener('mousemove', rotateToMouse);

//       eva.style.transform = '';

//       eva.style.background = '';

//     });

// });

</script>



</body>



</html>



