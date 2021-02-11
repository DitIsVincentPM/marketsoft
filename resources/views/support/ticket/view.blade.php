{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Ticket
@endsection

@section('header-title')
Ticket #{{ $tickets->id }}
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active" aria-current="page">#{{ $tickets->id }}</li>
</ol>
@endsection

@section('content')
<div class="container">
    <div class="primary-section">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">Ticket Information</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">Ticket ID: {{ $tickets->id }}</h5>
                        <h5 class="mb-3">
                            Category: 
                            @foreach($categories as $category)
                                @if($category->id == $tickets->category)
                                    {{ $category->name }}
                                @endif
                            @endforeach
                        </h5>
                        <h5 class="mb-3">Created On: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y') }}</h5>
                        <h5 class="mb-3">
                            Priority: 
                            @if($tickets->priority == 0)
                                Low Priority
                            @elseif($tickets->priority == 1)
                                Medium Priority
                            @elseif($tickets->priority == 2)
                                High Priority
                            @endif
                        </h5>
                        <h5 class="mb-0">
                            Status: 
                            @if($tickets->status == 0)
                                <span class="text-warning">Waiting Reply</span>
                            @elseif($tickets->status == 1)
                                <span class="text-info">Replied</span>
                            @elseif($tickets->status == 2)
                                <span class="text-success">Complete</span>
                            @elseif($tickets->status == 3)
                                <span class="text-danger">Closed</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                @if($tickets->status == 3)
                @else
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="pull-left mt-1">
                                Reply to the Ticket
                            </div>
                        <form method="POST" action="{{ route('support.ticket.new.reply', $tickets->id) }}">
                        @csrf
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Add Reply</button>
                            </div>
                        </div>
                        <div class="card-body" style="1.00rem">
                            <textarea style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="form-control ticket-reply-textbox" name="message"></textarea>
                        </div>
                        </form>
                    </div>
                @endif
                @php
                    $x = count($ticket_replies) +2;
                @endphp
                @foreach($ticket_replies as $ticket_reply)
                @php 
                    $x--
                @endphp
                    @foreach($users as $user)
                        @if($user->id == $ticket_reply->user_id)
                            @if($ticket_reply->is_whisper == 1)
                            @else
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-4">
                                                Reply: #{{ $x }}
                                            </div>
                                            <div class="col-4">
                                                Sent By: {{ $user->firstname }} {{ $user->lastname }}
                                            </div>
                                            <div class="col-4 text-right">
                                                Sent: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket_reply->created_at)->format('m/d/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <img class="center-image rounded-circle" width="55px" src="{{ $user->profile_picture }}">
                                                <p class="pt-1">
                                                    @if($user->is_admin == 1) 
                                                        <span class="text-danger"><i style="width: 15px;" data-feather="tool"></i> Admin</span>
                                                    @elseif($user->is_seller == 1)
                                                        <span class="text-warning"><i style="width: 15px;" data-feather="shopping-bag"></i> Seller</span>
                                                    @else
                                                        <span class="text-info"><i style="width: 15px;" data-feather="user"></i> Member</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-10">
                                                <p class="text-left" style="width: 87%;">{{ $ticket_reply->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif 
                    @endforeach
                @endforeach
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                Reply: #1
                            </div>
                            <div class="col-4">
                                Sent By: {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </div>
                            <div class="col-4 text-right">
                                Sent: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                <img class="center-image rounded-circle" width="55px" src="{{ Auth::user()->profile_picture }}">
                                <p class="pt-1">
                                @foreach($users as $user)
                                    @if($user->id == $tickets->user_id)
                                        @if($user->is_admin == 1) 
                                            <span class="text-danger"><i style="width: 15px;" data-feather="tool"></i> Admin</span>
                                        @elseif($user->is_seller == 1)
                                            <span class="text-warning"><i style="width: 15px;" data-feather="shopping-bag"></i> Seller</span>
                                        @else
                                            <span class="text-info"><i style="width: 15px;" data-feather="user"></i> Member</span>
                                        @endif
                                    @endif 
                                @endforeach
                                </p>
                            </div>
                            <div class="col-10">
                                <a href="#" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="">{{ $tickets->message }}</a></td>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection