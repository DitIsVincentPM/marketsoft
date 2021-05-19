{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

    @extends('Vendor.main')

    @section('title')
        Home
    @endsection
    
    @section('home')
        <div class="content-header" style="background-color: rgba(89, 89, 89, 0.6) !important;color: white;padding-top: 80px;padding-bottom: 80px;">
            <h1 class="text-center">Welcome to MarketSoft!<br><span><small>Searching for Example #1, Example #2, Example #3. Search for it in the bar below.</small></span></h1><br>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Type your product name here">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
    @section('content')
        <div class="primary-section row">
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 mobile-text-center">
                <p class="text-left" style="top: -50%; transform: translateY(50%);">
                <h1><strong>WHAT IS <span class="text-uppercase nav-market">Market</span><span class="text-uppercase nav-soft">Soft</span></strong></h1>
                <div class="col-xl-10 col-lg-10 col-mb-10 col-sm-12">
                    <span>
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
                <img src="/themes/default/icons/frontpage.svg" class="img-fluid" alt="...">
            </div>
        </div>
    @endsection
    