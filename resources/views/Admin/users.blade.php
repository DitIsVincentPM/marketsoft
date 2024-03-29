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
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" placeholder="Search..." name="search" id="search"
                        class="admin-search-input form-control" />
                </div>
                <button type="button" class="btn btn-primary">
                    <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow" id="loader">
        <div class="card-header">
            Users Table
            <div class="card-tools">
                <button type="button" class="btn btn-tool animate-icon" onclick="createusermodal()" data-bs-toggle="modal"
                    data-bs-target="#createuser">
                    <i class="far fa-plus-square"></i>
                </button>
                <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
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

                </tbody>
            </table>
            <div class="card-footer" id="footer"></div>
        </div>
    </div>

    <div class="modal fade" id="viewmore" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="content">
            </div>
        </div>
    </div>

    <!-- Create User -->
    <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="createuserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="createmodal">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/API/users.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });

    </script>
@endsection
