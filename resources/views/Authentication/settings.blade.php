{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('Vendor.main')

@section('title')
Settings
@endsection

@section('header-title')
User Settings
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="custom-breadcrumb breadcrumb-item"><a href="#">Home</a></li>
    <li class="custom-breadcrumb breadcrumb-item"><a>Account</a></li>
    <li class="custom-breadcrumb breadcrumb-item active" aria-current="page">Settings</li>
</ol>
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-12 col-lg-9">
            <div class="row justify-content-center @if(Settings::key('GoogleStatus') != 0 or Settings::key('DiscordStatus') != 0 or Settings::key('GithubStatus') != 0) mb-5 @endif">
                @if(Settings::key('DiscordStatus') == 1)
                    <div class="col-12 col-lg-4">
                        @if(Auth::user()->discord_id == NULL)
                            <a href="{{ route('discord.redirect') }}">
                                <button class="btn btn-discord justify-content-center w-100">
                                    <i class="fab fa-discord" style="margin-right: 5px!important;"></i> Connect to Discord
                                </button>
                            </a>
                        @else
                        <a href="{{ route('discord.remove') }}">
                            <button class="btn btn-discord justify-content-center w-100">
                                <i class="fab fa-discord" style="margin-right: 5px!important;"></i> Remove Discord
                            </button>
                        </a>
                        @endif
                    </div>
                @endif
                @if(Settings::key('GoogleStatus') == 1)
                    <div class="col-12 col-lg-4">
                        @if(Auth::user()->google_id == NULL)
                            <a href="{{ route('google.redirect') }}">
                                <button class="btn btn-google justify-content-center w-100">
                                    <i class="fab fa-google" style="margin-right: 5px!important;"></i> Connect to Google
                                </button>
                            </a>
                        @else
                            <a href="{{ route('google.remove') }}">
                                <button class="btn btn-google justify-content-center w-100">
                                    <i class="fab fa-google" style="margin-right: 5px!important;"></i> Remove Google
                                </button>
                            </a>
                        @endif
                    </div>
                @endif
                @if(Settings::key('GithubStatus') == 1)
                    <div class="col-12 col-lg-4">
                        @if(Auth::user()->github_id == NULL)
                            <a href="{{ route('github.redirect') }}">
                                <button class="btn btn-github justify-content-center w-100">
                                    <i class="fab fa-github" style="margin-right: 5px!important;"></i> Connect to GitHub
                                </button>
                            </a>
                        @else
                            <a href="{{ route('github.remove') }}">
                                <button class="btn btn-github justify-content-center w-100">
                                    <i class="fab fa-github" style="margin-right: 5px!important;"></i> Remove GitHub
                                </button>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('auth.settings.save') }}" enctype='multipart/form-data'>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="market-form-label" for="firstname">First Name:</label>
                        <input type="text" class="market-form-input form-control" name="firstname" value="{{ Auth::user()->firstname }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="market-form-label" for="lastname">Last Name:</label>
                        <input type="text" class="market-form-input form-control" name="lastname" value="{{ Auth::user()->lastname }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="market-form-label" for="email">Username:</label>
                <input type="username" class="market-form-input form-control" id="username" value="{{ Auth::user()->name }}" name="username">
            </div>
            <div class="form-group">
                <label class="market-form-label" for="email">Email:</label>
                <input readonly type="email" class="market-form-input-disabled form-control" id="email" value="{{ Auth::user()->email }}" name="email">
            </div>
            <div class="form-group">
                <button onClick="window.location.href=window.location.href" type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
        <div class="col-12 col-lg-3 text-center">
            <div class="box">
                <div class="box-body">
                    <img style="height: 250px" class="account-settings-users-profile profile-picture" src="{{ Auth::user()->profile_picture }}">
                </div>
            </div>
            @csrf
            <br>
            <div class="custom-file">
                <input name="picture" type="file" class="custom-file-input" id="customFile">
                <label style="text-align: left !important;" class="custom-file-label" for="customFile">Choose File</label>
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
