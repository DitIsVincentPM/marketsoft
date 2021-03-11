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
<div class="row mt-5">
    <div class="col-12">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input type="search" placeholder="Search..." id="search" class="input-search admin-search-input form-control" style="width: 700px!important;border-top-left-radius: 4px!important; border-bottom-left-radius: 4px!important;">
            </div>
            <button type="button" class="btn btn-search">
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
            <h2 class="mb-4">Featured Articles:</h2>
            @foreach($featured_articles as $featured_article)
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a class="article-title" href="{{ route('knowledgebase.article.view', $featured_article->id) }}">
                                            <h4 class="article-title mb-3">
                                                <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="bookmark"></i>
                                                {{ Shorten::string($featured_article->name, 50) }}
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            Published on {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $featured_article->created_at)->format('m/d/Y') }}
                                        </h5>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            @foreach($categories as $category)
                                                @if($featured_article->category_id == $category->id)
                                                    Posted in <a class="article-category" href="">{{ $category->name }}</a>
                                                @endif
                                            @endforeach
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-6">
            <h2 class="mb-4">Article Categories:</h2>
            @foreach($categories as $category)
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a class="article-title" href="{{route('knowledgebase.category', $category->id) }}">
                                            <h4 class="article-title mb-3">
                                                <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="book"></i>
                                                {{ Shorten::string($category->name, 50) }}
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            Created on {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('m/d/Y') }}
                                        </h5>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            {{ count($category->Articles) }} @choice('article|articles', count($category->Articles))
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection