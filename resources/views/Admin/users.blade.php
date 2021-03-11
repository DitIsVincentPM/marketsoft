{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Admin
@endsection

@section('header-title')
    Users
@endsection

@section('header-breadcrumb')
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row">
        <div class="col-10">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" placeholder="Search..." name="search" id="search" class="input-search admin-search-input form-control" />
                </div>
                <button onclick="some()" type="button" class="btn btn-primary">
                    <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow">
        <div class="card-header">
            Users Table
            <span class="pull-right animate-icon" onclick="refresh()" id="refresh" data-feather="refresh-ccw"></span>
        </div>
        <table class="table caption-top admin-table-footer">
            <thead>
                <tr class="admin-table-header">
                    <th class="text-center admin-table" scope="col">#</th>
                    <th class="text-center admin-table" scope="col">Name</th>
                    <th class="text-center admin-table" scope="col">Email</th>
                    <th class="text-center admin-table" scope="col">Role</th>
                    <th class="text-center admin-table" scope="col">Status</th>
                    <th class="padmin-table" scope="col"><span class="pull-right">More</span></th>
                </tr>
            </thead>
            <tbody id="table">
                <tr style="height: 200px;">
                    <th></th>
                    <th></th>
                    <th>
                        <div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </tbody>
        </table>
        <div class="card-footer" id="footer"></div>
    </div>

    <div class="modal fade" id="viewmore" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="content">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/API/users.js"></script>
@endsection
