{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
    Invoice Status
@endsection

@section('header-title')
    Invoice Status
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{-- route('products.index') --}}">Invoices</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Status</a></li>
    </ol>
@endsection

@section('content')
    @if ($status == 'success')
        <div class="card card-body">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark fa fa-check"></i>
            </div><br>
            <h1 class="text-center">Success</h1>
            <p class="text-center">Your payment is being proccessed.<br> You will revieve a notification about your order.</p>
        </div>
        <style>
            .checkmark {
                color: #9ABC66;
                font-size: 100px;
                line-height: 200px;
                margin-left: 50px;
            }
        </style>
     @elseif($status == 'processing')
     <div class="card card-body">
         <div style="border-radius:200px; height:200px; width:200px; background: #ffe5ac; margin:0 auto;">
             <i class="checkmark fa fa-redo-alt"></i>
         </div><br>
         <h1 class="text-center">Payment Processing</h1>
         <p class="text-center">Your payment is being processed.<br> You will get a mail & notification when your payment is successful.</p>
     </div>
     <style>
         .checkmark {
             color: #ffba39;
             font-size: 100px;
             line-height: 200px;
             margin-left: 50px;
         }
     </style>
    @elseif($status == 'canceld')
    <div class="card card-body">
        <div style="border-radius:200px; height:200px; width:200px; background: #ececec; margin:0 auto;">
            <i class="checkmark fa fa-ban"></i>
        </div><br>
        <h1 class="text-center">Canceld</h1>
        <p class="text-center">Your order is canceld.<br> You will recieve a mail with more information.</p>
    </div>
    <style>
        .checkmark {
            color: #818181;
            font-size: 100px;
            line-height: 200px;
            margin-left: 50px;
        }
    </style>
    @else
    <div class="card card-body">
        <div style="border-radius:200px; height:200px; width:200px; background: #ececec; margin:0 auto;">
            <i class="checkmark fa fa-exclamation-triangle"></i>
        </div><br>
        <h1 class="text-center">Oops!</h1>
        <p class="text-center">There is no payment status found. Look at your invoices and check if its payed.</p>
    </div>
    <style>
        .checkmark {
            color: #a5a5a5;
            font-size: 100px;
            line-height: 200px;
            margin-left: 45px;
        }
    </style>
    @endif
@endsection
