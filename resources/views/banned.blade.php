{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
    Banned
@endsection

@section('content')
    <div class="card card-body mt-5 p-5 container text-center">
        <div >
            <img src="/themes/default/icons/reminder.svg" height="300" class="float-left" />
            <div class="float-right p-5">
                <h1>Oh no!</h1>
                <p>It seems like you have been banned by an administrator</p>
                <p>In case you think this ban isn't rightfully granted to you<br>contact the support team at:
                    {{ Settings::key('SupportMail') }}</p>
            </div>
        </div>
    </div>
@endsection
