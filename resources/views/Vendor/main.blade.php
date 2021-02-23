<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $companyfavicon }}" type="image/png">
    <title>@yield('title') - {{ $companyname }}</title>
    @if (Auth::check())
        @if (Auth::user()->user_theme == 1)
            <link href="/css/custom-dark.css" rel="stylesheet">
        @elseif(Auth::user()->user_theme == 0)
            <link href="/css/custom-light.css" rel="stylesheet">
        @endif
    @else
        <link href="/css/custom-light.css" rel="stylesheet">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/js/jquery.js"></script>
    @yield('scripts')
</head>

<body class="antialiased">
    <div class="nav">
        <div class="ml-5 mt-4 navigation-branding">
            @if ($navbaricon == 1)
                <img style="margin-left: 3%;" src="{{ $companylogo }}" width="200" />
            @else
                @if ($companyname == 'MarketSoft')
                    <a href="/">
                        <p style="margin-left: 3%;">
                            <span class="nav-market">Market</span><span class="nav-soft">Soft</span>
                        </p>
                    </a>
                @else
                    <p style="margin-left: 3%;">{{ $companyname }}</p>
                @endif
            @endif
        </div>
        <div class="mr-5 navigation">
            <ul class="ul">
                <li><a href="/">Home</a></li>
                <li><a data-bs-toggle="dropdown">Products</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="{{-- route('products.digital') --}}">Digital Products</a>
                        <a class="dropdown-item" href="{{-- route('products.physical') --}}">Physical Products</a>
                        <a class="dropdown-item" href="{{ route('products.index') }}">View All Products</a>
                    </ul>
                </li>
                <li class="dropdown"><a data-bs-toggle="dropdown">Information</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="{{ route('announcements.index') }}">Announcements</a>
                        <a class="dropdown-item" href="{{ route('knowledgebase.index') }}">Knowledgebase</a>
                    </ul>
                </li>
                <li><a data-bs-toggle="dropdown">Support</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="{{-- route('support.contact') --}}">Contact Us</a>
                        <a class="dropdown-item" href="{{ route('support.ticket') }}">Submit a Ticket</a>
                    </ul>
                </li>
                @if (Auth::check())
                    <li class="li-profile"><a data-bs-toggle="dropdown">{{ Auth::user()->name }} </a>
                        <ul class="mt-2 dropdown-menu dropdown-menu-left">
                            @if (Auth::check())
                                <a class="dropdown-item" href="{{ route('auth.settings') }}"><i style="width: 16px;"
                                        data-feather="user" class="mr-1"></i><span class="nav-text">Account
                                        Settings</span></a>
                                <a class="dropdown-item" href="{{ route('auth.logout') }}"><i style="width: 16px;"
                                        data-feather="log-out" class="mr-1"></i><span class="nav-text">Account
                                        Logout</span></a>
                                @if (Permission::check(['Admin', 'view']) == true)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                                        <span class="nav-text">Admin Side</span>
                                    </a>
                                @endif
                            @else
                                <a class="dropdown-item" href="{{ route('auth.login') }}">Login</a>
                                <a class="dropdown-item" href="{{ route('auth.register') }}">Register</a>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="header">
        @if ($__env->yieldContent('header-title'))
            <div style="z-index: 500;" class="row">
                <div class="col-1">
                </div>
                <div style="margin-top: 10%;" class="col-10 col-max-mobile">
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
        <div style="width: 400px; padding: 0% !important; padding-right: 1rem !important;"
            class="accordion position-fixed bottom-0 end-0 p-3">
            <div class="accordion-item">
                <h2 class="accordion-header" style="background-color: white;" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#shoppingcart" aria-expanded="false" aria-controls="shoppingcart">
                        Shoppingcart
                    </button>
                </h2>
                <div id="shoppingcart" class="accordion-collapse collapse" style="background-color: white;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Quantity</th>
                                <th scope="col">Item</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach (ShoppingCart::GetShoppingCart() as $item)
                                @foreach (Products::GetAll() as $product)
                                    @if ($item->product_id == $product->id)
                                        <tr>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price * $item->qty }}</td>
                                        </tr>
                                        @php
                                            $total = $total + $product->price * $item->qty;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td>Shipping:</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Tax:</td>
                                <td>${{ ($total / 100) * 6 }}</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Total:</td>
                                <td>${{ $total + ($total / 100) * 6 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

@yield('footer')
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/vendor/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()

</script>

</html>
