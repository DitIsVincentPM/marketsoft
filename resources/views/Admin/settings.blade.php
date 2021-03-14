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
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
@endsection

@section('content')
        <div class="pl-0 alert {{ $version[1] }}" role="alert">
            {{ $version[0] }}
        </div>
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

        {{-- OAuth2 Settings --}}
        @if($check[7] == true)
            <div style="display: none;" id="tab-content" data-name="oauth2">
                @include('Admin.Vendor.Settings.oauth2')
            </div>
        @endif
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
@endsection
