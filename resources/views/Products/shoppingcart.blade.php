{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Home
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <div class="pt-4 wish-list">
                        <h5 class="mb-4">Cart (<span>{{ ShoppingCart::CountCart() }}</span> items)</h5>
                        @forelse(ShoppingCart::GetShoppingCart() as $item)
                        @foreach(Products::GetAll() as $product)
                        @if($item->product_id == $product->id)
                        <div class="card card-body row mb-4 col-md-offset-1">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                <div style="">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="pull-left"><span style="font-weight: bolder;">{{ $item->qty }}x <span style="font-weight: normal;">{{ $product->name }}</span></span> <span class="text-muted"><small>{{ $product->description }}</small></span></h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="" type="button" class="card-link-secondary small mr-3"><i class="fas fa-trash-alt mr-1"></i> Remove item </a>
                                        </div>
                                        <p class="mb-0"><span><strong id="summary">${{ $product->price * $item->qty }}</strong></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @empty 
                        @endif
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> NOTICE: {{ Settings::key('ProductNotice') }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4">
                        <h5 class="mb-4">We accept</h5>
                        <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" alt="Visa">
                        <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" alt="American Express">
                        <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" alt="Mastercard">
                        <img class="mr-2" width="45px" src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png" alt="PayPal acceptance mark">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <div class="pt-4 card card-body">
                        <h5 class="mb-3">The total amount of</h5>
                        <ul class="list-group list-group-flush">
                            @php
                            $total = 0;    
                            @endphp                                
                            @forelse(ShoppingCart::GetShoppingCart() as $item)
                            @foreach(Products::GetAll() as $product)
                            @if($item->product_id == $product->id)
                            @if($loop->first)    
                            <li style="border-width: 1px 0 0px !important;" class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span style="font-weight: bolder;">{{ $item->qty }}x <span style="font-weight: normal;">{{ $product->name }}</span></span>
                                <span>{{ $product->price }}</span>
                            </li>
                            @else                        
                            <li style="border-width: 1px 0 1px !important;" class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span style="font-weight: bolder;">{{ $item->qty }}x <span style="font-weight: normal;">{{ $product->name }}</span></span>
                                <span>{{ $product->price }}</span>
                            </li>
                            @endif
                            @php
                            $total += $product->price * $item->qty;
                            @endphp
                            @endif
                            @endforeach
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Total Amount
                                <span>    
                                    ${{ round($total, 2) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Tax
                                <span>    
                                    ${{ round($total / 100 * 21, 2) }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Shipping
                                <span>Free</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>The total amount of</strong>
                                </div>
                                <span><strong>${{ $total + round($total / 100 * 21, 2) }}</strong></span>
                            </li>
                        </ul>
                        @if(Auth::check())
                        <form action="{{ route('shoppingcart.checkout') }}"><button type="submit" class="btn btn-primary btn-block">Checkout</button></form>
                        @else 
                        <form action="{{ route('auth.login') }}"><button type="submit" class="btn btn-primary btn-block">Login</button></form>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4 card card-body">
                        <a class="btn btn-secondary d-flex justify-content-between" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add a discount code (optional)
                            <span><i class="fas fa-chevron-down pt-1"></i></span>
                        </a>

                        <div class="collapse" id="collapseExample">
                            <div class="mt-3">
                                <div class="md-form md-outline mb-0">
                                    <input type="text" id="discount-code" class="form-control font-weight-light" placeholder="Enter discount code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
