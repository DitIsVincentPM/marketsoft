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
        <li class="breadcrumb-item active"><a href="{{ route('products.view', $product->id) }}">{{ $product->name }}</a></li>
    </ol>
@endsection

@section('content')
    <div class="primary-section">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5">
                <div class="splide" id="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($product->Images as $image)
                                <li class="splide__slide">
                                    <img style="width: 50%;" src="/images/products/{{ $image->image_url }}" alt="Profile">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="secondary-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($product->Images as $image)
                                <li class="splide__slide">
                                    <img style="width: 50%;" src="/images/products/{{ $image->image_url }}" alt="Profile">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <h1 class="mt-sm-5 text-uppercase">Iphone lol</h1>
                <h4 class="text-secondary" style="color: #91959d !important;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio,</h4>
                <div class="row mt-2">
                    <div class="col-3">
                        <h1>${{ $product->price }}</h1>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-light">PURCHASE</button>
                    </div>
                    <div class="col-5">
                        <form method="POST" action="{{ route('products.view.add', $product->id) }}">@csrf
                            <button class="mt-4 btn btn-primary btn-block">Add to shoppingcart</button>
                        </form>
                    </div>
                </div>
                <div data-name="SECTIONS" class="mt-3">
                    @foreach ($product->Sections as $section)
                        @if ($section->type == 1)
                            <div class="mt-3">
                                <h3><strong>{{ $section->name }}</strong></h3>
                                <p>{{ $section->content }}</p>
                            </div>
                        @elseif($section->type == 2)
                            <div class="mt-3">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id-{{ $section->id }}" aria-expanded="false" aria-controls="id-{{ $section->id }}">
                                                {{ $section->name }}
                                            </button>
                                        </h2>
                                        <div id="id-{{ $section->id }}" class="accordion-collapse collapsed" data-bs-parent="#id-{{ $section->id }}">
                                            <div class="accordion-body">
                                                {{ $section->content }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .splide__slide {
            text-align: center;
        }

        .splide--nav>.splide__track>.splide__list>.splide__slide.is-active {
            border-color: #0683ff !important;
            margin-top: 1rem;
        }

        .splide--nav>.splide__track>.splide__list>.splide__slide {
            margin-top: 1rem;
        }

        .splide__arrow svg {
            fill: #0683ff !important;
        }

        .splide__pagination__page.is-active {
            background: #0683ff !important
        }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var secondarySlider = new Splide('#secondary-slider', {
                fixedWidth: 100,
                fixedHeight: '7em',
                gap: 20,
                cover: true,
                isNavigation: true,
                focus: 'center',
            }).mount();
            var primarySlider = new Splide('#splide', {
                perPage: 1,
                autoplay: true,
                interval: 15000, // How long to display each slide
                type: 'fade',
                heightRatio: 0.5,
                pagination: false,
                arrows: false,
                cover: true,
            }).mount();
            primarySlider.sync(secondarySlider).mount();
        });

    </script>
    <script src="/js/API/shoppingcart.js"></script>
@endsection
