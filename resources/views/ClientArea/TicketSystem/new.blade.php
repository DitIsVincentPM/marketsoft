{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
New Ticket
@endsection

@section('header-title')
Submit a Ticket
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('clientarea.index') }}">Client Area</a></li>
    <li class="breadcrumb-item" aria-current="page">Submit a Ticket</li>
</ol>
@endsection

@section('smallbar')
<li class="nav-item">
    <a href="{{ route('clientarea.index') }}" class="nav-link text-white">Home</a>
</li>
<li class="nav-item">
    <a href="{{ route('clientarea.invoices') }}" class="nav-link text-white">Invoices</a>
</li>
<li class="nav-item">
    <a href="{{ route('clientarea.services') }}" class="nav-link text-white">Services</a>
</li>
<li class="nav-item">
    <a href="{{ route('clientarea.tickets') }}" class="nav-link text-white">Tickets</a>
</li>
@endsection

@section('content')
<div class="primary-section">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="{{ route('clientarea.ticket.new.create') }}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="market-form-label form-label">Name:</label>
                        <input placeholder="John Doe" type="text" name="name" class="market-form-input form-control" @if(Auth::check()) value="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}" @endif>
                        <div class="form-text">Use the Name attached to your account.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="market-form-label form-label">Email Address:</label>
                        <input placeholder="johndoe123@gmail.com" type="email" name="email" class="market-form-input form-control" @if(Auth::check()) value="{{ Auth::user()->email }}" @endif>
                        <div class="form-text">Use the Email Address attached to your account.</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Category:</label>
                <select class="form-control market-form-input" name="category" aria-label="Default select example">
                    @foreach($ticket_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Priority:</label>
                <select class="form-control market-form-input" name="priority" aria-label="Default select example">
                    <option value="2">High</option>
                    <option value="1">Medium</option>
                    <option value="0" selected>Low</option>
                </select>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Message:</label>
                <textarea placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="market-form-input form-control" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="float: right;">Submit Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
