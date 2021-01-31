{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Seller
@endsection

@section('header-title')
Seller Registration
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Seller</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row justify-content-center">
        <div class="col-8">
            <form method="POST" action="{{ route('auth.seller.new') }}">
            @csrf
                <div class="form-group">
                    <label class="form-label">Full Name:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Company Name:</label>
                    <input type="text" name="company" class="form-control">
                    <div class="form-text">If you aren't a part of a company or brand, put your full name again.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address:</label>
                    <input type="email" name="email" class="form-control">
                    <div class="form-text">Use your company email address, or personal if you don't belong to a company.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Your Age:</label>
                    <input type="number" name="age" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">What do you plan on selling?</label>
                    <textarea class="form-control" name="selling"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Become a Seller</button>
            </form>
        </div>
    </div>
</div>
@endsection