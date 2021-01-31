{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.main')

@section('title')
Announcements
@endsection

@section('header-title')
Announcements
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Info</a></li>
    <li class="breadcrumb-item active" aria-current="page">Announcements</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-12">
            @if(count($announcements) == 0)
                <div class="alert alert-primary text-center" role="alert">
                    There are currently zero announcements to display. 
                    @if(Auth::user()->is_admin)
                        <a href="{{-- route('admin.announcements') --}}">Get Started</a>
                    @endif
                </div>
            @else
                @foreach($announcements as $announcement)
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h5 class="market-text-break announcement-title">{{ $announcement->name }}</h5>
                            </div>
                            <div class="col-5">
                                <p class="market-text-break announcement-description">{{ $announcement->description }}</p>
                            </div>
                            <div class="col-2">
                                <p class="market-text-break announcement-date">2 Years Ago</p>
                            </div>
                            <div class="col-1 text-center">
                                <a href="" title="Read More"><i data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection