{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Home
@endsection

@section('header-title')
    WELCOME TO <span class="nav-market">Market</span><span class="nav-soft">Soft</span><br>
    <p class="header-home-text">Our revolutionary platform will<br>help you find the best products.</p>
    <button
        style="width: 200px; border: 0; background: linear-gradient(149deg, #0683ff 0%, #0d44ff 100%) !important; box-shadow: -1px 0px 22px -10px rgba(0,0,0,0.2);"
        class="btn btn-sm btn-primary">VIEW PRODUCTS</button>
@endsection

@section('content')
    <div class="primary-section row">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 mobile-text-center">
            <p class="text-left" style="top: -50%; transform: translateY(50%);">
            <h1><strong>WHAT IS <span class="text-uppercase nav-market">Market</span><span
                        class="text-uppercase nav-soft">Soft</span></strong></h1>
            <div class="col-xl-10 col-lg-10 col-mb-10 col-sm-12">
                <span style="color: white;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros,
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus.
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex,
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo.
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc.
                </span>
            </div>
            <a href="#" style="color: #1f8bfd; font-size: 15px; text-decoration: none;" class="text-uppercase">FIND OUT
                MORE</a>
            </p>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mobile-remove">
            <img src="/icons/frontpage.svg" class="img-fluid" alt="...">
        </div>
    </div>
@endsection
