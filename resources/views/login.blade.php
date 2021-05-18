{{-- Market Software --}} 
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}} 
    
@extends('assets.main') 

@section('title') 
Login 
@endsection

@section('content')
<div class="container">
    <div class="primary-section">
        <div class="row justify-content-center">
            <h1 class="text-center register-header">Welcome back! <span class="text-main">Login</span> to continue.</h1>
            <div class="col-8">
                <div class="primary-section">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email Address:</label>
                            <input type="email" class="form-control" placeholder="johndoe123@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="invalidCheck">
                                Remember Me
                            </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-main w-100">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection