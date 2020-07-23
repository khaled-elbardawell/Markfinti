{{--{{  confirm to delete this file   }}--}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('assest/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/animate-css/vivify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assest/html/assets/css/site.min.css') }}" rel="stylesheet">
</head>



<body class="theme-cyan font-montserrat light_version">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>
<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>


<div id="app" class="auth-main particles_js">
    <div id="particles-js"></div>

    <div class="auth_div vivify popIn">

        <div class="auth_brand">
            <a class="navbar-brand" >
                <img src="{{  asset('assest/assets/images/logo.png') }}" width="250"  class="d-inline-block align-top mr-2"
                     >
            </a>
        </div>

        @yield('content')

    </div>


</div>
<!-- Scripts -->
<script src="{{ asset('assest/html/assets/bundles/libscripts.bundle.js') }}" defer></script>
<script src="{{ asset('assest/html/assets/bundles/vendorscripts.bundle.js') }}" defer></script>
<script src="{{ asset('assest/html/assets/bundles/mainscripts.bundle.js') }}" defer></script>
</body>
</html>
