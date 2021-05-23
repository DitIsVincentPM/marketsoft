{{-- MarketSoft.io --}}
{{-- Copyright (c) 2021 MarketSoft.io <support@marketSoft.io> --}}
@extends('Vendor.main')

@section('title')
Knowledgebase
@endsection

@section('header-title')
<div class="container mb-3">
    {{ $knowledgebase->name }}
</div>
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Knowledgebase</li>
    <li class="breadcrumb-item">#{{ $knowledgebase->id }}</li>
</ol>
@endsection

@section('content')
<div class="row mt-5 mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body br-0">
                <div class="text-center" style="font-size: 24px;">
                    {!! $knowledgebase->description !!}
                </div>
            </div>
            <div class="card-footer br-0">
                <div class="pull-right">Total Views: {{ $knowledgebase->views }}</div>
            </div>
        </div>
    </div>
</div>
@endsection