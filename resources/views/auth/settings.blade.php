{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Register
@endsection

@section('header-title')
User Settings
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="custom-breadcrumb breadcrumb-item"><a href="#">Home</a></li>
    <li class="custom-breadcrumb breadcrumb-item"><a>Account</a></li>
    <li class="custom-breadcrumb breadcrumb-item active" aria-current="page">Settings</li>
</ol>
@endsection

@section('content')
<form method="POST" action="{{ route('auth.settings.save') }}" enctype='multipart/form-data'>
    <div class="row mt-5">
        <div class="col-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input readonly type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" name="email">
            </div>
            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
        <div class="col-4">
            <div class="box">
                <div class="box-body">
                    <img class="account-settings-users-profile" src="{{ Auth::user()->profile_picture }}">
                </div>
            </div>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-12"><br>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly>
                                <div class="input-group-btn">
                                    <span class="fileUpload btn btn-primary">
                                        <span class="upl" id="upload">Upload</span>
                                        <input type="file" name="picture" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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