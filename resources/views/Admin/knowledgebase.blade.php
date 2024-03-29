{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Knowledgebase
@endsection

@section('header-title')
    Knowledgebase
@endsection

@section('header-breadcrumb')
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Knowledgebase</a></li>
    </ol>
@endsection

@section('smallbar')
    <li class="nav-item">
        <a onClick="change('article')" class="nav-link">Articles</a>
    </li>
    <li class="nav-item">
        <a onClick="change('categories')" class="nav-link">Categories</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" placeholder="Search..." name="search" id="search"
                        class="admin-search-input form-control" />
                </div>
                <button type="button" class="btn btn-primary">
                    <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                </button>
            </div>
        </div>
    </div>
    <br>
    <div id="tab-content" data-name="categories" style="display: none;">
        <div class="card shadow" id="loader2">
            <div class="card-header">
                Announcements Categories
                <div class="card-tools">
                    <button type="button" class="btn btn-tool animate-icon" data-bs-toggle="modal"
                        data-bs-target="#creatcategory">
                        <i class="far fa-plus-square"></i>
                    </button>
                    <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody id="category-table">
                </tbody>
            </table>
            <div class="card-footer" id="c-footer"></div>
        </div>
    </div>
    <div id="tab-content" data-name="article" style="display: none;">
        <div class="card shadow" id="loader">
            <div class="card-header">
                Knowledgebase Articles
                <div class="card-tools">
                    <button type="button" class="btn btn-tool animate-icon" data-bs-toggle="modal"
                        data-bs-target="#createarticle">
                        <i class="far fa-plus-square"></i>
                    </button>
                    <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="table">
                </tbody>
            </table>
            <div class="card-footer" id="footer"></div>
        </div>
    </div>

    {{-- Create New Article Modal --}}
    <div class="modal fade" id="createarticle" tabindex="-1" aria-labelledby="createarticleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createarticleLabel">Create New Article</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Article Title</label>
                        <input name="name" type="text" class="form-control" id="ac-title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Article Description</label>
                        <textarea name="description" class="form-control" id="ac-description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Articles Category</label>
                        <select id="ac-category" class="form-control" name="category">
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" onclick="articlecreate()" data-bs-dismiss="modal"
                        class="btn btn-primary pull-right">Create</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Announcement Modal --}}
    <div class="modal fade" id="editarticle" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editknowledgebaseLabel">Edit Article for #<span id="a-id"></span>
                    </h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Articles Title</label>
                        <input id="a-name" name="name" type="text" class="form-control" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Articles Description</label>
                        <textarea name="description" class="form-control" id="a-description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Articles Category</label>
                        <select id="a-category" class="form-control">
                        </select>
                    </div>
                </div>
                <input hidden id="a-ids" value="" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" onclick="articleupdate()" data-bs-dismiss="modal"
                        class="btn btn-primary pull-right">Edit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Create New Category Modal --}}
    <div class="modal fade" id="creatcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createarticleLabel">Create New Category</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.knowledgebase.category.new') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category Title</label>
                            <input name="name" id="ca_name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Category Description</label>
                            <textarea name="description" id="ca_description" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" onclick="categorycreate()" data-bs-dismiss="modal"
                        class="btn btn-primary pull-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editknowledgebaseLabel">Edit Category for #<span
                            id="category_id"></span></span></h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Title</label>
                        <input name="name" type="text" id="category_name" class="form-control" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Category Description</label>
                        <textarea name="description" id="category_description" class="form-control"></textarea>
                    </div>
                </div>
                <input hidden id="categorys_id" value="" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" onclick="categoryupdate()" data-bs-dismiss="modal"
                        class="btn btn-primary pull-right">Edit</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/API/knowledgebase.js"></script>
@endsection
