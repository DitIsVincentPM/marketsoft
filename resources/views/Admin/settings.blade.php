{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
Admin
@endsection

@section('header-title')
Settings
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
@endsection

@section('content')
<div class="pl-0 alert {{ $version[1] }}" role="alert">
    {{ $version[0] }}
</div>
<div class="row mt-3">
    <div class="col-3">
        @include('Admin.Vendor.Settings.sidebar')
    </div>
    <div class="col-9">
        {{-- General Settings --}}
        @if($check[0] == true)
            <div style="display: block;" id="tab-content" data-name="general">
                @include('Admin.Vendor.Settings.general')
            </div>
        @endif

        {{-- Mail Settings --}}
        @if($check[1] == true)
            <div style="display: none;" id="tab-content" data-name="mail">
                @include('Admin.Vendor.Settings.mail')
            </div>
        @endif

        {{-- Navigation Settings --}}
        @if($check[2] == true)
            <div style="display: none;" id="tab-content" data-name="modules">
                @include('Admin.Vendor.Settings.modules')
            </div>
        @endif

        {{-- Addon Settings --}}
        @if($check[3] == true)
            <div style="display: none;" id="tab-content" data-name="addons">
                @include('Admin.Vendor.Settings.addons')
            </div>
        @endif

        {{-- Theme Settings --}}
        @if($check[4] == true)
            <div style="display: none;" id="tab-content" data-name="themes">
                @include('Admin.Vendor.Settings.themes')
            </div>
        @endif

        {{-- Roles Settings --}}
        @if($check[5] == true)
            <div style="display: none;" id="tab-content" data-name="roles">
                @include('Admin.Vendor.Settings.roles')
            </div>
        @endif

        {{-- Legal Documents --}}
        @if($check[6] == true)
            <div style="display: none;" id="tab-content" data-name="legal">
                @include('Admin.Vendor.Settings.legal')
            </div>
        @endif
    </div>
</div>
<script>
    $('#icons').change(function() {
        opt = $(this).val();
        $('#msgbox').attr("data-feather", opt);
        feather.replace();
    })
</script>
@endsection

@section('scripts')

<script>
    @php
    $group = NULL;
    @endphp

    @foreach($permissions as $permission)
    @if($group == NULL)
    @php
    $group = $permission->group;
    @endphp

    $("#{{ $permission->group }}_checkall").click(function() {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    @elseif($group == $permission->group)
    @elseif($group != $permission->group)
    @php
    $group = $permission->group;
    @endphp

    $("#{{ $permission->group }}_checkall").click(function() {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    @endif
    @endforeach
</script>

<script src="/js/custom-tabs.js"></script>

@endsection
