{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
Tickets
@endsection

@section('header-title')
Tickets
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Ticket #{{ $tickets->id }}</a></li>
</ol>
@endsection

@section('content')
<div class="container">
    <div class="primary-section">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0 mt-1 pull-left">Ticket Information</h4>
                        @if($tickets->status == 3)
                        <form method="POST" action="{{ route('admin.tickets.delete', $tickets->id) }}">
                            @csrf
                            <button type="submit" class="pull-right btn btn-danger btn-sm">Delete</button>
                        </form>
                        <form method="POST" action="{{ route('admin.tickets.open', $tickets->id) }}">
                            @csrf
                            <button class="btn btn-success btn-sm pull-right" style="margin-right: 5px;">Open Ticket</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.tickets.close', $tickets->id) }}">
                            @csrf
                            <button class="btn btn-danger btn-sm pull-right">Close Ticket</button>
                        </form>
                        @endif
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
                            <span class="text-success">Open</span>
                            @elseif($tickets->status == 3)
                            <span class="text-danger">Closed</span>
                            @endif
                        </h5>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <div class="pull-left mt-1">
                            Send a Admin Whisper
                        </div>
                        <form method="POST" action="{{ route('admin.tickets.whisper', $tickets->id) }}">
                            @csrf
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Send Whisper</button>
                            </div>
                    </div>
                    <div class="card-body" style="1.00rem">
                        <textarea rows="5" style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="pull-left mt-1">
                            Reply to the Ticket
                        </div>
                        <form method="POST" action="{{ route('admin.tickets.reply', $tickets->id) }}">
                            @csrf
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Add Reply</button>
                            </div>
                    </div>
                    <div class="card-body" style="1.00rem">
                        @if($tickets->status == 3)
                        <textarea rows="3" disabled style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                        @else
                        <textarea rows="3" style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                        @endif
                    </div>
                    </form>
                </div>

                <div id="comments">
                    <div class="card">
                        <div class="card-body" style="height: 200px;">
                            <div style="margin: 0; position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-left">
                                Sent By: {{ $tickets->name }}
                            </div>
                            <div class="col-6 text-right">
                                Sent: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                @foreach($users as $user)
                                @if($user->id == $tickets->user_id)
                                <img class="center-image rounded-circle" width="55px" src="{{ $user->profile_picture }}">
                                @endif
                                @endforeach
                                <p class="pt-1">
                                    @foreach($users as $user)
                                    @if($user->id == $tickets->user_id)
                                    @foreach($roles as $role)
                                    @if($role->id == $user->role_id)
                                    <span style="color: {{ $role->color }} !important;"><i style="width: 15px;" data-feather="{{ $role->icon }}"></i> {{ $role->name }}</span>
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-10">
                                <p class="text-left" style="width: 87%;">{{ $tickets->message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input id="ticket_id" value="{{ $tickets->id }}" hidden></input>
@endsection

@section('scripts')
<script src="/js/API/ticket.js"></script>
@endsection