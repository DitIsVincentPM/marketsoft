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
    <ol class="justify-content-center market-breadcrumb breadcrumb">
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
            <div class="card">
                <div id="active_users" class="card-body">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL SALES</strong></h4>
                    <p>{{ DB::table('ca_ownedProducts')->count() }}</p>
                    <span class="right v-center icon-admin" data-feather="shopping-bag"></span>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h4><strong>TOTAL USERS</strong></h4>
                    <p>{{ DB::table('users')->count() }}</p>
                    <span class="right v-center icon-admin" data-feather="users"></span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4><strong>MONTLY REVENUE</strong></h4>
                    <p>$0</p>
                    <span class="right v-center icon-admin" data-feather="credit-card"></span>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h4><strong>OPEN TICKETS</strong></h4>
                    <p>{{ DB::table('tickets')->where('status', '!=', 3)->count() }}</p>
                    <span class="right v-center icon-admin" data-feather="file"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Users Online
                </div>
                <div class="card-body">
                    @php $s = 0; @endphp
                    @forelse ($active_users as $a_user)
                        @foreach ($users as $user)
                            @if ($a_user->user_id == $user->id)
                                @if (Permission::is_admin($user->role_id) == false)
                                    <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                        <div class='justify-content-center text-center icon-container'>
                                            <img class="admin-img" src="{{ $user->profile_picture }}" width="100px" height="100px"/>
                                            <div class='status-circle'>
                                                <div class="demo-up">
                                                    <span class="server-status" type="up"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p>
                                                <span>{{ $user->name }}</span>
                                                <br>
                                                <small>{{ $user->Role->name }}</small>
                                            </p>
                                        </div>
                                    </div>
                                    @php $s = $s + 1; @endphp
                                @endif
                            @endif
                        @endforeach
                        @endforeach
                        @if ($s == 0)
                            <div class="col-12">
                                <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1" role="alert">
                                    Currently there are <strong>0 members</strong> online!
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Staff Online
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php $x = 0; @endphp
                            @foreach ($admins_online as $a_user)
                                @foreach ($users as $user)
                                    @if ($a_user->user_id == $user->id)
                                        @if (Permission::is_admin($user->role_id) == true)
                                            <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                                <div class='justify-content-center text-center icon-container'>
                                                    <img class="admin-img" src="{{ $user->profile_picture }}" width="100px" height="100px"/>
                                                    <div class='status-circle'>
                                                        <div class="demo-up">
                                                            <span class="server-status" type="up"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <p>
                                                        <span>{{ $user->name }}</span>
                                                        <br>
                                                        <small>{{ $user->Role->name }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            @php $x = $x + 1; @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            @if ($x == 0)
                                <div class="col-12">
                                    <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1"
                                        role="alert">
                                        Currently there are <strong>0 staff members</strong> online!
                                    </div>
                                </div>
                            @endif
                        </div>
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
                            fontColor: 'white'
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'white'
                            },
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: 'white'
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
