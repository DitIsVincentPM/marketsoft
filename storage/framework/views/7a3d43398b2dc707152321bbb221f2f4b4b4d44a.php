



<?php $__env->startSection('title'); ?>
    <?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    <?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Products</a></li>
        <li class="breadcrumb-item active"><a href="<?php echo e(route('products.view', $product->id)); ?>"><?php echo e($product->name); ?></a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="primary-section">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5">
                <div class="splide" id="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php $__currentLoopData = $product->Images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="splide__slide">
                                    <img style="width: 50%;" src="/images/products/<?php echo e($image->image_url); ?>" alt="Profile">
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div id="secondary-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php $__currentLoopData = $product->Images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="splide__slide">
                                    <img style="width: 50%;" src="/images/products/<?php echo e($image->image_url); ?>" alt="Profile">
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <h1 class="mt-sm-5 text-uppercase">Iphone lol</h1>
                <h4 class="text-secondary" style="color: #91959d !important;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo praesentium est porro unde architecto ipsum ad dolor voluptas a delectus. Illum sequi eos consectetur expedita. Aperiam ut saepe incidunt quisquam.</h4>
                <div class="row mt-2">
                    <div class="col-4">
                        <h1>$<?php echo e($product->price); ?></h1>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-warning">PURCHASE</button>
                    </div>
                    <div class="col-5">
                        <form method="POST" action="<?php echo e(route('products.view.add', $product->id)); ?>"><?php echo csrf_field(); ?>
                            <button class="btn btn-primary btn-block"><i class="fas fa-shopping-cart"></i></button>
                        </form>
                    </div>
                </div>
                <div data-name="SECTIONS" class="mt-3">
                    <?php $__currentLoopData = $product->Sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($section->type == 1): ?>
                            <div class="mt-3">
                                <h3><strong><?php echo e($section->name); ?></strong></h3>
                                <p><?php echo e($section->content); ?></p>
                            </div>
                        <?php elseif($section->type == 2): ?>
                            <div class="mt-3">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id-<?php echo e($section->id); ?>" aria-expanded="false" aria-controls="id-<?php echo e($section->id); ?>">
                                                <?php echo e($section->name); ?>

                                            </button>
                                        </h2>
                                        <div id="id-<?php echo e($section->id); ?>" class="accordion-collapse collapsed" data-bs-parent="#id-<?php echo e($section->id); ?>">
                                            <div class="accordion-body">
                                                <?php echo e($section->content); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <style>
        .splide__slide {
            text-align: center;
        }

        .splide--nav>.splide__track>.splide__list>.splide__slide.is-active {
            border-color: #0683ff !important;
            margin-top: 1rem;
        }

        .splide--nav>.splide__track>.splide__list>.splide__slide {
            margin-top: 1rem;
        }

        .splide__arrow svg {
            fill: #0683ff !important;
        }

        .splide__pagination__page.is-active {
            background: #0683ff !important
        }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var secondarySlider = new Splide('#secondary-slider', {
                fixedWidth: 100,
                fixedHeight: '7em',
                gap: 20,
                cover: true,
                isNavigation: true,
                focus: 'center',
            }).mount();
            var primarySlider = new Splide('#splide', {
                perPage: 1,
                autoplay: true,
                interval: 15000, // How long to display each slide
                type: 'fade',
                heightRatio: 0.5,
                pagination: false,
                arrows: false,
                cover: true,
            }).mount();
            primarySlider.sync(secondarySlider).mount();
        });

    </script>
    <script src="/js/API/shoppingcart.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Products/view.blade.php ENDPATH**/ ?>