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
<li class="nav-item">
    <a href="{{ route('clientarea.tickets') }}" class="nav-link text-white">Tickets</a>
</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="text-left float-left">Invoice #{{ $invoice->id }}</h4>
            @if($invoice->status == 0)
            <h4 class="text-right text-warning">Payment Pending</h4>
            @elseif($invoice->status == 1)
            <h4 class="text-right text-danger">Overdue</h4>
            @elseif($invoice->status == 2)
            <h4 class="text-right text-success">Payment Completed</h4>
            @elseif($invoice->status == 3)
            <h4 class="text-right text-default">Refunded</h4>
            @elseif($invoice->status == 4)
            <h4 class="text-right text-danger">Payment Failed</h4>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td><strong>Item</strong></td>
                            <td class="text-center"><strong>Quantity</strong></td>
                            <td class="text-center"><strong>Price</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($products['items']); $i++)
                            <tr>
                                <td>{{ $products['items'][$i]['name'] }}</td>
                                <td class="text-center">{{ $products['items'][$i]['qty'] }}</td>
                                <td class="text-center">${{ $products['items'][$i]['price'] * $products['items'][$i]['qty']}}</td>
                            </tr>
                        @endfor
                        <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                        </tr>
                        <tr>
                            <td class="no-line"></td>
                            <td class="no-line text-center"><strong>Total</strong></td>
                            <td class="no-line text-center">${{ $products['total'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
