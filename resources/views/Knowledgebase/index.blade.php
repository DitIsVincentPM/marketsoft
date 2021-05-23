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
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Knowledgebase</li>
    </ol>
@endsection

@section('content')
    <h2 class="mb-4 text-center">Categories</h2>
    <div class="row d-flex justify-content-center">
        @foreach ($categories as $category)
            <div class="col-4 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <a class="article-title" href="{{ route('knowledgebase.category', $category->id) }}">
                                    <h4 class="article-title">
                                        {{ Str::limit($category->name, 50) }} <small
                                            class="text-muted">({{ count($category->Articles) }}
                                            @choice('article|articles',count($category->Articles)))</small>
                                    </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h2 class="mb-4 mt-4 text-center">Most Viewed Aricles</h2>
    @foreach ($articles as $article)
        <div class="card shadow mb-3"  onClick="location='{{ route('knowledgebase.article.view', $article->id) }}'">
            <div class="card-body">
                <div class="row">
                    <div class="col-11" style="width: 95%;">
                        <h5 class="market-text-break announcement-title">{{ $article->name }}</h5>
                    </div>
                    <div class="col-1" style="width: 5%;">
                            <i data-feather="eye"></i> 
                            <span class="pt-2">{{ $article->views }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
