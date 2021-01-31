{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('assets.admin')

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
<ul class="nav nav-tabs mt-3">
    <li class="nav-item">
        <a id="general-button" class="admin-nav-link nav-link active" onClick="change(0)" aria-current="page" href="#">General</a>
    </li>
    <li class="nav-item">
        <a id="nav-button" class="admin-nav-link nav-link" onClick="change(1)" href="#">Navigation</a>
    </li>
    <li class="nav-item">
        <a id="text-button" class="admin-nav-link nav-link" onClick="change(2)" href="#">Text Editor</a>
    </li>
</ul>

{{-- General Settings --}}
<div style="display: block;" class="card" id="general">
    <form method="post" action="{{ route('admin.settings.save') }}">
        @csrf
        <div class="body">
            @foreach($settings as $setting)
            @if($setting->group == "general")
            @if($setting->type == "text")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <input type="text" name="companyname" class="form-control" value="{{ $setting->value }}">
            </div>
            @elseif($setting->type == "boolean")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <select name="{{ $setting->key }}" class="form-select">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            </div>
            @elseif($setting->type == "image")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <input id="image" type="text" class="form-control" readonly>
                <div class="input-group-btn">
                    <span class="fileUpload btn btn-primary">
                        <span class="upl" id="upload">Upload</span>
                        <input type="file" name="{{ $setting->key }}" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                    </span>
                </div>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        <div class="card-footer">
            <button class="btn-sm btn btn-primary">Submit</button>
        </div>
    </form>
</div>

{{-- Navigation Settings --}}
<div style="display: none;" class="card" id="nav">
    <form method="post" action="{{ route('admin.settings.save') }}">
        @csrf
        <div class="body">
            @foreach($settings as $setting)
            @if($setting->group == "navigation")
            @if($setting->type == "text")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <input type="text" name="companyname" class="form-control" value="{{ $setting->value }}">
            </div>
            @elseif($setting->type == "boolean")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <select name="{{ $setting->key }}" class="form-select">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        <div class="card-footer">
            <button class="btn-sm btn btn-primary">Submit</button>
        </div>
    </form>
</div>

{{-- TextEditor Settings --}}
<div style="display: none;" class="card" id="text">
    <form method="post" action="{{ route('admin.settings.save') }}">
        @csrf
        <div class="body">
            @foreach($settings as $setting)
            @if($setting->group == "text")
            @if($setting->type == "text")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <input type="text" name="companyname" class="form-control" value="{{ $setting->value }}">
            </div>
            @elseif($setting->type == "boolean")
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{ $setting->key }}:</span>
                </div>
                <select name="{{ $setting->key }}" class="form-select">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        <div class="card-footer">
            <button class="btn-sm btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    function change(number) {
        if (number == 0) {
            document.getElementById('general').style.display = "block";
            document.getElementById('nav').style.display = "none";
            document.getElementById('text').style.display = "none";

            document.getElementById('general-button').classList.add('active');
            document.getElementById('nav-button').classList.remove('active');
            document.getElementById('text-button').classList.remove('active');
        } else if (number == 1) {
            document.getElementById('general').style.display = "none";
            document.getElementById('nav').style.display = "block";
            document.getElementById('text').style.display = "none";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('nav-button').classList.add('active');
            document.getElementById('text-button').classList.remove('active');
        } else if (number == 2) {
            document.getElementById('general').style.display = "none";
            document.getElementById('nav').style.display = "none";
            document.getElementById('text').style.display = "block";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('nav-button').classList.remove('active');
            document.getElementById('text-button').classList.add('active');
        }
    }
</script>
<script>
    $(document).on('change', '.up', function() {
        var names = [];
        var length = $(this).get(0).files.length;
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        if (length > 2) {
            var fileName = names.join(', ');
        } else {
            document.getElementById('image').value = names;
        }
    });
</script>
@endsection