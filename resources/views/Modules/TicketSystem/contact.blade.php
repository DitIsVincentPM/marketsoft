{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
Contact
@endsection

@section('header-title')
Contact Us
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="{{ route('auth.seller.new') }}">
            @csrf
                <div class="form-group">
                    <label class="market-form-label form-label">Ticket Title:</label>
                    <input placeholder="I purchased an item, but haven't recieved it" type="text" name="name" class="market-form-input form-control">
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">Email Address:</label>
                    <input placeholder="johndoe123@gmail.com" type="email" name="company" class="market-form-input form-control">
                    <div class="form-text">Use the Email Address attached to your account.</div>
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">Description</label>
                    <textarea placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="market-form-input form-control" name="selling"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection