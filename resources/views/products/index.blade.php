{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.main')

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
<div class="primary-section">
    <div class="row">
        <div class="col-2">
            <h5 class="bold categorys-border-bottom text-center pb-2">Categories</h5>
            @if(count($categorys) == 0)
                <p class="text-center">No Categories Created @if(Auth::user()->is_admin)<a class="text-center" href="{{ route('admin.index') }}">Create a Category </a>@endif</p>
            @else
                <nav class="nav flex-column">
                    <a style="padding-bottom: 0px !important;" class="black text-center nav-link active" aria-current="page" href="#">All Products</a>
                    @foreach($categorys as $category)
                    <a style="padding-bottom: 0px !important;" class="black text-center nav-link" aria-current="page" href="#">{{$category->name }}</a>
                    @endforeach
                </nav>
            @endif
        </div>
        <div class="col-10">
            <div class="row">
                @foreach($products as $product)
                @php
                if (strlen($product->shortdescription) >= 65) {
                $x = substr($product->shortdescription, 0, 65). " ... ";
                }
                else {
                $x = $product->shortdescription;
                }
                @endphp
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img style='height: 100%; width: 100%; object-fit: contain' src="{{ $product->logo }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}<small><span class="rounded-pill badge btn-primary btn-sm ml-2 pull-right">NEW</span></small></h5>
                            <p class="card-text">{{ $x }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('products.view', $product->id) }}" class="btn btn-primary rounded-pill">View Product</a>
                            <a href="#" class="btn btn-warning rounded-pill pull-right "><i style="width: 16px;" data-feather="shopping-cart" class="mr-1"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection