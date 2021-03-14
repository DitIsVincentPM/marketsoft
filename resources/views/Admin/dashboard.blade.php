{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Admin
@endsection

@section('header-title')
    Dashboard
@endsection

@section('header-breadcrumb')
    <ol class="market-breadcrumb breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    @if ($version[1] == 'alert-danger')
        <div class="mb-3 alert alert-danger alert-dismissible fade show mt-3" role="alert">
            Oh no! It seems like your running an old version of marketsoft please update to the newest version!
            <button type="button" hidden class="btn btn-danger btn-sm right v-center">Update</button>
        </div>
    @endif
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card" id="loader">
                <div id="active_users" class="card-body">
                    <p class="mb-0">Loading...</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Sales</span>
                    <span class="info-box-number">{{ DB::table('ca_ownedProducts')->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-user-friends"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{ DB::table('users')->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-warning" style="color: white !important;"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Monthly Revenue</span>
                    <span class="info-box-number">$0</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-comments"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Open Tickets</span>
                    <span class="info-box-number">{{ DB::table('tickets')->where('status', '!=', 3)->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ (DB::table('tickets')->where('status', '!=', 3)->count() /
    DB::table('tickets')->count()) *
    100 }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{ round(
    (DB::table('tickets')->where('status', '!=', 3)->count() /
        DB::table('tickets')->count()) *
        100,
    0,
) }}% of the total tickets
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Recently Added Products</h3>

                    <div class="card-tools">
                        <span title="{{ count($products) }} Products" class="badge badge-info">{{ count($products) }}</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($products as $product)
                            <li class="item">
                                <div class="product-img">
                                    <img src="/images/products/{{ $product->Images[0]->image_url }}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">{{ $product->name }}
                                        <span class="badge badge-warning float-right">${{ $product->price }}</span></a>
                                    <span class="product-description">
                                        {{ Shorten::string($product->description, 50) }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.products') }}" class="uppercase">View All Products</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins Online</h3>

                    <div class="card-tools">
                        <span title="{{ count($admins_online) }} Online admins" class="badge badge-info">{{ count($admins_online) }}</span>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @php $x = 0; @endphp
                        @foreach ($admins_online as $a_user)
                            @foreach ($users as $user)
                                @if ($a_user->user_id == $user->id)
                                    @if (Permission::is_admin($user->role_id) == true)
                                        <li class="item">
                                            <div class="icon-container product-img">
                                                <img class="admin-img img-size-50" alt="{{ $user->name }}" src="{{ $user->profile_picture }}" />
                                                <div class='status-circle'>
                                                    <div class="demo-up">
                                                        <span class="server-status" type="up"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{ $user->name }}
                                                    <span style="background-color: {{ $user->Role->color }} !important; color: white;" class="badge float-right">{{ $user->Role->name }}</span></a>
                                                <span class="product-description">
                                                    {{ $user->email }}
                                                </span>
                                            </div>
                                        </li>
                                        @php $x = $x + 1; @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.users') }}" class="uppercase">View All Users</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Chart(document.getElementById("chart"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                    "October", "November", "December"
                ],
                datasets: [{
                    data: [{{ $newusers[0] }}, {{ $newusers[1] }}, {{ $newusers[2] }},
                        {{ $newusers[3] }}, {{ $newusers[4] }}, {{ $newusers[5] }},
                        {{ $newusers[6] }}, {{ $newusers[7] }}, {{ $newusers[8] }},
                        {{ $newusers[9] }}, {{ $newusers[10] }}, {{ $newusers[11] }}
                    ],
                    label: "New Users",
                    fill: true,
                    backgroundColor: 'rgba(62, 149, 205, 0.7)',
                    pointRadius: 0,
                    borderWidth: 1,
                    pointHitRadius: 20,
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                }, {
                    data: [{{ $sales[0] }}, {{ $sales[1] }}, {{ $sales[2] }},
                        {{ $sales[3] }}, {{ $sales[4] }}, {{ $sales[5] }},
                        {{ $sales[6] }}, {{ $sales[7] }}, {{ $sales[8] }},
                        {{ $sales[9] }}, {{ $sales[10] }}, {{ $sales[11] }}
                    ],
                    label: "Sales",
                    fill: true,
                    backgroundColor: 'rgba(36, 123, 255, 0.7)',
                    pointRadius: 0,
                    pointHitRadius: 20,
                    borderWidth: 1,
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                }]
            },
            options: {
                legend: {
                    labels: {
                        fontColor: 'black'
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'black'
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: 'black'
                        },
                    }]
                }
            }
        });

    </script>
@endsection

@section('scripts')
    <script src="/js/API/active_users.js"></script>
@endsection
