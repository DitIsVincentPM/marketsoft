{{-- MarketSoft --}}
{{-- Copyright (c) 2021 MarketSoft <support@MarketSoft.io> --}}
@extends('assets.main')

@section('title')
Knowledgebase
@endsection

@section('header-title')
Knowledgebase
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Info</a></li>
    <li class="breadcrumb-item active" aria-current="page">Knowledgebase</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        @if(count($knowledgebases) == 0)
            <div class="col-12">
                <div class="alert alert-primary text-center" role="alert">
                    There are currently zero knowledgebase articles to display
                    @if(Auth::user()->is_admin)
                        <a class="ml-1" href="{{-- route('admin.knowledgebase') --}}">(Get Started)</a>
                    @endif
                </div>
            </div>
        @else
            @foreach($knowledgebases as $knowledgebase)
            @php
                if (strlen($knowledgebase->description) >= 160) {
                $description_sized = substr($knowledgebase->description, 0, 160). " ... ";
                }
                else {
                $description_sized = $knowledgebase->description;
                }
            @endphp
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-1">
                                <h5 class="text-center mb-0">#{{ $knowledgebase->id }}</h4>
                            </div>
                            <div class="col-10">
                                <h5 class="market-text-break mb-0">{{ $knowledgebase->name }}</h4>
                            </div>
                            <div class="col-1 pull-right">
                                <a href="{{ route('knowledgebase.view', $knowledgebase->id) }}" title="Read More"><i data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-0">{!! $description_sized !!}</p>
                    </div>
                    <div class="card-footer">
                        <h6 class="pull-left mb-0">Created On: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $knowledgebase->created_at)->format('m/d/Y') }}</h4>
                        <h6 class="pull-right mb-0">Views: {{ $knowledgebase->views }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection