



<?php $__env->startSection('title'); ?>
    Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Seller Requests
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($product->id); ?></th>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category); ?></td>
                            <td><?php echo e($product->price); ?></td>
                            <td class="text-right"><button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewmore-<?php echo e($product->id); ?>">View More</button></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="viewmore-<?php echo e($product->id); ?>" tabindex="-1" aria-labelledby="viewmoreLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="viewmoreLabel">Product #<?php echo e($product->id); ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Name:</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo e($product->name); ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Price:</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo e($product->price); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Description (Short):</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo e($product->description); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Category:</span>
                                </div>
                                <select class="form-select" name="category">
                                    <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <div class="card-body">
                                    <div id="sections">
                                    </div>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="/js/API/products.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/products.blade.php ENDPATH**/ ?>