<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ $companyname }}</title>
    <link href="/css/custom.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/boostrap/css/theme.min.css" rel="stylesheet">
    <script src="/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body class="antialiased">
    <nav class="market-navbar navbar navbar-expand-lg" style="position:absolute; padding-bottom: 0px; padding-top: 0px; background-color: transparent !important;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: black;" data-feather="align-justify"></i>
            </button>
            <div class="container collapse navbar-collapse" style="color: white;" id="navbarTogglerDemo01">
                <a class="market-navbar-large-header market-navbar-header navbar-brand" href="{{ route('index.home') }}" style="margin-right: 80px;">
                    @if($navbaricon == 1) <img src="{{ $companylogo }}" height="50" alt="logo" /> @else <h4>{{ $companyname }}</h4> @endif
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;" class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link market-navbar-link active" aria-current="page" href="{{ route('index.home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="color-white dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="color-white dropdown-item" href="{{-- route('products.digital') --}}">Digital Products</a></li>
                            <li><a class="color-white dropdown-item" href="{{-- route('products.physical') --}}">Physical Products</a></li>
                            <li><a class="color-white dropdown-item" href="{{ route('products.index') }}">View All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Team
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="color-white dropdown-item" href="{{-- route('team.sellers') --}}">Sellers & Teams</a></li>
                            <li><a class="color-white dropdown-item" href="{{ route('team.users') }}">User Accounts</a></li>
                            <li><a class="color-white dropdown-item" href="{{-- route('team.management') --}}">Management</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Information
                        </a>
                        <ul class="color-white dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="color-white dropdown-item" href="{{ route('announcements.index') }}">Announcements</a></li>
                            <li><a class="color-white dropdown-item" href="{{ route('knowledgebase.index') }}">Knowledgebase</a></li>
                            <li><a class="color-white dropdown-item" href="{{-- route('information.legal') --}}">Legal Documents</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Support
                        </a>
                        <ul class="color-white dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="color-white dropdown-item" href="{{-- route('support.contact') --}}">Contact Us</a></li>
                            <li><a class="color-white dropdown-item" href="{{-- route('support.ticket') --}}">Submit a Ticket</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link market-navbar-link text-font-bebasneue" href="{{ route('auth.seller') }}">Become a Seller</a>
                    </li>
                    <li class="pull-right nav-item dropdown">
                        <a class="color-white market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::check()) {{ Auth::user()->name }} @else Account @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if(Auth::check())
                            <li><a class="color-white dropdown-item" href="{{ route('auth.settings') }}"><i style="width: 16px;" data-feather="user" class="mr-1"></i><span class="nav-text">Account Settings</span></a></li>
                            <li><a class="color-white dropdown-item" href="{{ route('auth.register') }}"><i style="width: 16px;" data-feather="sliders" class="mr-1"></i><span class="nav-text">Seller Dashboard</span></a></li>
                            @if(Auth::user()->is_admin)
                            <li><a class="color-white dropdown-item" href="{{ route('admin.index') }}"><i style="width: 16px;" data-feather="settings" class="mr-1"></i><span class="nav-text">Admin Side</span></a></li>
                            @endif
                            @else
                            <li><a class="color-white dropdown-item" href="{{ route('auth.login') }}">Login</a></li>
                            <li><a class="color-white dropdown-item" href="{{ route('auth.register') }}">Register</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if (trim($__env->yieldContent('header-title')))
    <div class="header-height header-section background-gradient-primary">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10 mt-20 col-max-mobile">
                <h1 class="color-white" style="text-align: center;">@yield('header-title')</h1>
                <div class="color-white">
                    @yield('header-breadcrumb')
                </div>
            </div>
            <div class="col-1">
            </div>
        </div>
    </div>
    <span style="transform: rotate(-3deg); margin-top: -4%; width: 110% !important; height: 15% !important; background-color: white; position:absolute;"></span>
    <div class="container">
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
@if(Route::currentRouteName() === 'index.home')
<script src="/owl/js/owl.carousel.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endif
<script>
    feather.replace()
</script>

</html>