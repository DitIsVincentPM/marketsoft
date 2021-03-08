{{-- MarketSoft --}}
{{-- Copyright (c) 2021 MarketSoft <support@MarketSoft.io> --}}
@extends('Vendor.main')

@section('title')
Knowledgebase
@endsection

@section('header-title')
Knowledgebase
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Knowledgebase</li>
</ol>
<div class="row mt-4">
    <div class="col-12">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input type="search" placeholder="Search..." id="search" class="input-search admin-search-input form-control" style="width: 700px!important;">
            </div>
            <button type="button" class="btn btn-light">
                <i style="width: 16px;" data-feather="search" class="mr-1"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-6">
            <h2>Featured Articles:</h2>
            @foreach($featured_articles as $featured_article)
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="color: #ccc!important;">
                                            <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="bookmark"></i>
                                            {{ Shorten::string($featured_article->name, 50) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-6">
            <h2>Article Categories</h2>
        </div>
    </div>
</div>
@endsection