<!doctype html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">



<head>



    <meta charset="utf-8" />

    <title>Dashboard | {{ env('APP_NAME') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ url('/public/admin') }}/images/favicon.ico">



    <!-- jsvectormap css -->

    <link href="{{ url('/public/admin') }}/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />



    <!--Swiper slider css-->

    <link href="{{ url('/public/admin') }}/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert css-->

    <link href="{{ url('/public/admin') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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



    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

    <style>.paginate_button.active {

        background: linear-gradient(to bottom, #585858 0%, #111 100%);

    }</style>



</head>

<?php /*

 helper(['form', 'url']);

use App\Models\Common_model;

$this->common_model = new Common_model();

$this->session = \Config\Services::session();

$this->admin_id = 0;

$this->admin = ['name'=>''];

if ($this->session->has('admin_id')) {

    $this->admin_id = $this->session->get('admin_id');



    $this->admin = $this->common_model->GetSingleData('admin' , array('id' =>$this->admin_id));

    //print_r($this->auth);

}*/



?>



<body>



    <!-- Begin page -->

    <div id="layout-wrapper">



        @include('admin.layout.headers')

        <!-- ========== App Menu ========== -->

        @include('admin.layout.sidebar')

        <!-- Left Sidebar End -->

        <!-- Vertical Overlay-->

        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->

        <!-- Start right Content here -->

        <!-- ============================================================== -->

        <div class="main-content">

            @yield('content')



            <!-- End Page-content -->



            <footer class="footer">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-6">

                            <script>

                                document.write(new Date().getFullYear())

                            </script> © DATING

                        </div>

                        <div class="col-sm-6">

                            <div class="text-sm-end d-none d-sm-block">

                                Design & Develop by Webwiders

                            </div>

                        </div>

                    </div>

                </div>

            </footer>

        </div>

        <!-- end main content-->

    </div>

    <!-- END layout-wrapper -->



    @include('admin.layout.footer')



    <!-- JAVASCRIPT -->

    <script src="{{ url('/public/admin') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ url('/public/admin') }}/libs/simplebar/simplebar.min.js"></script>

    <script src="{{ url('/public/admin') }}/libs/node-waves/waves.min.js"></script>

    <script src="{{ url('/public/admin') }}/libs/feather-icons/feather.min.js"></script>

    <script src="{{ url('/public/admin') }}/js/pages/plugins/lord-icon-2.1.0.js"></script>

    <!-- <script src="{{ url('/public/admin') }}/js/plugins.js"></script> -->

    <script type="text/javascript">

        (document.querySelectorAll("[toast-list]") || document.querySelectorAll("[data-choices]") || document.querySelectorAll("[data-provider]")) && (document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'><\/script>"), document.writeln("<script type='text/javascript' src='{{ url('/public/admin') }}/libs/choices.js/public/assets/scripts/choices.min.js'><\/script>"), document.writeln("<script type='text/javascript' src='{{ url('/public/admin') }}/libs/flatpickr/flatpickr.min.js'><\/script>"));

    </script>

    <!-- prismjs plugin -->

    <script src="{{ url('/public/admin') }}/libs/prismjs/prism.js"></script>

    <!-- <script src="{{ url('/public/admin') }}/libs/list.js/list.min.js"></script> -->

    <!-- <script src="{{ url('/public/admin') }}/libs/list.pagination.js/list.pagination.min.js"></script> -->



    <!-- listjs init -->

    <!-- <script src="{{ url('/public/admin') }}/js/pages/listjs.init.js"></script> -->



    <!-- Sweet Alerts js -->

    <script src="{{ url('/public/admin') }}/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- apexcharts -->

    <script src="{{ url('/public/admin') }}/libs/apexcharts/apexcharts.min.js"></script>



    <!-- Vector map-->

    <script src="{{ url('/public/admin') }}/libs/jsvectormap/js/jsvectormap.min.js"></script>

    <script src="{{ url('/public/admin') }}/libs/jsvectormap/maps/world-merc.js"></script>



    <!--Swiper slider js-->

    <script src="{{ url('/public/admin') }}/libs/swiper/swiper-bundle.min.js"></script>



    <!-- Dashboard init -->

    <script src="{{ url('/public/admin') }}/js/pages/dashboard-ecommerce.init.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!--script type="text/javascript" src="{{ url('/public/admin') }}/js/dataTables.bootstrap.min.js"></script-->



    <!-- App js -->

    <script src="{{ url('/public/admin') }}/js/app.js"></script>



    <script type="text/javascript">

        var url = window.location.href;

        $('.navbar-nav li').each(function() {

            let anchor = $(this).children('a');

            console.log(url)

            if ($(anchor).attr('href') == url || $(anchor).attr('href') + '#' == url) {

                anchor.addClass('active');

                anchor.parents('div').addClass('show').prev('a').removeClass('collapsed').addClass('collapse').attr('aria-expanded', true);



            }

        });

    </script>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script>

    $(document).ready(function() {

        $('#example23').DataTable();

    });

</script>

    <!-- <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=65793fxb90bag05d09k8xtxe28y06z0ee9cc5uedgbtwrdnf"></script>

    <script>

        tinymce.init({

            selector: '.textarea',

            height: 480,

            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

            setup: function(editor) {

                editor.on('change', function() {

                    tinymce.triggerSave();

                });

            }

        });

    </script> -->
<!-- <script src="https://cdn.tiny.cloud/1/65793fxb90bag05d09k8xtxe28y06z0ee9cc5uedgbtwrdnf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
    $(document).ready(function(){
         tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
          setup: function(editor) {

                    editor.on('change', function() {

                        tinymce.triggerSave();

                    });

                }

        });
    });
   
  </script>

     -->

		

		<!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

		<script type="text/javascript">

		$(function() {

			CKEDITOR.replace('ckedit');

			for (var i in CKEDITOR.instances) {

										

				CKEDITOR.instances[i].on('change', function() { CKEDITOR.instances[i].updateElement() });

										

			}

		});

		

		

		</script> -->
         @yield('scripts')

</body>



</html>