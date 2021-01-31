{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.admin')

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
<div class="primary-section">
    <div class="row team-users-row">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$0,00</div>
                            </div>
                            <div class="col-auto">
                                <i style="width: 50px;" data-feather="dollar-sign" class="mr-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                            </div>
                            <div class="col-auto">
                                <i style="width: 50px;" data-feather="user" class="mr-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                            </div>
                            <div class="col-auto">
                                <i style="width: 50px;" data-feather="archive" class="mr-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Sellers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col-auto">
                                <i style="width: 50px;" data-feather="bar-chart-2" class="mr-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Reminders</h6>
                </div>
                <table class="admin-table-footer table">
                    <tbody>
                        <tr>
                            <td><strong><span style='color: gray;'>Seller Requests:</span></strong></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td><strong><span style='color: gray;'>Product Approvals:</span></strong></td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td><strong><span style='color: gray;'>Tickets Open:</span></strong></td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td><strong><span style='color: gray;'>Users on site:</span></strong></td>
                            <td>200</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Overview</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection