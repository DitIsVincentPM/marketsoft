



<?php $__env->startSection('title'); ?>
    Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow" id="loader">
        <div class="card-header">
            Users Table
            <div class="card-tools">
                <button type="button" class="btn btn-tool animate-icon" onclick="createusermodal()" data-bs-toggle="modal" data-bs-target="#createuser">
                    <i class="far fa-plus-square"></i>
                </button>
                <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table caption-top admin-table-footer">
                <thead>
                    <tr class="admin-table-header">
                        <th class="text-center admin-table" scope="col">#</th>
                        <th class="text-center admin-table" scope="col">Name</th>
                        <th class="text-center admin-table" scope="col">Email</th>
                        <th class="text-center admin-table" scope="col">Role</th>
                        <th class="text-center admin-table" scope="col">Status</th>
                        <th class="padmin-table" scope="col"><span class="pull-right">More</span></th>
                    </tr>
                </thead>
                <tbody id="table">

                </tbody>
            </table>
            <div class="card-footer" id="footer"></div>
        </div>
    </div>

    <div class="modal fade" id="viewmore" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="content">
            </div>
        </div>
    </div>

    <!-- Create User -->
    <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="createuserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="createmodal">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/API/users.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/users.blade.php ENDPATH**/ ?>