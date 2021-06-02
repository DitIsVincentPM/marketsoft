{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    View Product #{{ $product->id }}
@endsection

@section('header-title')
    View Product #{{ $product->id }}
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
    </ol>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="height: 150px;">
                    <div class="icon-card icon-card-primary">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h1 style="font-size: 45px; position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);">
                        {{ $product->purchases }}<span class="ml-2 text-muted text-uppercase"
                            style="font-size: 25px;">SALES</span></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="height: 150px;">
                    <div class="icon-card icon-card-danger">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h1 style="font-size: 45px; position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);">
                        {{ $product->purchases * $product->price }}<span class="ml-2 text-muted text-uppercase" style="font-size: 25px;">EARNINGS</span></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-mb-3 col-sm-6">
            <div style="background-color: #ffff !important;"
                class="cursor-pointer btn-sm text-center list-group-item list-group-item-action">
                <span class="text-center">Settings</span>
            </div>
            <a id="tab-button" data-name="general" onClick="change('general')"
                class="cursor-pointer list-group-item list-group-item-action active">
                <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                <span class="tab-button">General</span>
            </a>
            <a id="tab-button" data-name="modules" onClick="change('modules')"
                class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="box" class="mr-1"></i>
                <span class="tab-button">Modules</span>
            </a>
            <a id="tab-button" data-name="transaction" onClick="change('transaction')"
                class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="credit-card" class="mr-1"></i>
                <span class="tab-button">Transactions</span>
            </a>
        </div>
        <div class="col-lg-9 col-mb-9 col-sm-6">
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
                                <div class="form-text">Put the product name here.</div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                <div class="form-text">Put the product price here.</div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">Product Description</label>
                                <textarea type="text" class="form-control"
                                    name="description">{{ $product->description }}</textarea>
                                <div class="form-text">Put the product description here.</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm pull-right">Submit</button>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="modules">
                <div class="default-tab">
                    <ul style="position: static !important;" class="nav nav-tabs" role="tablist">
                        @foreach ($modules as $module)
                            <li class="@if ($loop->first) active @endif
                                nav-item nav-tabs-item"><a class="nav-link nav-tabs-link" type="button" role="tab"
                                    aria-controls="{{ $module->name }}" @if ($loop->first) aria-selected="true" @else aria-selected="false" @endif data-toggle="tab"
                                    href="#{{ $module->name }}">{{ $module->name }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($modules as $module)
                            <div class="tab-pane @if ($loop->first) active @endif" role="tabpanel" id="{{ $module->name }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Server Name</label>
                                                <input type="text" class="form-control" name="description"
                                                    value="{{ $product->description }}">
                                                <div class="form-text">Put the product description here.</div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Disk Amount (MB)</label>
                                                <input type="text" class="form-control" name="description"
                                                    value="{{ $product->description }}">
                                                <div class="form-text">Here you can put the amout of disk the server of the
                                                    user shoud be revieving</div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Ram Amount (MB)</label>
                                                <input type="text" class="form-control" name="description"
                                                    value="{{ $product->description }}">
                                                <div class="form-text">Here you can put the amout of ram the server of the
                                                    user shoud be revieving</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    <br><br><br>
@endsection

@section('scripts')
    <script>
        var config = {
            "id": "{{ $product->id }}",
            "name": "{{ $product->name }}",
        };

    </script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $(".tabs").tabs();
        });

    </script>
    <script src="/js/custom-tabs.js"></script>
    <script>

    </script>
    <script src="/js/API/product.js"></script>
@endsection
