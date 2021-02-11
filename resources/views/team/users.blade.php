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
    <div class="row team-users-row justify-content-center">
        @foreach($users as $user)
        <div class="col-3">
            <div class="card mb-3">
                <div class="card-body">
                    <img class="team-users-profile profile-picture-users mb-2" src="{{ $user->profile_picture }}">
                    <h5 class="team-users-name text-center" data-toggle="tooltip" data-placement="bottom" @if($user->is_admin == 1) title="Administrator" @elseif($user->is_seller == 1) title="Seller" @else title="Member" @endif>
                    @if($user->is_admin == 1) 
                        <i style="width: 18px;" data-feather="tool"></i> {{ $user->name }}
                    @elseif($user->is_seller == 1)
                        <i style="width: 18px;" data-feather="shopping-bag"></i> {{ $user->name }}
                    @else
                        <i style="width: 18px;" data-feather="user"></i> {{ $user->name }}
                    @endif
                    </h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection