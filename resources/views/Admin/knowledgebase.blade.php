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

@section('content')
    <div id="tab-content" data-name="categories" style="display: none;">
        <h4 class="mt-1 mb-0 pull-left">Categories</h4>
        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#creatcategory">Create
            New</button>
        <div class="card shadow">
            <div class="card-body pb-0">
                @foreach ($categorys as $category)
                    <div class="row mb-2 mt-4">
                        <div class="col-1 text-center">
                            <p class="market-text-break announcement-title">{{ $category->id }}</p>
                        </div>
                        <div class="col-7">
                            <h5 class="market-text-break announcement-title">{{ $category->name }}</h5>
                        </div>
                        <div class="col-2">
                            <p class="market-text-break announcement-date">
                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('m/d/Y') }}
                            </p>
                        </div>
                        <div class="col-2 text-center">
                            <form method="POST" action="{{ route('admin.knowledgebase.category.delete', $category->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm pull-right text-danger" title="Delete">
                                    <i data-feather="trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory-{{ $category->id }}">
                                <i data-feather="edit-3"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="tab-content" data-name="article" style="display: block;">
        <h4 class="mt-1 mb-0">Articles</h4>
        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createarticle">Create
            New</button>
        <div class="card shadow">
            <div class="card-body pb-0">
                @foreach ($knowledgebases as $knowledgebase)
                    <div class="row  mb-2 mt-4">
                        <div class="col-1 text-center">
                            <p class="market-text-break announcement-title">{{ $knowledgebase->id }}</p>
                        </div>
                        <div class="col-3">
                            <h5 class="market-text-break announcement-title">{{ $knowledgebase->name }}</h5>
                        </div>
                        <div class="col-4 market-text-break">
                            <p class="announcement-description">{!! $knowledgebase->description !!}</p>
                        </div>
                        <div class="col-2">
                            <p class="market-text-break announcement-date">
                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $knowledgebase->created_at)->format('m/d/Y') }}
                            </p>
                        </div>
                        <div class="col-2 text-center">
                            <form method="POST" action="{{ route('admin.knowledgebase.delete', $knowledgebase->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm pull-right text-danger" title="Delete">
                                    <i data-feather="trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editknowledgebase-{{ $knowledgebase->id }}">
                                <i data-feather="edit-3"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Create New Article Modal --}}
    <div class="modal fade" id="createarticle" tabindex="-1" aria-labelledby="createarticleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createarticleLabel">Create New Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.knowledgebase.new') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Article Title</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Article Description</label>
                            <textarea name="description" class="summernote"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Articles Category</label>
                            <select class="form-select" name="category">
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Announcement Modal --}}
    @foreach ($knowledgebases as $knowledgebase)
        <div class="modal fade" id="editknowledgebase-{{ $knowledgebase->id }}" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editknowledgebaseLabel">Edit Article for #{{ $knowledgebase->id }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.knowledgebase.update', $knowledgebase->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Articles Title</label>
                                <input name="name" type="text" class="form-control" value="{{ $knowledgebase->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Articles Description</label>
                                <textarea name="description" class="summernote">{{ $knowledgebase->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Articles Category</label>
                                <select class="form-select" name="category">
                                    @foreach ($categorys as $category)
                                        <option @if ($category->id == $knowledgebase->category_id) selected @endif value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary pull-right">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Create New Category Modal --}}
    <div class="modal fade" id="creatcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createarticleLabel">Create New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.knowledgebase.category.new') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category Title</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Category Description</label>
                            <textarea name="description" class="summernote"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    @foreach ($categorys as $category)
        <div class="modal fade" id="editcategory-{{ $category->id }}" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editknowledgebaseLabel">Edit Category for #{{ $category->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.knowledgebase.category.update', $category->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Category Title</label>
                                <input name="name" type="text" class="form-control" value="{{ $category->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Category Description</label>
                                <textarea name="description" class="summernote">{{ $category->description }}</textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary pull-right">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('footer')
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center mt-3 mb-3">
            <p>Powered by <a href="https://marketsoft.io">MarketSoft.io</a></p>
        </div>
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Footer Content</h5>

                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                        molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                        voluptatem veniam, est atque cumque eum delectus sint!
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="/js/custom-tabs.js"></script>
@endsection
