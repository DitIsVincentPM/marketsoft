<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title" content="{{trim(View::yieldContent('title'))}} - {{ Settings::key('CompanyName') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta property="og:image" content="{{ Settings::where('key', 'CompanyFavicon')->first()->value }}" />
    <meta property="og:description" content="Our revolutionary platform will help you find the best products." />
    <meta name="theme-color" content="#165ef7">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ Settings::key('CompanyFavicon') }}" type="image/png">
    <title>@yield('title') - {{ Settings::key('CompanyName') }}</title>
    <link href="/css/custom-dark.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/js/jquery.js"></script>
    @yield('scripts')
    <script src="https://kit.fontawesome.com/59ac7ac104.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/themes/splide-skyblue.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="/css/alertdark.css">
</head>

<body class="antialiased">
    {{-- <div class="sub-header">
        <div class="container">
            <div>
                <span>
                    <strong
                        class="text-gray-bold">{{ Shorten::string(Announcements::GetLatest()->name, 25) }}:</strong>
                    <span class="text-gray">{{ Shorten::string(Announcements::GetLatest()->description, 56) }}</span>
                    @if (Auth::check())
                        <span class="text-gray-bold pull-right">
                            <strong>WELCOME, <span class="text-uppercase">{{ Auth::user()->name }}</span></strong>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div> --}}
    <nav class="market-navbar navbar navbar-expand-lg btn-block">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: black;" data-feather="align-justify"></i>
            </button>
            <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="market-navbar-large-header market-navbar-header navbar-brand"
                    href="{{ route('index') }}">
                    @if (Settings::key('NavbarIconStatus') == 1) <img src="{{ Settings::key('CompanyLogo') }}" height="35"
                        alt="logo" /> @else <h3 class="mb-0 v-center">{{ Settings::key('CompanyName') }}</h3>
                    @endif
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;"
                    class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link market-navbar-link active"
                            aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('products.index') }}">Online Store</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('announcements.index') }}">Announcements</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('knowledgebase.index') }}">Knowledgebase</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('users') }}">All Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="{{ route('support.ticket') }}">Support Tickets</a>
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
                            @if(Auth::check())
                                <li><a class="dropdown-item" href="{{ route('auth.settings') }}"><i
                                            style="width: 15px;margin-right: 5px!important;" data-feather="user"></i><span
                                            class="nav-text">Account Settings</span></a></li>
                                @if(Permission::is_admin(Auth::user()->role_id))
                                    <li><a class="dropdown-item" href="{{ route('admin.index') }}"><i
                                                style="width: 16px;margin-right: 5px!important;" data-feather="sliders"></i><span
                                                class="nav-text">Administration</span></a></li>
                                @endif
                                <li><a id="logout" class="dropdown-item" href="{{ route('auth.logout') }}"><i
                                            style="width: 16px;margin-right: 5px!important;" data-feather="log-out"></i><span
                                            class="nav-text">Account Logout</span></a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('auth.login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('auth.register') }}">Register</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="header">
        @if ($__env->yieldContent('header-title'))
            <div style="z-index: 500;" class="row">
                <div class="col-1">
                </div>
                <div style="margin-top: 10rem;" class="col-10 col-max-mobile header-breadcrumb">
                    <h1 class="color-white" style="text-transform:uppercase; text-align: center;">@yield('header-title')
                    </h1>
                    <div class="color-white">
                        @yield('header-breadcrumb')
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        @endif
    </div>

    <div class="container">
        @yield('content')

    </div>

    <footer class="mt-5 bg-dark text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Copyright © 2020:
            <a class="text-dark" href="{{ route('index') }}">{{ Settings::key('CompanyName') }}</a>
        </div>
    </footer>
</body>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/vendor/feather-icons/dist/feather.min.js"></script>
<script>
    $('#logout').on('click', function(event) {
        event.preventDefault();

        var that = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to logout of your account",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!'
            }).then((result) => {
            if (result.isConfirmed) {      
                location.href = '{{ route('auth.logout') }}'
            }
        })
    });
</script>

@include('Vendor.alerts')

<script>
    feather.replace();
</script>

</html>
