{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Client Area
@endsection

@section('header-title')
    Client Area
@endsection

@section('header-breadcrumb')
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Client Area</a></li>
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
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $announcement->name }}
                </div>
                <div class="pt-2 pb-2 card-body">
                    {{ Str::limit($announcement->description, 80) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Recent Tickets
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->status }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Recent Products
                </div>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->status }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
