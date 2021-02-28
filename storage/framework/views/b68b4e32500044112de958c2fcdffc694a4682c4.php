



<?php $__env->startSection('title'); ?>
Banned
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Banned User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Banned</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="alert alert-primary text-center" role="alert">
  Oh no! Administration has banned your account! Reach out to us at <?php echo e($settings->Email); ?> if you have questions or concerns about your ban.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/banned.blade.php ENDPATH**/ ?>