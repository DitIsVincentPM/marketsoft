{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
Login
@endsection

@section('header-title')
User Login
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Login</li>
</ol>
@endsection

@section('content')
<div class="row mt-5 justify-content-center">
    <div class="col-8">
        <h1 class="login-title text-center">Login with Email Address</h1>
        <form method="POST" action="{{ route('auth.login.new') }}">
            <div class="form-group">
                <label for="email" class="pb-2">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password" class="pb-2">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            {!! csrf_field() !!}
            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
        @if(Settings::key('GoogleStatus') != 0 or Settings::key('DiscordStatus') != 0 or Settings::key('GithubStatus') != 0)
            <div class="title-heading">
                <span>Or Login With...</span>
            </div>
        @endif
        <div class="row justify-content-center">
            @if(Settings::key('DiscordStatus') == 1)
                <div class="col-4">
                    <a href="{{ route('discord.redirect') }}">
                        <button class="btn btn-discord justify-content-center w-100">
                            <i class="fab fa-discord" style="margin-right: 5px!important;"></i> Discord
                        </button>
                    </a>
                </div>
            @endif
            @if(Settings::key('GoogleStatus') == 1)
                <div class="col-4">
                    <a href="{{ route('google.redirect') }}">
                        <button class="btn btn-google justify-content-center w-100">
                            <i class="fab fa-google" style="margin-right: 5px!important;"></i> Google
                        </button>
                    </a>
                </div>
            @endif
            @if(Settings::key('GithubStatus') == 1)
                <div class="col-4">
                    <a href="{{ route('github.redirect') }}">
                        <button class="btn btn-github justify-content-center w-100">
                            <i class="fab fa-github" style="margin-right: 5px!important;"></i> GitHub
                        </button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection