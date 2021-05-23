{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Create Product
@endsection

@section('header-title')
    Create Product
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Create Product
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Name:</span>
                                </div>
                                <input type="text" id="name" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Price:</span>
                                </div>
                                <input type="number" id="price" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Description (Short):</span>
                                </div>
                                <input type="text" id="description" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Type:</span>
                                </div>
                                <select class="custom-select" id="category" name="category">
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text">Category:</span>
                                </div>
                                <select class="custom-select" id="category" name="category">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
