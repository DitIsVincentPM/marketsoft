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
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Announcements</li>
        <li class="breadcrumb-item">#{{ $announcement->id }}</li>
    </ol>
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-center" style="font-size: 24px;">
                        {!! $announcement->description !!}
                    </p>
                </div>
                <div class="card-footer">
                    <div class="pull-right">Total Views: {{ $announcement->views }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
