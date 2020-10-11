<!DOCTYPE html>

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>BUBBLE POP - @yield('title')</title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/bootstrap.css') }}" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/style.css') }}">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/jquery.datetimepicker.css') }}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/colors/color1.css" id="colors') }}">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/stylesheets/animate.css') }}">

    <!-- Favicon and touch icons  -->
    <link href="{{ asset('front/icon/apple-touch-icon-48-precomposed.png') }}" rel="apple-touch-icon" sizes="48x48">
    <link href="{{ asset('front/icon/apple-touch-icon-32-precomposed.png') }}" rel="apple-touch-icon-precomposed">
    <link href="icon/favicon.png" rel="shortcut icon">

    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
        <![endif]-->
</head> 
<body class="">
    
    {{-- loader --}}
    @include('layouts.front.item.loader')
    
    <div class="box">

        {{-- navbar --}}
        @include('layouts.front.item.navbar')

        {{-- content --}}
        @yield('content')

        {{-- footer --}}
        @include('layouts.front.item.footer')
        {{-- end footer --}}
    </div>
    {{-- end box  --}}

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.datetimepicker.full.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('front/javascript/bootstrap.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.easing.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('front/javascript/imagesloaded.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.isotope.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/jquery-waypoints.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.magnific-popup.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/smoothscroll.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.flexslider-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/jquery-validate.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('front/javascript/switcher.js') }}"></script> --}}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvV0EE3yFozGhjmUv3BgoyviVdXzCwHlk"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/gmap3.min.js') }}"></script>  
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/javascript/slider.js') }}"></script>

    @yield('script')
</body>