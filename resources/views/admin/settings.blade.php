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
        <a onClick="change(0)" style="cursor: pointer;" id="general-button" class="list-group-item list-group-item-action active" aria-current="true">
            <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">General Settings</span>
        </a>
        <a onClick="change(1)" style="cursor: pointer;" id="nav-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="mail" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Mail Settings</span>
        </a>
        <a onClick="change(2)" style="cursor: pointer;" id="text-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="bookmark" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Other Settings</span>
        </a>
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
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">This will be your logo that will be used in the navbar.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label class="form-label">Navbar Icon</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="navbaricon" class="form-control">
                                        <option @if($settings->NavbarIcon == 0) selected @endif value="0">Company Name</option>
                                        <option @if($settings->NavbarIcon == 1) selected @endif value="1">Company Logo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-text">For turning on company logo or text.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label class="form-label">Company Favicon</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" value="{{ $settings->CompanyFavicon }}" class="form-control" readonly>
                                    <div class="input-group-btn">
                                        <span class="fileUpload btn btn-primary">
                                            <span type="button" class="upl" id="upload">Upload</span>
                                            <input id="image" type="file" name="companyfavicon" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                        </span>
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