{{-- MarketSoft.io --}}
{{-- Copyright (c) 2021 MarketSoft.io <support@marketSoft.io> --}}
@extends('assets.main')

@section('title')
Announcements
@endsection

@section('header-title')
Announcements & Updates
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Announcements</li>
    <li class="breadcrumb-item">{{ $announcement->id }}</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="pull-left mt-1">{{ $announcement->name }}</h4>
                    <h5 class="pull-right mt-1">Views: 12</h4>
                </div>
                <div class="card-body text-center">
                    {{ $announcement->description }}
                </div>
                <div class="card-footer">
                    Created At: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->format('Y-m-d') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection