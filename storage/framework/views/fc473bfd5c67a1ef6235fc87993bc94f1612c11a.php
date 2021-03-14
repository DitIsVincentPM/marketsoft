<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol style="float: right;" class="market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="primary-section row">
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 mobile-text-center">
            <p class="text-left" style="top: -50%; transform: translateY(50%);">
            <h1><strong>WHAT IS <span class="text-uppercase nav-market">Market</span><span
                        class="text-uppercase nav-soft">Soft</span></strong></h1>
            <div class="col-xl-10 col-lg-10 col-mb-10 col-sm-12">
                <span>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros,
                    pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus.
                    Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex,
                    in pretium orci vestibulum eget. Class aptent taciti sociosqu ad
                    per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut
                    vestibulum. Maecenas ipsum lacus, lacinia quis posuere
                    Integer eu nibh at nisi ullamcorper sagittis id vel leo.
                    faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc.
                </span>
            </div>
            <a href="#" style="color: #1f8bfd; font-size: 15px; text-decoration: none;" class="text-uppercase">FIND OUT
                MORE</a>
            </p>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mobile-remove">
            <img src="/themes/default/icons/frontpage.svg" class="img-fluid" alt="...">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/index.blade.php ENDPATH**/ ?>