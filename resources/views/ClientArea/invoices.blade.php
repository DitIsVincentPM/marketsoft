{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
    Invoices
@endsection

@section('header-title')
    Invoices
@endsection

@section('header-breadcrumb')
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientarea.index') }}">Client Area</a></li>
        <li class="breadcrumb-item"><a href="#">Invoices</a></li>
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
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Paypal Id</th>
                            <th style="width: 40px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}.</td>
                                <td>{{ $invoice->paypal_id }}</td>
                                <td><span class="badge bg-primary">View</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
