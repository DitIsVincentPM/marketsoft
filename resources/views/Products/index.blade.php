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
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
    </ol>
@endsection

@section('content')
    <div class="primary-section">
        <div class="row px-md-3">
            <div class="col-sm-12 col-md-12 col-lg-2">
                <div class="w-100 btn-group-vertical">
                    <h5 class="border-bottom pb-2 w-100">Categories</h5>
                    <a href="{{ route('products.index') }}" class="category-a">
                        All Items
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', $category->name) }}" class="category-a">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-10">
                <div class="row d-flex justify-content-center">
                    @forelse($products as $product)
                        <div class="col-md-4">
                            <div class="card">
                                @if ($product->logo != null)
                                    <img class="rounded-lg card-img-top" src="{{ $product->logo }}" alt="Card image cap">
                                @endif
                                <div class="card-body p-3" style="margin-bottom: -1.5rem;">
                                    <div>
                                        <h1 class="text-bold text-uppercase text-center pb-3" style="font-size: 20px;">
                                            {{ $product->name }}
                                            @if ($product->logo == null)
                                                <span class="title-product"></span>
                                            @endif
                                        </h1>
                                    </div>
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <h4 class="rotate-skew-9 ml-2">${{ $product->price }}</h4>
                                <div class="card-footer product-footer rotate-skew-9">
                                    <form method="POST" action="{{ route('products.view.add', $product->id) }}">
                                        @csrf
                                        <button class="btn btn-outline-primary product-button">Add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="text-center card">
                                <div class="card-body">
                                    <img src="/themes/default/icons/nothing_found.svg" height="250" />
                                    <h4 class="text-bold text-muted mt-3">There are no Products or Services found.</h4>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
