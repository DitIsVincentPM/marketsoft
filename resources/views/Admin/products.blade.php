{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Admin
@endsection

@section('header-title')
    Products & Services
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
@endsection

@section('content')
    <div class="card shadow" id="loader">
        <div class="card-header">
            Products Table
            <div class="card-tools">
                <button type="button" class="btn btn-tool animate-icon" onclick="create()" data-bs-toggle="modal" data-bs-target="#viewmore">
                    <i class="far fa-plus-square"></i>
                </button>
                <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <table class="mb-0 table caption-top admin-table-footer">
            <thead>
                <tr class="admin-table-header">
                    <th class="admin-table" scope="col">#</th>
                    <th class="admin-table" scope="col">Name</th>
                    <th class="admin-table" scope="col">Description</th>
                    <th class="admin-table" scope="col">Price</th>
                    <th class="text-right admin-table" scope="col">More</th>
                </tr>
            </thead>
            <tbody id="products_table">
                
            </tbody>
        </table>
        <div class="card-footer" id="footer"></div>
    </div>


    <div class="modal fade" id="viewmore" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="product_model">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/API/products.js"></script>
@endsection
