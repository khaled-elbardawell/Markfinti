<!doctype html>
<html lang="en">

<head>
    <title>@yield("title")</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



    <link rel="icon" href="{{ asset('assest/hrms/favicon.ico') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link href="{{ asset('assest/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assest/assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assest/assets/vendor/animate-css/vivify.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assest/html/assets/css/site.min.css') }}" rel="stylesheet">
    @yield("css")
        <style>
            span.required{
                color: #ff0000;
                font-size: 20px;
            }

            .default-logo{
                font-size: 2rem;
                padding: 5px 10px ;
                font-weight: 800;;
                background-color: #e3b982;
                text-align: center;
                border-radius: 50px;
            }
        </style>

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
<!-- Theme Setting -->

<div id="wrapper">
    <div id="megamenu" class="megamenu particles_js">
        <div id="particles-js"></div>
    </div>

    <nav class="navbar top-navbar">
        <div class="container-fluid">
            <div class="navbar-left">
                <div class="navbar-btn">
                    <img src="{{  asset('assest/assets/images/icon.svg')}}" alt="Markfiniti" class="img-fluid logo">
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="icon-menu" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="icon-power "></i> Logout
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="{{route('home')}}">
                <img src="{{ asset('assest/assets/images/logo.png')}} " alt="Markfiniti" class="img-fluid">
            </a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right">
                <i class="lnr lnr-menu icon-close"></i>
            </button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    @if( is_null( auth()->user()->photo ) )
                               <div class="default-logo">{{default_img_profile()}}</div>
                    @else
                        <img src="{{  asset("assest/upload/profiles/" . Auth::user()->photo) }}" class="user-photo" alt="User Profile Picture">

                    @endif

                </div>
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</strong></a>
                                        <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                    					</form>
                                        <li>
                                            <a class="icon-menu" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                                            <i class="icon-power "></i> Logout </a>

                                        </li>
                                        </ul>


                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">


                    <li class="{{ (request()->is('admin/profile*')) ? 'active' : '' }} open"><a href="{{ route('admin.profile.edit') }}"><i class="icon-user"></i><span>Profile</span></a></li>

                                        @can('viewAny',App\User::class)
                                        <li class="{{ (request()->is('admin/manger*')) ? 'active' : '' }} "><a href="{{route('admin.manger.index')}}" ><i class="icon-briefcase"></i><span>Managers</span></a></li>
                                        @endcan


                                        @can('viewAnyClient',App\User::class)
                                        <li class="{{ (request()->is('admin/client*')) ? 'active' : '' }} "><a href="{{route('admin.client.index')}}" ><i class="icon-users"></i><span>Clients </span></a></li>
                                        @endcan

                                        <li class="{{ (request()->is('admin/project*')) ? 'active' : '' }} "><a href="{{route('admin.project.index')}}"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                                <span>Projects</span></a></li>




                                        @can('viewAny',App\TypeReport::class)
                                            <li class="{{ (request()->is('admin/report-type*')) ? 'active' : '' }} "><a href="{{route('admin.type.index')}}"><i class="icon-docs" aria-hidden="true"></i>
                                                    <span>Reports Types</span></a></li>
                                        @endcan

                                        @can('viewAny',App\Service::class)
                                        <li class="{{ (request()->is('admin/service*')) ? 'active' : '' }} "><a href="{{route('admin.service.index')}}" ><i class="icon-layers"></i><span>Service </span></a></li>
                                        @endcan

                                        @can('viewAny',App\Progress::class)
                                            <li class="{{ (request()->is('admin/progress*')) ? 'active' : '' }} "><a href="{{route('admin.progress.index')}}" ><i class="icon-graph"></i><span>Progress </span></a></li>
                                        @endcan


                </ul>
            </nav>
        </div>
    </div>

    <div id="main-content">
        <div class="container-fluid">

                    @include("alerts.success")
                    @include("alerts.errors")
            <div class="pt-5">
                @yield("content")
            </div>

        </div>
    </div>
</div>
<!-- Javascript -->
<!-- Javascript -->
<script src="{{ asset('assest/html/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assest/html/assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('assest/html/assets/bundles/mainscripts.bundle.js') }}"></script>


@yield("js")

</body>
</html>


