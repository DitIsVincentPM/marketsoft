<form action="{{ route('admin.modules.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card mb-3">
        <div class="card-body">
            <div class="col-sm-offset-2 col-sm-12"><br>
                <label for="exampleInputEmail1" class="form-label">Module Test</label>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" value="Module Test" class="form-control" readonly>
                        <div class="input-group-btn">
                            <span class="fileUpload btn btn-primary">
                                <span type="button" class="upl" id="upload">Upload</span>
                                <input id="image" type="file" name="module" class="upload up" id="up" onchange="readURL(this);" />
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-text">This will be your logo that will be used in the navbar.</div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

<div class="card mb-3">
    <div class="card-header">
        Module Settings
    </div>
</div>
@foreach ($modules as $module)
    <form action="{{ route('admin.modules.toggle', $module->id) }}" method="POST">
        @csrf
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <p class="mb-0 mt-1 pull-left">{{ $module->name }}</p>
                @if ($module->status == 'enabled')
                    <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
                @else
                    <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
                @endif
            </div>
            <div class="card-body">
                {{ $module->description }}
            </div>
        </div>
    </form>
@endforeach
