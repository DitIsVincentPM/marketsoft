<div class="card mb-3">
    <div class="card-header">
        Theme Settings
    </div>
</div>
<div class="alert alert-primary" role="alert">
    This feature has not been released yet. Please stay tuned for updates.
</div>
@for($i=0; $i < count($themes); $i++) <div class="card mt-3 mb-3">
    <div class="card-header">
        <p class="mb-0 mt-1 pull-left">{{ $themes[$i]["name"] }} <small>(V{{ $themes[$i]["version"] }})</small></p>
        @if($themes[$i]["enabled"] == true)
        <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
        @else
        <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
        @endif
    </div>
    <div class="card-body">
        {{ $themes[$i]["description"] }}
    </div>
</div>
@endfor