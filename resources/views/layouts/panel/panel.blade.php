<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Panel @yield('title') - BUBBLE POP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/panel/assets/images/favicon.ico') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/vendor/bootstrap.min.css') }}">

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

        <!-- Icon Font CSS -->
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/vendor/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/vendor/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/vendor/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/vendor/cryptocurrency-icons.css') }}">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/plugins/plugins.css') }}">

        <!-- Helper CSS -->
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/helper.css') }}">

        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ asset('/panel/assets/css/style.css') }}">

        <!-- Custom Style CSS Only For Demo Purpose -->
        <link id="cus-style" rel="stylesheet" href="{{ asset('/panel/assets/css/style-primary.css') }}">
    </head>
    <body>
        
        <div class="main-wrapper">
            <!-- Header Section Start -->
            @include('layouts.panel.item.navbar')
            <!-- Header Section End -->
      
            <!-- Side Header Start -->
            @include('layouts.panel.item.sidebar')
            <!-- Side Header End -->
      
            <!-- Content Body Start -->
            <div class="content-body">
      
                <!-- Page Headings Start -->
                <div class="row justify-content-between align-items-center mb-10">
      
                    <!-- Page Heading Start -->
                    <div class="col-12 col-lg-auto mb-20">
                        <div class="page-heading">
                            @if (View::hasSection('subtitle') && View::hasSection ('subtitle2'))
                                <h3>@yield('title')<span> / @yield('subtitle') / @yield('subtitle2')</span></h3>
                            @elseif (View::hasSection('subtitle'))
                            <h3>@yield('title')<span> / @yield('subtitle')</span></h3>
                            @else
                                <h3>@yield('title')</h3>
                            @endif
                        </div>
                    </div><!-- Page Heading End -->
      
                </div><!-- Page Headings End -->
      
                <!-- content -->
                @yield('content')
                <!-- end content -->
      
            </div><!-- Content Body End -->
      
            <!-- Footer Section Start -->
            <div class="footer-section">
                <div class="container-fluid">
      
                    <div class="footer-copyright text-center">
                        <p class="text-body-light">2020 &copy; BUBBLE POP</p>
                    </div>
      
                </div>
            </div><!-- Footer Section End -->
      
        </div>

        <!-- JS -->

        <!-- Global Vendor, plugins & Activation JS -->
        <script src="{{ asset('/panel/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/vendor/bootstrap.min.js') }}"></script>
        <!--Plugins JS-->
        <script src="{{ asset('/panel/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/tippy4.min.js.js') }}"></script>
        <!--Main JS-->
        <script src="{{ asset('/panel/assets/js/main.js') }}"></script>

        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <!--Moment-->
        <script src="{{ asset('/panel/assets/js/plugins/moment/moment.min.js') }}"></script>

        <!--Daterange Picker-->
        <script src="{{ asset('/panel/assets/js/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/daterangepicker/daterangepicker.active.js') }}"></script>

        <!--Echarts-->
        <script src="{{ asset('/panel/assets/js/plugins/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/chartjs/chartjs.active.js') }}"></script>

        <!--VMap-->
        <script src="{{ asset('/panel/assets/js/plugins/vmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/vmap/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js') }}"></script>
        <script src="{{ asset('/panel/assets/js/plugins/vmap/vmap.active.js') }}"></script>
        
        @yield('script')
    </body>
</html>