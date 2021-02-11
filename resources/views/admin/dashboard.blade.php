{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.admin')

@section('title')
Admin
@endsection

@section('header-title')
Dashboard
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Area Chart</h4>
            <div id="extra-area-chart" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
        </div>
    </div>
</div>
<script>
     Morris.Area({
        element: 'extra-area-chart',
        data: [{
            month: '2021 01',
            users: 1,
            windows: 0,
            mac: 0
        }],
        lineColors: ['#6ed3cf', '#173e43', '#9068be'],
        xkey: 'month',
        ykeys: ['users', 'windows', 'mac'],
        labels: ['Phone', 'Windows', 'Mac'],
        pointSize: 0,
        lineWidth: 0,
        resize: true,
        fillOpacity: 0.8,
        behaveLikeLine: true,
        gridLineColor: 'transparent',
        hideHover: 'auto'

    });
</script>
@endsection