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
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header br-0">
                Price Range
            </div>
            <div class="card-body">
                <input type="range" class="form-range" min="0" max="500" step="0.5" id="customRange3">
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header br-0">
                Category's
            </div>
            <div class="card-body">
                @foreach($categorys as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="btn-block input-group mb-3">
            <input type="search" id="form1" placeholder="Search..." class="market-form-input form-control" />
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-12">
                    <div class="card br-0">
                        <div class="row">
                            <div class="products-logo col-2 justify-content-center text-center">
                                <img src="{{ $product->logo }}" width="100%" height="80px">
                                <p class="pt-1">
                                    (5)
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                </p>
                            </div>
                            <div class="col-10 products-description">
                                <a href="" class="product-name"><h4 class="product-name">{{ $product->name }}</h4></a>
                                <h5 class="market-text-break">{{ $product->description }}</h5>
                                <div class="row">
                                    <div class="col-4 text-left">
                                        Purchases: {{ $product->purchases }}
                                    </div>
                                    <div class="col-4 text-center">
                                        Downloads: {{ $product->downloads }}
                                    </div>
                                    <div class="col-4 text-right">
                                        Views: {{ $product->views }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
$('.owl-carousel').owlCarousel({
    margin:10,
    nav:true,
    items:3,
})
</script>
@endsection