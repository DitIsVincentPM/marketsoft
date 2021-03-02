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
@endsection

@section('content')
<div class="primary-section">
    @foreach($knowledgebases as $knowledgebase)
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-11" style="width: 95%;">
                    <h5 class="market-text-break announcement-title">{{ $knowledgebase->name }}<br><small>{!! $knowledgebase->description !!}</small></h5>
                </div>
                <div class="col-1" style="width: 5%;">
                    <a style="position: absolute;top: 50%;transform: translateY(-50%);" class="pull-right market-text-primary" href="{{ route('knowledgebase.articel.view', $knowledgebase->id) }}" title="Read More"><i class="pull-right" data-feather="eye"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection