{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installation | MarketSoft</title>
    @include('Vendor.dependencies')
</head>
<style>
    .active {
        display: block !important;
    }

    .mid {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        text-align: center;
    }

</style>

<body style="background-color: f4f6f9;">
    <form action="{{ route('installation.save') }}" method="POST">
        @csrf
        <div data-id="1" class="mid active">
            <h1>Installation</h1>
            <p>Welcome to MarketSoft, A revolutionary hosting, online store software. For absolutly nothing.</p>
            <a onclick="nextstep()" class="btn btn-primary">Next 》</a>
        </div>
        <div data-id="2" class="mid">
            <h1>Installation - Step 1</h1>
            <p>Create your first admin account.</p>
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <label>First Name</label>
                        <input class="form-control" name="firstname"/>
                    </div>
                    <div class="col-6">
                        <label>Last Name</label>
                        <input class="form-control" name="lastname"/>
                    </div>
                </div>
            </div>
            <br>
            <label>Name</label>
            <input class="form-control" name="name"/>
            <br>
            <label>Email</label>
            <input class="form-control" name="email"/>
            <br>
            <label>Password</label>
            <input type="password" class="form-control" name="password"/>
            <br>
            <a onclick="nextstep()" class="btn btn-primary">Next 》</a>
        </div>
        <div data-id="3" class="mid">
            <h1>Installation - Step 2</h1>
            <p>Configure the Settings.</p>
            <label>Company Name</label>
            <input class="form-control" name="companyname"/>
            <br>
            <a onclick="nextstep()" class="btn btn-primary">Next 》</a>
        </div>
        <div data-id="4" class="mid">
            <h1>Installation - Done</h1>
            <p>You finished the installation of marketsoft. Hope you have great expiernce.</p>
            <button class="btn btn-success">Save</a>
        </div>
    </form>
</body>

<script>
    var steps = 2;
    var currentstep = 1;

    function nextstep() {
        console.log("click");
        var arr = document.querySelectorAll("div[data-id]");
        for (var i = 0; i < arr.length; i++) {
            if (currentstep == i + 1) {
                arr[i].classList.remove('active');
            } else if (currentstep + 1 == i + 1) {
                arr[i].classList.add('active');
            }
        }
        currentstep++;
    }

</script>

</html>
