{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.main')

@section('title')
Banned
@endsection

@section('header-title')
Banned User
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Banned</a></li>
</ol>
@endsection

@section('content')
<div class="alert alert-primary text-center" role="alert">
  Oh no! Administration has banned your account! Reach out to us at {{ Settings::key('SupportMail') }} if you have questions or concerns about your ban.
</div>
@endsection