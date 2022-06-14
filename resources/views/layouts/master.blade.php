<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>SmsManager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body class="">

    <nav class="pcoded-navbar menupos-fixed">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>dashboard</label>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fa fa-users text-primary"></i>
                            </span><span class="pcoded-mtext">Cadry</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('departments') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-sitemap text-primary"></i>
                            </span><span class="pcoded-mtext">Departments</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('archive_sms') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-file-archive text-primary"></i>
                            </span><span class="pcoded-mtext">Archive</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('actions') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-calendar-check text-primary"></i>
                            </span><span class="pcoded-mtext">Actions</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('actions') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-clock text-warning"></i>
                            </span><span class="pcoded-mtext">Submitted</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('actions') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-check-circle text-success"></i>
                            </span><span class="pcoded-mtext">Accepted</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('holidays') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="fas fa-hospital-symbol text-primary"></i>
                            </span><span class="pcoded-mtext">Holidays</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-purple">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse"><span></span></a>
            <a href="/" class="b-brand">

                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="" class="logo-thumb">
            </a>
            <a class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="full-screen" onclick="javascript:toggleFullScreen()"><i
                            class="feather icon-maximize"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/images/user/avatar-1.jpg') }}" class="img-radius wid-40"
                                alt="User-Profile-Image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" class="img-radius"
                                    alt="User-Profile-Image">
                                <span>{{ Auth::user()->name }}</span>
                                <a href="{{ route('logout') }}" class="dud-logout" title="Logout"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i>
                                        Profile</a></li>
                                <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i>
                                        My
                                        Messages</a></li>
                                <li><a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>


    <div class="pcoded-main-container">
        <div class="pcoded-content">
            @yield('content')

        </div>
    </div>

    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    @yield('scripts')
    @stack('scripts')
</body>

<!-- Mirrored from lite.codedthemes.com/gradient-able/bootstrap/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 Nov 2021 12:04:49 GMT -->

</html>
