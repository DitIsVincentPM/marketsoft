{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
Tickets
@endsection

@section('header-title')
Support Tickets
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Support Tickets</li>
</ol>
@endsection

@section('content')
    @if(count($tickets) == 0)
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="pull-left mb-0 mt-1">Your Tickets</h4>
                        <a href="{{ route('ticket.new') }}"><button class="pull-right btn btn-secondary btn-sm">Create New</button></a>
                    </div>
                    <div class="col-md-12 col-md-offset-2">
                        <div class="alert alert-primary text-center mt-3" role="alert">
                            You have 0 tickets attached to your account.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="pull-left mb-0 mt-1">Your Tickets</h4>
                        <a href="{{ route('ticket.new') }}"><button class="pull-right btn btn-secondary btn-sm">Create New</button></a>
                    </div>
                    <table class="table mb-0 text-center">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Message</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tickets as $ticket)
                            @php
                                if (strlen($ticket->message) >= 20) {
                                $message_sized = substr($ticket->message, 0, 20). " ... ";
                                }
                                else {
                                $message_sized = $ticket->message;
                                }
                            @endphp
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{!! $message_sized !!}</td>
                                <td>
                                    @if($ticket->priority == 0)
                                        Low Priority
                                    @elseif($ticket->priority == 1)
                                        Medium Priority
                                    @elseif($ticket->priority == 2)
                                        High Priority
                                    @endif
                                </td>
                                <td>
                                @foreach($categories as $category)
                                    @if($category->id == $ticket->category)
                                        {{ $category->name }}
                                    @endif
                                @endforeach
                                </td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('m/d/Y') }}</td>
                                @if($ticket->status == 0)
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
                                <td><a href="{{ route('ticket.view', $ticket->id) }}"><i data-feather="eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection