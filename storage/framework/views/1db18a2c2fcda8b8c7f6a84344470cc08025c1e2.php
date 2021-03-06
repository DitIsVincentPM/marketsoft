   <?php $__env->startSection('title'); ?> Admin <?php $__env->stopSection(); ?> <?php $__env->startSection('header-title'); ?> Announcements <?php $__env->stopSection(); ?> <?php $__env->startSection('header-breadcrumb'); ?>
  <ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Announcements</li>
</ol>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div id="alert"></div>
<div class="row">
    <div class="col-10">
        <div class="input-group">
            <div class="form-outline">
                <input type="search" placeholder="Search..." name="search" id="search" class="admin-search-input form-control" />
            </div>
            <button type="button" class="btn btn-primary">
              <i style="width: 16px;" data-feather="search" class="mr-1"></i>
          </button>
        </div>
    </div>
    <div class="col-2">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createannouncement">Create</button>
    </div>
</div>
<br>
<div class="card shadow">
    <table class="table caption-top admin-table-footer">
        <thead>
            <tr class="admin-table-header">
                <th class="text-center admin-table" scope="col">#</th>
                <th class="text-center admin-table" scope="col">Title</th>
                <th class="text-center admin-table" scope="col">Description</th>
                <th class="text-center admin-table" scope="col">Edit</th>
                <th class="text-center admin-table" scope="col">Delete</th </tr>
        </thead>
        <tbody id="table">
            <tr style="height: 200px;">
                <th></th>
                <th></th>
                <th>
                    <div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </th>
                <th></th>
                <th></th>
            </tr>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createannouncement" tabindex="-1" aria-labelledby="createannouncementLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="createannouncementLabel">Create New Announcement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label">Announcement Title</label>
                  <input id="name" type="text" class="form-control">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Announcement Description</label>
                  <textarea id="description" class="form-control"></textarea>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" onclick="announcement_create()" data-bs-dismiss="modal" class="btn btn-primary pull-right">Create</button>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="modaledit">
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('scripts'); ?>
<script src="/js/API/announcements.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/announcements.blade.php ENDPATH**/ ?>