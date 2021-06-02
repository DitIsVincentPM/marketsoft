<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title"
        content="{{ trim(View::yieldContent('title')) }} - {{ Settings::key('CompanyName') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta property="og:image" content="{{ Settings::key('CompanyFavicon') }}" />
    <meta property="og:description" content="Our revolutionary platform will help you find the best products." />
    <meta name="theme-color" content="#165ef7">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ Settings::key('CompanyFavicon') }}" type="image/png">
    <title>@yield('title') - {{ Settings::key('CompanyName') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Vendor.dependencies')
    @yield('scripts')
</head>

<body class="antialiased">
    <div class="wrapper">
        <nav class="navbar navbar-expand-md nav-transparant">
            <div class="container">
                <a href="{{ route('index') }}" class="navbar-brand">
                    <span class="brand-text font-weight-light">{{ Settings::key('CompanyName') }}</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav navbar-mobile">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">Store</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('knowledgebase.index') }}" class="nav-link">Knowledgebase</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('announcements.index') }}" class="nav-link">Announcements</a>
                        </li>
                    </ul>

                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span hidden class="badge badge-warning navbar-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <span class="dropdown-header">0 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 0 new messages
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        @php
                            $total = 0;
                            foreach (ShoppingCart::GetShoppingCart() as $item) {
                                $total = $total + $item->qty;
                            }
                        @endphp
                        <a class="nav-link" href="{{ route('shoppingcart.index') }}">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="badge badge-danger navbar-badge">{{ $total }}</span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-user"></i>
                                <span hidden class="badge badge-warning navbar-badge">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('clientarea.index') }}" class="dropdown-item">
                                    <i class="fas fa-cube mr-2"></i> Client Area
                                </a>
                                <a href="{{ route('auth.settings') }}" class="dropdown-item">
                                    <i class="fas fa-user-cog mr-2"></i> Account Settings
                                </a>
                                <a href="{{ route('auth.logout') }}" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                                @if (Permission::is_admin(Auth::user()->role_id))
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('admin.index') }}" class="dropdown-item">
                                        <i class="fas fa-cogs mr-2"></i> Admin Side
                                    </a>
                                @endif
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}" role="button">
                                <i class="fas fa-user"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="content-wrapper ml-0">
            <div class="content-header header-breadcrumb @hasSection('smallbar') mb-0 @endif">
                @hasSection('home')
                    @yield('home')
                @else
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 header-title"> @yield('header-title')</h1>
                            </div>
                            <div class="col-sm-6">
                                @yield('header-breadcrumb')
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @hasSection('smallbar')
            <nav class="w-100 navbar navbar-expand-md second-color p-1 mb-5">
                <div class="container">
                    <ul class="navbar-nav navbar-mobile">
                    @yield('smallbar')
                    </ul>
                </div>
            </nav>
            @endif
            <div class="content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <footer class="main-footer">
            <strong>Copyright &copy; 2021 MarketSoft</strong> All rightsreserved.
        </footer>
    </div>
</body>

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
