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
<li class="nav-item">
    <a href="{{ route('clientarea.tickets') }}" class="nav-link text-white">Tickets</a>
</li>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="height: 150px;">
                    <div class="icon-card icon-card-primary">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h1 style="font-size: 55px; position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);">{{ $total['tickets'] }} <span  class="text-muted text-uppercase" style="font-size: 25px;">@choice('Ticket|Tickets', $total['tickets'])</span></h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="height: 150px;">
                    <div class="icon-card icon-card-warning">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h1 style="font-size: 55px; position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);">{{ $total['invoices'] }} <span  class="text-muted text-uppercase" style="font-size: 25px;">@choice('Invoice|Invoices', $total['invoices'])</span></h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="height: 150px;">
                    <div class="icon-card icon-card-danger">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h1 style="font-size: 55px; position: absolute;top: 50%;left:50%;transform: translate(-50%, -50%);">{{ $total['products'] }} <span  class="text-muted text-uppercase" style="font-size: 25px;">@choice('Product|Products', $total['products'])</span></h1>
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
                                @if ($ticket->status == 0)
                                    <td class="text-warning">
                                        Waiting Reply
                                    </td>
                                @elseif($ticket->status == 1)
                                    <td class="text-info">
                                        Replied
                                    </td>
                                @elseif($ticket->status == 2)
                                    <td class="text-success">
                                        Complete
                                    </td>
                                @elseif($ticket->status == 3)
                                    <td class="text-danger">
                                        Closed
                                    </td>
                                @endif
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
                                @if ($product->status == 0)
                                    <td class="text-success">Active</td>
                                @elseif($product->status == 1)
                                    <td class="text-warning">Suspended</td>
                                @elseif($product->status == 2)
                                    <td class="text-default">Inactive</td>
                                @endif
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
