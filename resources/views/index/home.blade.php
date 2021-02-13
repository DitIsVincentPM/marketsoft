{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Home
@endsection

@section('content')
<div class="header-home-height header-section background-gradient-primary">
  <div class="row">
    <div class="col-2">
    </div>
    <div class="col-3 center-content-home mt-20 col-max-mobile">
      <h1 class="color-white rotate-text-header">{{ $companyname }},</h1>
      <h3 class="color-white rotate-text-header">Our revolutionary platform will</h3>
      <h3 class="color-white rotate-text-header">help you find the best products</h3>
      <button style="border-radius: 50px;" class="rotate-text-header mt-3 btn btn-primary">View Products</button>
    </div>
    <div class="col-2">
    </div>
    <div class="col-4 col-remove-mobile">
      <img style="filter: drop-shadow( 0px 0px 10px rgba(0, 0, 0, .4));" class="rotate-text-header" width="500" src="/icons/frontpage.svg" alt="frontpage">
    </div>
    <div class="col-1">
    </div>
  </div>
</div>
<span class="cube-header-line"></span>
<div class="mt-5 container">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success:</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if ($message = Session::get('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error:</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if ($message = Session::get('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning:</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if ($message = Session::get('info'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Info:</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
  <h1 class="text-center">Announcements</h1>
  <hr class="mb-4">
  <div class="row justify-content-center">
    @foreach($announcements as $announcement)
    @if(count($announcements) == 1)
      <div class="col-12">
        <div class="card shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-9 pull-left market-text-break" style="text-align: left;">
                <a href="{{ route('announcements.view', $announcement->id) }}" class="home-announcement"><h4 class="mb-0 home-announcement">{{ $announcement->name }}</h4></a>
              </div>
              <div class="col-3 pull-right market-text-break" style="text-align: right;">
                <h4 class="mb-0">Views: {{ $announcement->views }}</h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12 market-text-break">
              {{ $announcement->description }}
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="col-6">
        <div class="card shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-9 pull-left market-text-break" style="text-align: left;">
              <a href="{{ route('announcements.view', $announcement->id) }}" class="home-announcement"><h4 class="mb-0 home-announcement">{{ $announcement->name }}</h4></a>
              </div>
              <div class="col-3 pull-right market-text-break" style="text-align: right;">
                <h4 class="mb-0">Views: {{ $announcement->views }}</h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12 market-text-break">
              {{ $announcement->description }}
            </div>
          </div>
        </div>
      </div>
    @endif
    @endforeach
  </div>
  <br>
  <br>
  <h1 class="text-center">Latest Products</h1>
  <!-- <p class="text-center">Here you can view the latest added products to our website</p> -->
  <hr class="mb-4">
  <div class="row justify-content-center">
    @foreach($products as $product)
    @php
        if (strlen($product->description) >= 125) {
        $description_sized = substr($product->description, 0, 125). " ... ";
        }
    @endphp
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
      <div class="card shadow">
        <div class="card-header">
          <div class="row">
            <div class="col-9 pull-left" style="text-align: left;">
              <a href="{{ route('products.view', $product->id) }}"><h4 class="mb-0 mt-1 market-text-break home-products">{{ $product->name }}</h4></a>
            </div>
            <div class="col-3 pull-right" style="text-align: right;">
              <span class="badge rounded-pill bg-secondary" style="font-size:13px;">${{ $product->price }}</span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <p>{{ $description_sized ?? $product->description }}</p>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-4" style="text-align: left;">
              <p class="mb-0">Views: {{ $product->views }}</p>
            </div>
            <div class="col-4" style="text-align: center;">
              <p class="mb-0">Purchases: {{ $product->purchases }}</p>
            </div>
            <div class="col-4" style="text-align: right;">
              <p class="mb-0">Downloads: {{ $product->downloads }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection