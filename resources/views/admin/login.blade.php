@if(auth()->guard('admin')->user())
<?php //print_r(auth()->guard('admin')->user()); ?>
@endif
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Sign In | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/public/admin') }}/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{ url('/public/admin') }}/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('/public/admin') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('/public/admin') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('/public/admin') }}/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ url('/public/admin') }}/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a style="color:white;" href="{{route('admin.login')}}" class="d-inline-block auth-logo">
                                   <!--  <img src="{{ url('/public/admin') }}/images/logo-01.jpg" alt="" height="40"> -->
                                   <!-- {{ env('APP_LOGO_NAME') }} -->
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">{{ env('APP_NAME') }}</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to {{ env('APP_NAME') }}.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <div id="error_msg"></div>
                                    @if( Session::has('success')) 

                                        <div class="alert alert-success" role="alert">

                                            {{ Session::get('success') }}

                                        </div>

                                        @endif
                                        
                                        @if( Session::has('error')) 

                                        <div class="alert alert-danger" role="alert">

                                            {{ Session::get('error') }}

                                        </div>

                                        @endif 
                                    <form method="post" action="{{ route('admin.login') }}">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" required id="email" placeholder="Enter email">
                                        </div>

                                        <div class="mb-3">
                                      
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="password" type="password" class="form-control pe-5" placeholder="Enter password" required id="password-input">
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="mt-4">
                                            <button id="sub_btn" class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                     </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> {{ env('APP_NAME') }} <i class="mdi mdi-heart text-danger"></i> by Webwiders
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ url('/public/admin') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/public/admin') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('/public/admin') }}/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('/public/admin') }}/libs/feather-icons/feather.min.js"></script>
    <script src="{{ url('/public/admin') }}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ url('/public/admin') }}/js/plugins.js"></script>

    <!-- particles js -->
    <script src="{{ url('/public/admin') }}/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="{{ url('/public/admin') }}/js/pages/particles.app.js"></script>
    <!-- password-addon init -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

<script type="text/javascript">

</script>

</html>