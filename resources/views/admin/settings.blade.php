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
<div class="row mt-3">
    <div class="list-group col-3">
        <a onClick="change(0)" id="general-button" class="list-group-item list-group-item-action active" aria-current="true">
            General Settings
        </a>
        <a onClick="change(1)" id="nav-button" class="list-group-item list-group-item-action">Navigation Settings</a>
        <a onClick="change(2)" id="text-button" class="list-group-item list-group-item-action">Text Settings</a>
    </div>
    {{-- General Settings --}}
    <div style="display: block;" class="col-9" id="general">
        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.settings.save') }}">
            <input hidden name="type" value="general"></input>
            @csrf
            <div class="card">
                <div class="card-header">
                    General Settings
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="companyname" value="{{ $settings->CompanyName }}">
                            <div class="form-text">Putt the name here the name that will show everywhere as you company name.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label for="exampleInputEmail1" class="form-label">Company Logo</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" value="{{ $settings->CompanyLogo }}" class="form-control" readonly>
                                    <div class="input-group-btn">
                                        <span class="fileUpload btn btn-primary">
                                            <span type="button" class="upl" id="upload">Upload</span>
                                            <input id="image" type="file" name="companylogo" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                        </span>
                                        <span id="off" onClick="statuschange(1)" style="display: inline-block;" class="fileUpload btn btn-danger">
                                            <span type="button" class="upl">Turn Off</span>
                                        </span>
                                        <span id="on" onClick="statuschange(0)" style="display: none;" class="fileUpload btn btn-success">
                                            <span type="button" class="upl">Turn On</span>
                                        </span>
                                        <input hidden id="statussss" name="logostatus" value="1"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">This will be your logo that will be used in the navbar.</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Navigation Settings --}}
    <div style="display: none;" class="col-9" id="nav">
        <div class="card">
            <div class="card-header">
                Navigation Settings
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>

    {{-- TextEditor Settings --}}
    <div style="display: none;" class="col-9" id="text">
        <div class="card">
            <div class="card-header">
                Text Settings
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
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

    function statuschange(number) {
        if(number == 1) {
            document.getElementById('on').style.display = "inline-block";
            document.getElementById('off').style.display = "none";
            document.getElementById('statussss').value = 1;
        } else if(number == 0) {
            document.getElementById('on').style.display = "none";
            document.getElementById('off').style.display = "inline-block";
            document.getElementById('statussss').value = 0;
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
            $(this).closest('.form-group').find('.form-control').attr("value", length + " files selected");
        } else {
            $(this).closest('.form-group').find('.form-control').attr("value", names);
        }
    });

    $("#up").click(function(event) {
        if (!valid) {
            event.preventDefault();
        }
    });
</script>
@endsection