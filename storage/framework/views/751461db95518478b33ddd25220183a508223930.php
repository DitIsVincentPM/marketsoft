



<?php $__env->startSection('title'); ?>
Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Products & Services
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Products</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header br-0">
                Price Range
            </div>
            <div class="card-body">
                <input type="range" class="form-range" min="0" max="500" step="0.5" id="customRange3">
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header br-0">
                Category's
            </div>
            <div class="card-body">
                <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        <?php echo e($category->name); ?>

                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="btn-block input-group mb-3">
            <input type="search" id="form1" placeholder="Search..." class="market-form-input form-control" />
        </div>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 mb-3">
                    <div class="card">
                        <img src="<?php echo e($product->logo); ?>" width="200" height="130" alt="Image" />
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/products/index.blade.php ENDPATH**/ ?>