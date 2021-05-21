<form action="{{ route('admin.modules.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-10">
            <div class="form-group">
                <div class="input-group">
                    <input style="height: 40px;" type="text" placeholder="Search..." class="form-control">
                </div>
            </div>
        </div>
        <div class="col-2">
            <button style="width: 100%;" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<div class="row">
    @for($i=0; $i < count($modules["modules"]); $i++)
        <div class="col-6">
            <form action="{{ route('admin.modules.upload', 1) }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">
                        <p class="mb-0 mt-1 pull-left">{{ $modules["modules"][$i]["name"] }}</p>
                        <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Install</button>
                    </div>
                    <div class="card-body">
                        {{ Str::limit($modules["modules"][$i]["description"], 60) }}
                    </div>
                </div>
            </form>
        </div>
    @endfor
</div>
