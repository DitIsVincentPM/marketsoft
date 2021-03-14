{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
Register
@endsection

@section('header-title')
User Register
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Register</li>
</ol>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-12">
        <form method="POST" action="{{ route('auth.register.new') }}">
        @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
            </div>
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
                <button type="submit" class="btn btn-primary w-25 pull-right">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection