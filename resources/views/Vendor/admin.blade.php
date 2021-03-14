<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title" content="{{ trim(View::yieldContent('title')) }} - {{ Settings::key('CompanyName') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta property="og:image" content="{{ Settings::where('key', 'CompanyFavicon')->first()->value }}" />
    <meta property="og:description" content="Our revolutionary platform will help you find the best products." />
    <meta name="theme-color" content="#165ef7">

    <link rel="icon" href="{{ Settings::where('key', 'CompanyFavicon')->first()->value }}" type="image/png">
    <title>@yield('title') - {{ Settings::where('key', 'CompanyName')->first()->value }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/vendor/jquery/jquery.js"></script>
    <script src="/vendor/jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="/themes/default/css/adminlte.min.css">
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/themes/default/css/custom.css">
    <link rel="stylesheet" href="/themes/default/css/alertdark.css">
    <script src="/themes/default/js/adminlte.min.js"></script>
    <script src="/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="/vendor/select2/js/select2.full.min.js"></script>
    <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
    <script src="/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</head>

<body class="antialiased">
    <div class="main-header alert alert-danger alert-server btn-sm mb-0 text-center" style="border-radius: 0px!important;" role="alert">
        <strong>IMPORTANT:</strong> You are running a beta version of MarketSoft. This isn't inteded to be used for full scale production.
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        @if(Route::currentRouteName() == 'admin.users')
            <div style="width: 15rem;" class="input-group input-group-sm">
                <input class="form-control form-control-navbar" id="search" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button onclick="some()" class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        @endif

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="{{ Auth::user()->profile_picture }}" alt="User Avatar" class="img-size-100 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">
                    <i class="fas fa-globe"></i>
                </a>
            </li>
            <li class="nav-item">
                <a id="logout" class="nav-link" href="{{ route('auth.logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
        <a href="index3.html" class="brand-link">
            <img src="{{ Settings::where('key', 'CompanyFavicon')->first()->value }}" alt="o" class="brand-image img-circle" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ Settings::key('CompanyName') }}</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ Auth::user()->profile_picture }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a>
                </div>
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'menu-open') ? 'active' : '' }}">
                        <a href="{{ route('admin.products') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.products') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'menu-open') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.users') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.tickets') ? 'menu-open' : '' }}">
                        <a href="{{ route('admin.tickets') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.tickets') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>
                                Tickets
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/tickets#ticket" id="tab-button" data-name="ticket" onclick="change('ticket')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tickets</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tickets#category" id="tab-button" data-name="category" onclick="change('category')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'menu-open') ? 'active' : '' }}">
                        <a href="{{ route('admin.announcements') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.announcements') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                Announcements
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.knowledgebase') ? 'menu-open' : '' }}">
                        <a href="{{ route('admin.knowledgebase') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.knowledgebase') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Knowledgebase
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/knowledgebase#article" id="tab-button" data-name="article" onclick="change('article')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Articles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/knowledgebase#categories" id="tab-button" data-name="categories" onclick="change('categories')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.settings') ? 'menu-open' : '' }}">
                        <a href="{{ route('admin.settings') }}" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.settings') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/settings#general" id="tab-button" data-name="general" onclick="change('general')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/settings#mail" id="tab-button" data-name="mail" onclick="change('mail')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mail Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/settings#modules" id="tab-button" data-name="modules" onclick="change('modules')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Module Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/settings#roles" id="tab-button" data-name="roles" onclick="change('roles')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/settings#legal" id="tab-button" data-name="legal" onclick="change('legal')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Legal Documents</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/settings#oauth2" id="tab-button" data-name="oauth2" onclick="change('oauth2')" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>OAuth2 Settings</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-center-verticle">@yield('header-title')</h1>
                    </div>
                    <div class="col-sm-6" style="float: right;">
                        @yield('header-breadcrumb')
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="">MarketSoft</a>.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> Beta 0.1.0
        </div>
    </footer>
    </div>
</body>
@include('Vendor.alerts')
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
<script>
    feather.replace()

</script>
<script src="/vendor/customtabs/custom-tabs.js"></script>

</html>
