{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

@extends('assets.main')

@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="primary-section">
        <div class="home-header">
            <div class="container animateme" data-when="exit" data-from="0" data-to="0.75" data-opacity="0" data-translatey="-100">
                <h1>The most Advanced Software <br>for your <span id="typed2"></span></h1>
            </div>
        </div>
    </div>
</div>

<script src="/js/typed.js"></script>
<script>
var typed3 = new Typed('#typed2', {
strings: ["Business.", "MarketPlace.", "Hosting Company.", "Online Store."],
typeSpeed: 100,
backSpeed: 60,
smartBackspace: true,
loop: true
});
</script>
@endsection