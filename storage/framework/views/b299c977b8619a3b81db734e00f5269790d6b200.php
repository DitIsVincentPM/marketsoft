



<?php $__env->startSection('title'); ?>
    Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Products & Services
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="primary-section">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="customRange1" class="form-label mb-0">Price Range:</label>
                        <input type="text" id="price" value="" />
                        <script>
                            $("#price").ionRangeSlider({
                                min: 0,
                                max: 10000,
                                from: 0,
                                to: 10000,
                                type: 'double',
                                prefix: "$",
                                grid: true,
                                grid_num: 5
                            });
                        </script>
                        <br>
                        <label for="customRange1" class="form-label mb-0">Product Categories:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>All Categories</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <br><br>
                        <label for="customRange1" class="form-label mb-0">Product Ratings:</label><br>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>All Ratings</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="row mb-4">
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <img width="150" src="/images/products/<?php echo e($product->logo); ?>" alt="<?php echo e($product->name); ?>" />
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <h4 class="mb-1"><?php echo e(Shorten::string($product->name, 18)); ?></h4>
                                            </div>
                                            <div>
                                                <h3>$<?php echo e($product->price); ?></h3>
                                            </div>
                                            <div>
                                                <p><?php echo e(Shorten::string($product->description, 75)); ?></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <p>Views: <?php echo e($product->views); ?></p>
                                                </div>
                                                <div class="col-7">
                                                    <p>Downloads: <?php echo e($product->downloads); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-center mb-0">Category: <span style="font-weight: 700;"><?php echo e($product->Category->name); ?></span></p>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php echo e(route('products.view', $product->id)); ?>"><button class="btn btn-primary btn-sm w-100">Order Now</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        NOTHING IS HERE NOOOOOOOOOOOO
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Products/index.blade.php ENDPATH**/ ?>