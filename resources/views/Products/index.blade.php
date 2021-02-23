{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
    Products
@endsection

@section('header-title')
    Products & Services
@endsection

@section('header-breadcrumb')
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
    </ol>
@endsection

@section('content')
    <div class="primary-section">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <label for="customRange1" class="form-label mb-0">Product Price Range:</label>
                    </div>
                    <div class="card-body">
                        <input type="range" class="form-range" min="10" max="100" id="customRange2">
                        <p class="mb-0 pull-left">Min: $10</p>
                        <p class="mb-0 pull-right">Max: $100</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <label for="customRange1" class="form-label mb-0">Product Categories:</label>
                    </div>
                    <div class="card-body">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>All Categories</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <label for="customRange1" class="form-label mb-0">Product Ratings:</label>
                    </div>
                    <div class="card-body">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>All Ratings</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row mb-4">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <div class="row justify-content-center">
                @forelse($products as $product)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{ $product->logo }}" width="100%" height="162px"
                                            style="border-radius: 2%!important;">
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <h4 class="mb-1">{{ Shorten::string($product->name, 18) }}</h4>
                                        </div>
                                        <div>
                                            <h3>${{ $product->price }}</h3>
                                        </div>
                                        <div>
                                            <p>{{ Shorten::string($product->description, 75) }}</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p>Views: {{ $product->views }}</p>
                                            </div>
                                            <div class="col-7">
                                                <p>Downloads: {{ $product->downloads }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-center mb-0 mt-4">Category: <span
                                                    style="font-weight: 700;">{{ $product->category }}</span></p>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('products.view', $product->id) }}"><button
                                                    class="btn btn-primary btn-sm w-100 mt-3">Order Now</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    NOTHING IS HERE NOOOOOOOOOOOO
                @endforelse
            </div>
        </div>
    </div>
    </div>
@endsection
