<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title" content="Site Title" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta property="og:image" content="{{ $companylogo }}" />
    <meta property="og:description" content="Site description" />
    <meta name="theme-color" content="#165ef7">

    <link rel="icon" href="{{ $companyfavicon }}" type="image/png">
    <title>@yield('title') - {{ $companyname }}</title>
    <link href="/css/custom-dark.css" rel="stylesheet">
    <link href="/css/asColorPicker.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-wysihtml5.js"></script>
    @yield('scripts')
</head>

<body class="antialiased">
    <nav class="market-navbar navbar navbar-expand-lg btn-block">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: black;" data-feather="align-justify"></i>
            </button>
            <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="market-navbar-large-header market-navbar-header navbar-brand"
                    href="{{ route('admin.index') }}">
                    @if ($navbaricon == 1) <img src="{{ $companylogo }}" height="50"
                        alt="logo" /> @else <h4>{{ $companyname }}</h4>
                    @endif
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;"
                    class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link market-navbar-link active"
                            aria-current="page" href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('admin.settings') }}">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('admin.tickets') }}">Tickets</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('admin.announcements') }}">Announcements</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.knowledgebase') }}">Knowledgebase</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sellers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{-- route('admin.sellers') --}}">Active Sellers</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sellerrequests') }}">Seller
                                    Requests</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        @if (Auth::check()) {{ Auth::user()->name }} @else
                                Account @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if (Auth::check())
                                <li><a class="dropdown-item" href="{{ route('auth.settings') }}"><i
                                            style="width: 16px;" data-feather="user" class="mr-1"></i><span
                                            class="nav-text">Account Settings</span></a></li>
                                <li><a class="dropdown-item" href="{{ route('auth.register') }}"><i
                                            style="width: 16px;" data-feather="sliders" class="mr-1"></i><span
                                            class="nav-text">Seller Dashboard</span></a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('auth.login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('auth.register') }}">Register</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('index') }}">Exit Admin Side</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if (trim($__env->yieldContent('header-title')))
        <div class="header-section background-gradient-primary">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 mt-5 col-max-mobile">
                    <h1 class="color-white" style="text-align: center;">@yield('header-title')</h1>
                    <div class="color-white">
                        @yield('header-breadcrumb')
                        <br><br>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="mb-3"></div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning:</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info:</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    @endif
    @yield('content')
    @if (trim($__env->yieldContent('header-title')))
        </div>
    @endif
</body>

<script src="/vendor/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()

</script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/jquery-clockpicker.min.js"></script>
<script src="/js/morris.min.js"></script>

</html>
