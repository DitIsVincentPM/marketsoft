<form action="{{ route('admin.settings.product.save') }}" method="POST">@csrf
    <div class="card">
    <div class="card-header">
        Product Settings
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Notice:</label>
                <input type="text" class="form-control" name="notice" value="{{ Settings::key('ProductNotice') }}">
                <div class="form-text">The notice it shows on the ShoppingCart page.</div>
            </div>
            <div class="col-12">
                <label for="exampleInputEmail1" class="form-label">Payment Gateways:</label>
                <div class="row">
                    @foreach($payment_gateways as $gateaway)
                    <div class="col-4">
                        <div onclick="status('{{ $gateaway->name }}')" class="user-select-none card card-body">
                            <input name="ga-{{ $gateaway->id }}" id="ga-{{ $gateaway->id }}" hidden value="{{ $gateaway->status }}" />
                            <div class="ribbon-wrapper ribbon-lg">
                                @if($gateaway->status == 0)
                                <div id="{{ $gateaway->name }}-ribbon" class="ribbon bg-danger">
                                    Disabled
                                </div>
                                @else 
                                <div id="{{ $gateaway->name }}-ribbon" class="ribbon bg-success">
                                    Enabled
                                </div>
                                @endif
                            </div>
                            <img style="{{ $gateaway->style }}" src="{{ $gateaway->image }}" class="img-thumbnail" alt="Responsive image">
                            <p class="text-center text-muted mt-4">{{ $gateaway->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary pull-right">Submit</button>
    </div>
</div>
</form>

<script>
    function status(name) {
        @foreach($payment_gateways as $gateaway)
        if(name == "{{ $gateaway->name }}") {
            if(document.getElementById('{{ $gateaway->name }}-ribbon').classList.contains('bg-danger')) {
                document.getElementById('{{ $gateaway->name }}-ribbon').classList.remove('bg-danger');
                document.getElementById('{{ $gateaway->name }}-ribbon').classList.add('bg-success');
                document.getElementById('{{ $gateaway->name }}-ribbon').innerText = "Enabled";
                document.getElementById('ga-{{ $gateaway->id }}').value = "1";
            } else {
                document.getElementById('{{ $gateaway->name }}-ribbon').classList.add('bg-danger');
                document.getElementById('{{ $gateaway->name }}-ribbon').classList.remove('bg-success');
                document.getElementById('{{ $gateaway->name }}-ribbon').innerText = "Disabled";
                document.getElementById('ga-{{ $gateaway->id }}').value = "0";
            }
        } 
        @endforeach
    }
</script>

