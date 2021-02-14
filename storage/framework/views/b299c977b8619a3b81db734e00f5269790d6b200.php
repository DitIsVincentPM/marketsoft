



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
                <div class="col-12">
                    <div class="card br-0">
                        <div class="row">
                            <div class="products-logo col-2 justify-content-center text-center">
                                <img src="<?php echo e($product->logo); ?>" width="100%" height="80px">
                                <p class="pt-1">
                                    (5)
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                    <i class="products-star" data-feather="star"></i>
                                </p>
                            </div>
                            <div class="col-10 products-description">
                                <a href="" class="product-name"><h4 class="product-name"><?php echo e($product->name); ?></h4></a>
                                <h5 class="market-text-break"><?php echo e($product->description); ?></h5>
                                <div class="row">
                                    <div class="col-4 text-left">
                                        Purchases: <?php echo e($product->purchases); ?>

                                    </div>
                                    <div class="col-4 text-center">
                                        Downloads: <?php echo e($product->downloads); ?>

                                    </div>
                                    <div class="col-4 text-right">
                                        Views: <?php echo e($product->views); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<script>
$('.owl-carousel').owlCarousel({
    margin:10,
    nav:true,
    items:3,
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Products/index.blade.php ENDPATH**/ ?>