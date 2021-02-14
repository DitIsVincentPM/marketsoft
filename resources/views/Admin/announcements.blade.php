{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
Announcements
@endsection

@section('header-title')
Announcements
@endsection

@section('header-breadcrumb')
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Announcements</a></li>
</ol>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mt-1 mb-0 pull-left">System Announcements</h4>
                <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createannouncement">Create New</button>
            </div>
            <div class="card-body pb-0">
                @foreach($announcements as $announcement)
                    <div class="row mb-2">
                        <div class="col-1 text-center">
                            <p class="market-text-break announcement-title">{{ $announcement->id }}</p>
                        </div>
                        <div class="col-3">
                            <h5 class="market-text-break announcement-title">{{ $announcement->name }}</h5>
                        </div>
                        <div class="col-4 market-text-break">
                            <p class="announcement-description">{!! $announcement->description !!}</p>
                        </div>
                        <div class="col-2">
                            <p class="market-text-break announcement-date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->format('m/d/Y') }}</p>
                        </div>
                        <div class="col-2 text-center">
                            <form method="POST" action="{{ route('admin.announcements.delete', $announcement->id) }}">
                            @csrf
                                <button type="submit" class="btn btn-sm pull-right text-danger" title="Delete">
                                    <i data-feather="trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editannouncement-{{ $announcement->id }}">
                                <i data-feather="edit-3"></i>
                            </button>
                            <button class="btn btn-sm pull-right text-primary" onclick="window.location.href='{{ route('announcements.view', $announcement->id) }}'" title="View">
                                <i data-feather="eye"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Create New Announcement Modal --}}
<div class="modal fade" id="createannouncement" tabindex="-1" aria-labelledby="createannouncementLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createannouncementLabel">Create New Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.announcements.new') }}">
        @csrf
            <div class="mb-3">
                <label class="form-label">Announcement Title</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Announcement Description</label>
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

{{-- Edit Announcement Modal --}}
@foreach($announcements as $announcement)
<div class="modal fade" id="editannouncement-{{ $announcement->id }}" tabindex="-1" aria-labelledby="editannouncementLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editannouncementLabel">Edit Announcement for #{{ $announcement->id }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}">
        @csrf
            <div class="mb-3">
                <label class="form-label">Announcements Title</label>
                <input name="name" type="text" class="form-control" value="{{ $announcement->name }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Announcements Description</label>
                <textarea name="description" class="summernote">{{ $announcement->description }}</textarea>
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