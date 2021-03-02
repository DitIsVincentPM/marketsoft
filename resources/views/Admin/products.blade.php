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
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
@endsection

@section('content')
    <div class="primary-section">
        <div class="row">
            <div class="col-10">
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
                <button class="btn btn-primary w-100">All Requests</button>
            </div>
        </div>
        <br>
        <div class="card shadow">
            <table class="table caption-top admin-table-footer">
                <thead>
                    <tr class="admin-table-header">
                        <th class="admin-table" scope="col">#</th>
                        <th class="admin-table" scope="col">Name</th>
                        <th class="admin-table" scope="col">Category</th>
                        <th class="admin-table" scope="col">Price</th>
                        <th class="text-right admin-table" scope="col">More</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td class="text-right"><button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewmore-{{ $product->id }}">View More</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="viewmore-{{ $product->id }}" tabindex="-1" aria-labelledby="viewmoreLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="viewmoreLabel">Product #{{ $product->id }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Name:</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Price:</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Description (Short):</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $product->description }}">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Category:</span>
                                </div>
                                <select class="form-select" name="category">
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            Sections
                                        </div>
                                        <div class="text-right col-4">
                                            <button id="create-section" class="btn btn-sm btn-primary">Create</button>
                                        </div>
                                    </div>
                                </div>
                                    <div id="sections">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="save" type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>   
            </div>
        </div>
    @endforeach
    <script src="/js/API/products.js"></script>
@endsection