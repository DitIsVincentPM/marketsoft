



<?php $__env->startSection('title'); ?>
    Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Products & Services
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="alert"></div>
    <div class="row">
        <div class="col-10">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" placeholder="Search..." id="form1" class="input-search admin-search-input form-control" />
                </div>
                <button type="button" class="admin-search-button btn btn-primary">
                    <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                </button>
            </div>
        </div>
        <div class="col-2">
            <button onclick="create()" data-bs-toggle="modal" data-bs-target="#viewmore" class="right btn btn-primary w-100">Create</button>
        </div>
    </div>
    <br>
    <div class="card shadow">
        <div class="card-header">
            Products Table
            <span class="pull-right animate-icon" onclick="refresh()" id="refresh" data-feather="refresh-ccw"></span>
        </div>
        <table class="table caption-top admin-table-footer">
            <thead>
                <tr class="admin-table-header">
                    <th class="admin-table" scope="col">#</th>
                    <th class="admin-table" scope="col">Name</th>
                    <th class="admin-table" scope="col">Description</th>
                    <th class="admin-table" scope="col">Price</th>
                    <th class="text-right admin-table" scope="col">More</th>
                </tr>
            </thead>
            <tbody id="products_table">
                <tr style="height: 200px;">
                    <th></th>
                    <th>
                        <div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </th>
                    <th></th>
                </tr>
            </tbody>
        </table>
        <div class="card-footer" id="footer"></div>
    </div>


    <div class="modal fade" id="viewmore" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="product_model">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="/js/API/products.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/products.blade.php ENDPATH**/ ?>