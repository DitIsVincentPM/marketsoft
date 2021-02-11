



<?php $__env->startSection('title'); ?>
Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Seller Requests
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Sellers</a></li>
    <li class="breadcrumb-item active" aria-current="page">Requests</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($request->id); ?></th>
                    <td><?php echo e($request->name); ?></td>
                    <td><?php echo e($request->company); ?></td>
                    <td><?php echo e($request->email); ?></td>
                    <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewmore-<?php echo e($request->id); ?>">View More</button></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="modal fade" id="viewmore-<?php echo e($request->id); ?>" tabindex="-1" aria-labelledby="viewmoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewmoreLabel">Seller Request #<?php echo e($request->id); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Full Name:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="<?php echo e($request->name); ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Company Name:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="<?php echo e($request->company); ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Email Address:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="<?php echo e($request->email); ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Users Age:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="<?php echo e($request->age); ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Products:</span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="<?php echo e($request->selling); ?>">
                </div>
                <hr>
                <form method="post" action="<?php echo e(route('admin.sellerrequests.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">Request Status:</span>
                        </div>
                        <input hidden name="id" value="<?php echo e($request->id); ?>"></input>
                        <select name="status" class="form-select">
                            <option <?php if($request->status == 0): ?> selected <?php endif; ?> value="0">Pending</option>
                            <option <?php if($request->status == 1): ?> selected <?php endif; ?> value="1">Accepted</option>
                            <option <?php if($request->status == 2): ?> selected <?php endif; ?> value="2">Denied</option>
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/admin/seller-requests.blade.php ENDPATH**/ ?>