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
