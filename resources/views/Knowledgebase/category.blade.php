{{-- MarketSoft --}}
{{-- Copyright (c) 2021 MarketSoft <support@MarketSoft.io> --}}
@extends('Vendor.main')

@section('title')
Knowledgebase
@endsection

@section('header-title')
Knowledgebase - {{ $category->name }}
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Knowledgebase</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
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
</div>
@endsection