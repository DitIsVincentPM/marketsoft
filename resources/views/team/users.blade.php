{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.main')

@section('title')
Users
@endsection

@section('header-title')
Browse Members
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Team</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row team-users-row">
        @foreach($users as $user)
        <div class="col-3">
            <div class="card mb-3">
                <div class="card-body">
                    <img class="team-users-profile profile-picture-users" src="{{ $user->profile_picture }}">
                    <h5 class="team-users-name text-center">{{ $user->name }}</h5>
                    <h6 class="team-users-role text-center"><i style="width: 16px;" data-feather="user"></i>
                    @if($user->is_admin == 1) 
                        Admin
                    @elseif($user->is_seller == 1)
                        Seller
                    @else 
                        Member 
                    @endif
                    </h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection