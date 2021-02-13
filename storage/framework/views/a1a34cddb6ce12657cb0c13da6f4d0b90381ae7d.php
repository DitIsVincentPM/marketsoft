



<?php $__env->startSection('title'); ?>
<?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
<?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(route('index.home')); ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Products</a></li>
    <li class="breadcrumb-item active"><a><?php echo e($product->name); ?></a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row">
        <div class="col-7">
            <div class="row product-gallery mx-1">
                <div class="col-12 mb-0">
                    <figure class="view overlay rounded z-depth-1 main-img">
                        <a data-fancybox="galleryTwo"><img src="<?php echo e($product->logo); ?>" alt="gallery-item" class="gallery-h-img popular-gallery"></a>

                    </figure>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="view overlay rounded z-depth-1 gallery-item">
                                <a class="gallery-square-img-wrapper" data-fancybox="galleryTwo"><img src="<?php echo e($product->logo); ?>" width="150" alt="gallery-item" class="gallery-h-img popular-gallery"></a>
                                <div class="mask rgba-white-slight"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="view overlay rounded z-depth-1 gallery-item">
                                <a class="gallery-square-img-wrapper" data-fancybox="galleryTwo"><img src="<?php echo e($product->logo); ?>" width="150" alt="gallery-item" class="gallery-h-img popular-gallery"></a>
                                <div class="mask rgba-white-slight"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="view overlay rounded z-depth-1 gallery-item">
                                <a class="gallery-square-img-wrapper" data-fancybox="galleryTwo"><img src="<?php echo e($product->logo); ?>" width="150" alt="gallery-item" class="gallery-h-img popular-gallery"></a>
                                <div class="mask rgba-white-slight"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <h1><?php echo e($product->name); ?></h1>
            <h4 class="mb-0 mt-3">$<?php echo e($product->price); ?></h4>
            <br>
            <?php echo $product->description; ?>

            <button class="mt-4 btn btn-primary btn-block">Add to shoppingcart</button>

            <div class="mt-5 accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How to use
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/products/view.blade.php ENDPATH**/ ?>