{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Admin
@endsection

@section('header-title')
    View Product #{{ $product->id }}
@endsection

@section('header-breadcrumb')
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL SALES</strong></h4>
                    <p>0</p>
                    <span class="right v-center icon-admin" data-feather="shopping-bag"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL VIEWS</strong></h4>
                    <p>0</p>
                    <span class="right v-center icon-admin" data-feather="users"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL EARNINGS</strong></h4>
                    <p>$0</p>
                    <span class="right v-center icon-admin" data-feather="credit-card"></span>
                </div>
            </div>
        </div>
        <div class="col-3">
            <a style="background-color: #3f435a !important;" class="cursor-pointer btn-sm text-center list-group-item list-group-item-action">
                <span class="text-center">Settings</span>
            </a>
            <a id="tab-button" data-name="general" onClick="change('general')" class="cursor-pointer list-group-item list-group-item-action active">
                <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                <span class="tab-button">General</span>
            </a>
            <a id="tab-button" data-name="sections" onClick="change('sections')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="sliders" class="mr-1"></i>
                <span class="tab-button">Sections</span>
            </a>
            <a id="tab-button" data-name="images" onClick="change('images')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="image" class="mr-1"></i>
                <span class="tab-button">Images</span>
            </a>
            <a id="tab-button" data-name="transaction" onClick="change('transaction')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="credit-card" class="mr-1"></i>
                <span class="tab-button">Transactions</span>
            </a>
        </div>
        <div class="col-9">
            <div style="display: block;" id="tab-content" data-name="general">
                <div class="card">
                    <div class="card-header">
                        General Settings
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                <div class="form-text">Putt the product name here.</div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                <div class="form-text">Putt the product price here.</div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">Product Description</label>
                                <textarea type="text" class="form-control" name="description">{{ $product->description }}</textarea>
                                <div class="form-text">Putt the product description here.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="sections">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 mt-1">
                                Sections
                            </div>
                            <div class="text-right col-4">
                                <button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
                <ul id="sortable">
                </ul>
            </div>
            <div style="display: none;" id="tab-content" data-name="images">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="transaction">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/custom-tabs.js"></script>
    <script src="/js/API/product.js"></script>
@endsection
