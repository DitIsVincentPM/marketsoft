{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
Admin
@endsection

@section('header-title')
Seller Requests
@endsection

@section('header-breadcrumb')
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Sellers</a></li>
    <li class="breadcrumb-item active" aria-current="page">Requests</li>
</ol>
@endsection

@section('content')
<div class="primary-section">
    <div class="row">
        <div class="col-8">
            <form>
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="form1" class="admin-search-input form-control" />
                    </div>
                    <button type="button" class="admin-search-button btn btn-primary">
                        <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-2">
            <button class="btn btn-primary w-100">Pending Requests</button>
        </div>
        <div class="col-2">
            <button class="btn btn-primary w-100">All Requests</button>
        </div>
    </div>
    <br>
    <div class="card shadow">
        <table class="table caption-top admin-table-footer">
            <thead>
                <tr class="admin-table-header">
                    <th class="admin-table" scope="col">#</th>
                    <th class="admin-table" scope="col">Full</th>
                    <th class="admin-table" scope="col">Company</th>
                    <th class="admin-table" scope="col">Email</th>
                    <th class="admin-table" scope="col">More</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <th scope="row">{{ $request->id }}</th>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->company }}</td>
                    <td>{{ $request->email }}</td>
                    <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewmore-{{ $request->id }}">View More</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($requests as $request)
{{-- View More Modal --}}
<div class="modal fade" id="viewmore-{{ $request->id }}" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewmoreLabel">Seller Request #{{ $request->id }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Full Name:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="{{ $request->name }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Company Name:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="{{ $request->company }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Email Address:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="{{ $request->email }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Users Age:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="{{ $request->age }}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Products:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="{{ $request->selling }}">
                </div>
                <hr>
                <form method="post" action="{{ route('admin.sellerrequests.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Request Status:</span>
                        </div>
                        <input hidden name="id" value="{{ $request->id }}"></input>
                        <select name="status" class="form-select">
                            <option @if($request->status == 0) selected @endif value="0">Pending</option>
                            <option @if($request->status == 1) selected @endif value="1">Accepted</option>
                            <option @if($request->status == 2) selected @endif value="2">Denied</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection