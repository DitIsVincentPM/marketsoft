@if($settings->tos_status == 0)
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Terms of Service</h5>
        <form action="{{ route('admin.tos.status') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-sm pull-right">Enable</button>
        </form>
    </div>
</div>
@else
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Terms of Service</h5>
        <form action="{{ route('admin.tos.status') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm pull-right">Disable</button>
        </form>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createtos" style="margin-right: 5px!important;">Create Section</button>
    </div>
    <table class="table text-center" style="margin-bottom: 0px!important;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($tos_sections as $tos_section)
                <tr>
                    <td>{{ $tos_section->id }}</td>
                    <td>{{ Shorten::string($tos_section->title, 20) }}</td>
                    <td>{{ Shorten::string($tos_section->description, 45) }}</td>
                    <td>
                        <form action="{{ route('admin.tos.section.delete', $tos_section->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#edittos{{ $tos_section->id }}" class="btn btn-primary btn-sm pull-right" style="margin-right: 2px!important;">Edit</button>
                    </td>
                </tr>

                <div class="modal fade" id="edittos{{ $tos_section->id }}" tabindex="-1" aria-labelledby="edittosLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="edittosLabel">Edit Section #{{ $tos_section->id }}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('admin.tos.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $tos_section->title }}">
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Section Description</label>
                                <textarea class="form-control" name="description" style="height: 100px">{{ $tos_section->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary">Edit Section</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="createtos" tabindex="-1" aria-labelledby="createtosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createtosLabel">Create a Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin.tos.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Section Title</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" style="height: 100px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endif

@if($settings->privacy_status == 0)
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Privacy Policy</h5>
        <form action="{{ route('admin.privacy.status') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-sm pull-right">Enable</button>
        </form>
    </div>
</div>
@else
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Privacy Policy</h5>
        <form action="{{ route('admin.privacy.status') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm pull-right">Disable</button>
        </form>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createprivacy" style="margin-right: 5px!important;">Create Section</button>
    </div>
    <table class="table text-center" style="margin-bottom: 0px!important;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($privacy_sections as $privacy_section)
                <tr>
                    <td>{{ $privacy_section->id }}</td>
                    <td>{{ Shorten::string($privacy_section->title, 20) }}</td>
                    <td>{{ Shorten::string($privacy_section->description, 45) }}</td>
                    <td>
                        <form action="{{ route('admin.privacy.section.delete', $privacy_section->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#editprivacy{{ $privacy_section->id }}" class="btn btn-primary btn-sm pull-right" style="margin-right: 2px!important;">Edit</button>
                    </td>
                </tr>

                <div class="modal fade" id="editprivacy{{ $privacy_section->id }}" tabindex="-1" aria-labelledby="editprivacyLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editprivacyLabel">Edit Section #{{ $privacy_section->id }}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('admin.privacy.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $privacy_section->title }}">
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Section Description</label>
                                <textarea class="form-control" name="description" style="height: 100px">{{ $privacy_section->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary">Edit Section</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="createprivacy" tabindex="-1" aria-labelledby="createprivacyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createprivacyLabel">Create a Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin.privacy.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Section Title</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" style="height: 100px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endif