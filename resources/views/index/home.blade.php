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
<span style="margin-top: -4%; width: 110% !important; height: 15% !important; background-color: white; position:absolute;" class="rotate-text-header"></span>
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
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Accordion Item #1
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Accordion Item #2
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Accordion Item #3
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        </div>
      </div>
    </div>
  </div>
</div>

<br>
<br>

<div class="container">
  <div class="row">
    @foreach($products as $product)
    @php
        if (strlen($product->description) >= 80) {
        $description_sized = substr($product->description, 0, 80). " ... ";
        }
        else {
        $description_sized = $product->description;
        }
    @endphp
    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
      <div class="card shadow">
        <div class="card-header">
          <div class="row">
            <div class="col-9 pull-left" style="text-align: left;">
              <h5 class="mb-0 mt-1 market-text-break">{{ $product->name }}</h5>
            </div>
            <div class="col-3 pull-right" style="text-align: right;">
              <span class="badge rounded-pill bg-secondary" style="font-size:13px;">${{ $product->price }}</span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <p>{{ $description_sized }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection