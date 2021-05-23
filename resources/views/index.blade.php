{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Home
@endsection

@section('home')
    <div class="content-header p-5">
        <div class="container">
            <h1 class="text-left">Welcome to MarketSoft!<br><span><small>Find the best products for the cheapest
                        pricing.</small></span></h1><br>
            <button class="btn btn-outline-primary btn-outline-default">Overview</button>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="text-center text-muted text-uppercase text-bold pt-4">OUR LATEST PRODUCTS</h3>
    <div class="d-flex justify-content-center mt-3">
        <div class="col-xl-10 col-md-12 row">
            @forelse($products as $product)
                <div class="col-md-4 mb-5">
                    <div class="card">
                        @if ($product->logo != null)
                            <img class="rounded-lg card-img-top" src="{{ $product->logo }}" alt="Card image cap">
                        @endif
                        <div class="card-body p-3" style="margin-bottom: -1.5rem;">
                            <h1 class="text-bold text-uppercase text-center mb-3" style="font-size: 20px;">
                                {{ $product->name }}
                                @if ($product->logo == null)
                                    <span class="title-product"></span>
                                @endif
                            </h1>
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
@endsection
