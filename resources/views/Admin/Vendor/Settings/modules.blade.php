<div class="card mb-3">
    <div class="card-header">
        Module Settings
    </div>
</div>
@foreach($modules as $module)
<div class="card mt-3 mb-3">
    <div class="card-header">
        <p class="mb-0 mt-1 pull-left">{{ $module->name }}</p>
        @if($module->is_enabled == 1)
        <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
        @else
        <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
        @endif
    </div>
    <div class="card-body">
        {{ $module->description }}
    </div>
</div>
@endforeach