{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
{{ $product->name }}
@endsection

@section('header-title')
{{ $product->name }}
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active"><a>{{ $product->name }}</a></li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-7">
            <div class="row product-gallery mx-1">
                <div class="col-12 mb-0">
                    <div class="bootstrap-carousel">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://cdn.discordapp.com/attachments/692058346626351205/734503900198994111/IMG-1.png" alt="First slide">
                                </div>
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="https://cdn.discordapp.com/attachments/692058346626351205/734503901193044028/img-2.png" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://cdn.discordapp.com/attachments/692058346626351205/734503904670122095/IMG-4.png" alt="Third slide">
                                </div>
                            </div><a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <h1>{{ $product->name }}</h1>
            <h4 class="mb-0 mt-3">${{ $product->price }}</h4>
            <br>
            {!! $product->description !!}
            <button class="mt-4 btn btn-primary btn-block">Add to shoppingcart</button>

            <div class="mt-5 accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How to use
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection