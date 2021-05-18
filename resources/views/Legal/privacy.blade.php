{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
Privacy Policy
@endsection

@section('header-title')
Privacy Policy
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Privacy Policy</a></li>
    </ol>
@endsection

@section('content')
    <div class="primary-section">
        @forelse($sections as $section)
            <div class="mb-4">
                <h1 class="text-center">{{ $section->title }}</h1>
                <p class="text-center">{{ $section->description }}</p>
            </div>
        @empty
            <div class="alert alert-primary text-center" role="alert">
                Oh no! It looks like there is no content here. Come back later.
            </div>
        @endforelse
    </div>
@endsection