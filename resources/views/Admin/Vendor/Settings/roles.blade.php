<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Roles Settings</h5>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createrole">Create New</button>
    </div>
    <table class="table mb-0 text-center">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Name</th>
                <th>Description</th>
                <th>Color</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td><i style="width: 20px;" data-feather="{{ $role->icon }}"></i></td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td><span style="color: {{ $role->color }} !important;">{{ $role->color }}</span></td>
                <td>
                    <form action="{{ route('admin.role.delete', $role->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger pull-right">
                            Delete
                        </button>
                    </form>
                    <button type="button" class="btn btn-sm btn-primary pull-left" data-bs-toggle="modal" data-bs-target="#editrole-{{ $role->id }}">
                        Edit
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- Create new Role Modal --}}
<div class="modal fade" id="createrole" tabindex="-1" aria-labelledby="createroleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createroleLabel">Create new System Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.role.create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Administrator">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Allow anyone to do anything on the site">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Icon:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="msgbox" data-feather="search"></i></span>
                                    <select class="form-select" id="icons" name="icon">
                                        <option selected>Select an Icon</option>
                                        @for ($x = 0; $x <= count($icons) - 1; $x++) <option value="{{ $icons[$x] }}">{{ $icons[$x] }}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-text">This software is using <a href="https://feathericons.com/">feather icons</a>. Learn more on their site.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Color:</label>
                                <input type="color" class="form-control colorpicker br-3" name="color" style="border: none;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                        $group = NULL;
                        @endphp

                        <div class="row">
                            @foreach($permissions as $permission)
                            @if($group == NULL)
                            @php
                            $group = $permission->group;
                            @endphp
                            <div class="col-12">
                                <hr class="mb-2">
                                <div class="form-check" style="font-size: 16px;">
                                    <input class="form-check-input check" type="checkbox" value="" id="{{ $permission->group }}_checkall">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $permission->group }}:
                                    </label>
                                </div>
                                <hr class="mt-2">
                            </div>
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @elseif($group == $permission->group)
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @elseif($group != $permission->group)
                            @php
                            $group = $permission->group;
                            @endphp
                            <div class="col-12">
                                <hr class="mb-2 mt-2">
                                <div class="form-check" style="font-size: 16px;">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault" id="{{ $permission->group }}_checkall">
                                        {{ $permission->group }}:
                                    </label>
                                </div>
                                <hr class="mt-2">
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-check form-switch big-checkbox">
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Create Role</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Administrator Role Modal --}}
@foreach($roles as $role)
<div class="modal fade" id="editrole-{{ $role->id }}" tabindex="-1" aria-labelledby="editroleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroleLabel">Edit Administrator Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.role.update', $role->id)}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Description:</label>
                        <input type="text" class="form-control" name="description" value="{{ $role->description }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Icon:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="msgbox" data-feather="{{ $role->icon }}"></i></span>
                                    <select class="form-select" id="icons" name="icon">
                                        <option selected>Select an Icon</option>
                                        @for ($x = 0; $x <= count($icons) - 1; $x++) <option @if($role->icon == $icons[$x]) selected @endif value="{{ $icons[$x] }}">{{ $icons[$x] }}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-text">This software is using <a href="https://feathericons.com/">feather icons</a>. Learn more on their site.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Color:</label>
                                <input type="color" class="form-control colorpicker br-3" name="color" value="{{ $role->color }}" style="border: none;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                        $group = NULL;
                        @endphp

                        <div class="row">
                            @foreach($permissions as $permission)
                            @if($group == NULL)
                            @php
                            $group = $permission->group;
                            @endphp
                            <div class="col-12">
                                <hr class="mb-2">
                                <div class="form-check" style="font-size: 16px;">
                                    <input class="form-check-input check" type="checkbox" value="" id="{{ $permission->group }}_checkall">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $permission->group }}:
                                    </label>
                                </div>
                                <hr class="mt-2">
                            </div>
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                    @foreach($role_perms as $role_perm)
                                    @if($role_perm->permission_id == $permission->id)
                                    <input name="{{ $permission->key }}" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    @else
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    @endif
                                    @endforeach
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @elseif($group == $permission->group)
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                @foreach($role_perms as $role_perm)
                                    @if($role_perm->permission_id == $permission->id)
                                    <input name="{{ $permission->key }}" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    @else
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    @endif
                                    @endforeach
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @elseif($group != $permission->group)
                            @php
                            $group = $permission->group;
                            @endphp
                            <div class="col-12">
                                <hr class="mb-2 mt-2">
                                <div class="form-check" style="font-size: 16px;">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault" id="{{ $permission->group }}_checkall">
                                        {{ $permission->group }}:
                                    </label>
                                </div>
                                <hr class="mt-2">
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-check form-switch big-checkbox">
                                    @foreach($role_perms as $role_perm)
                                    @if($role_perm->permission_id == $permission->id)
                                    <input name="{{ $permission->key }}" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    @else
                                    <input name="{{ $permission->key }}" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    @endif
                                    @endforeach
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;">{{ $permission->key }}</label>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit Role</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach