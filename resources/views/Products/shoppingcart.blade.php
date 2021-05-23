{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Home
@endsection

@section('header-title')
    Shoppingcart
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item">Shoppingcart</li>
    </ol>
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <div class="pt-4 wish-list">
                        <h5 class="mb-4">Cart (<span>{{ ShoppingCart::CountCart() }}</span> items)</h5>
                        @forelse(ShoppingCart::GetShoppingCart() as $item)
                            @foreach (Products::get() as $product)
                                @if ($item->product_id == $product->id)
                                    <div class="card card-body row mb-4 col-md-offset-1">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                            <div style="">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="pull-left"><span
                                                                style="font-weight: bolder;">{{ $item->qty }}x <span
                                                                    style="font-weight: normal;">{{ $product->name }}</span></span>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <form method="POST"
                                                            action="{{ route('products.view.remove', $product->id) }}">
                                                            @csrf
                                                            <button
                                                                class="btn pt-0 pb-0 btn-sm btn-default card-link-secondary small mr-3">Remove
                                                                item</button>
                                                        </form>
                                                    </div>
                                                    <p class="mb-0"><span><strong
                                                                id="summary">${{ $product->price * $item->qty }}</strong></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @empty
                            <div class="col-md-12">
                                <div class="text-center card">
                                    <div class="card-body">
                                        <img src="/themes/default/icons/nothing_found.svg" height="250" />
                                        <h4 class="text-bold text-muted mt-3">Oh, It seems like you don't have anything in here.</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Settings::key('ProductNotice') != null)
                            <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> NOTICE:
                                {{ Settings::key('ProductNotice') }}</p>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4">
                        <h5 class="mb-4">We accept</h5>
                        @foreach ($payment_gateaways as $payment_gateaway)
                            <img class="mr-2" width="45px" src="{{ $payment_gateaway->image }}"
                                alt="{{ $payment_gateaway->name }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3" style="margin-top: 4.50rem;">
                    <div class="pt-4 card card-body">
                        <h5 class="mb-3">The total amount of</h5>
                        <ul class="list-group list-group-flush">
                            @php
                                $total = 0;
                            @endphp
                            @forelse(ShoppingCart::GetShoppingCart() as $item)
                                @foreach (Products::get() as $product)
                                    @if ($item->product_id == $product->id)
                                        @if ($loop->first)
                                            <li style="border-width: 1px 0 0px !important;"
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span style="font-weight: bolder;">{{ $item->qty }}x <span
                                                        style="font-weight: normal;">{{ $product->name }}</span></span>
                                                <span>{{ $product->price }}</span>
                                            </li>
                                        @else
                                            <li style="border-width: 1px 0 1px !important;"
                                                class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span style="font-weight: bolder;">{{ $item->qty }}x <span
                                                        style="font-weight: normal;">{{ $product->name }}</span></span>
                                                <span>{{ $product->price }}</span>
                                            </li>
                                        @endif
                                        @php
                                            $total += $product->price * $item->qty;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Total Amount
                                <span>
                                    ${{ round($total, 2) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Tax
                                <span>
                                    ${{ round(($total / 100) * 21, 2) }}
                                </span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>The total amount of</strong>
                                </div>
                                <span><strong>${{ $total + round(($total / 100) * 21, 2) }}</strong></span>
                            </li>
                        </ul>
                        @if (Auth::check())
                            <form action="{{ route('shoppingcart.checkout') }}"><button type="submit"
                                    class="btn btn-primary btn-block">Checkout</button></form>
                        @else
                            <form action="{{ route('auth.login') }}"><button type="submit"
                                    class="btn btn-primary btn-block">Login</button></form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
