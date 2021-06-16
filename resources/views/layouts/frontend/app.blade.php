<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EFContact - @yield('page-title')</title>

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/leaflet.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/map.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/fonts/linearicons/style.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/frontend/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/frontend/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/frontend/css/slick.css') }}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('assets/frontend/css/skins/default.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.ico" type="image/x-icon') }}" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CRoboto:300,400,500,700&amp;display=swap">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/ie10-viewport-bug-workaround.css') }}">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('assets/frontend/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/frontend/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/respond.min.js') }}"></script>
    <![endif]-->

    @yield('extra-styles')
</head>
<body>
    @include('layouts.frontend.header')
    @include('layouts.frontend.partials._banner')
    @include('layouts.frontend.partials._search')

    @yield('content')

    @include('layouts.frontend.footer')


    {{-- SCRIPTS  --}}
    <script src="{{ asset('assets/frontend/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-submenu.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/rangeslider.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.mb.YTPlayer.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.scrollUp.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.filterizr.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/maps.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/app.js') }}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('assets/frontend/js/ie10-viewport-bug-workaround.js') }}"></script>

    @yield('extra-scripts')
</body>
</html>
