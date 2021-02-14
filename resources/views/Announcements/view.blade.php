{{-- MarketSoft.io --}}
{{-- Copyright (c) 2021 MarketSoft.io <support@marketSoft.io> --}}
@extends('Vendor.main')

@section('title')
Announcements
@endsection

@section('header-title')
{{ $announcement->name }}
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Announcements</li>
    <li class="breadcrumb-item">#{{ $announcement->id }}</li>
</ol>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div class="text-center mb-5" style="font-size: 24px; color: #fff;">
            {!! $announcement->description !!}
        </div>
        <div class="pull-left" style="color: #ccc;">Created On: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->format('m/d/Y') }}</div>
        <div class="pull-right" style="color: #ccc;">Total Views: {{ $announcement->views }}</div>
    </div>
</div>
@endsection