{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.main')

@section('title')
{{ $product->name }}
@endsection

@section('header-title')
{{ $product->name }}
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('index.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active"><a>{{ $product->name }}</a></li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-9">
            <div class="border-left-primary card">
                <div class="card-body">
                    {{ $product->description }}
                </div>
            </div>
            <div class="border-left-primary accordion mt-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button">
                            Specifications
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img src="{{ $product->logo }}" class="rounded float-end" alt="...">
                <div class="card-header">
                    {{ $product->name }}
                </div>
                <table class="admin-table-footer table">
                    <tbody>
                        <tr>
                            <td><strong><span>Price:</span></strong></td>
                            <td><span class="rounded-pill badge btn-primary btn-sm pull-right">${{ $product->price }}</span></td>
                        </tr>
                        <tr>
                            <td><strong><span>Views:</span></strong></td>
                            <td><span class="rounded-pill badge btn-primary btn-sm pull-right">{{ $product->views }}</span></td>
                        </tr>
                        <tr>
                            <td><strong><span>Purchases:</span></strong></td>
                            <td><span class="rounded-pill badge btn-primary btn-sm pull-right">{{ $product->purchases }}</span></td>
                        </tr>
                        <tr>
                            <td><strong><span>Category:</span></strong></td>
                            <td><span class="rounded-pill badge btn-primary btn-sm pull-right">{{ $product->category }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection