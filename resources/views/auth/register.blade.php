{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Register
@endsection

@section('header-title')
User Register
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Register</li>
</ol>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-6">
        <form method="POST" action="{{ route('auth.register.new') }}">
        {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="password1">Confirm Password:</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button style="cursor:pointer; float: right;" type="submit" class="btn btn-primary w-25">Submit</button>
            </div>
        </form>
    </div>
    <div class="col-6">
        <div class="vertical"></div>
        <h5>Comming soon...</h5>
        <a class="btn market-login-btn" style="text-transform:none">
            <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="/images/login/google.png" />
            Register with Google
        </a>
        <br>
        <a class="btn market-login-btn" style="text-transform:none">
            <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="/images/login/github.png" />
            Register with Github
        </a>
        <br>
        <a class="btn market-login-btn" style="text-transform:none">
            <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="/images/login/discord.png" />
            Register with Discord
        </a>
    </div>
</div>
@endsection