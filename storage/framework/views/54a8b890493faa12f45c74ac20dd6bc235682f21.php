



<?php $__env->startSection('title'); ?>
Announcements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
<?php echo e($announcement->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Announcements</li>
    <li class="breadcrumb-item">#<?php echo e($announcement->id); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-12">
        <div class="text-center mb-5" style="font-size: 24px; color: #fff;">
            <?php echo $announcement->description; ?>

        </div>
        <div class="pull-left" style="color: #ccc;">Created On: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->format('m/d/Y')); ?></div>
        <div class="pull-right" style="color: #ccc;">Total Views: <?php echo e($announcement->views); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Announcements/view.blade.php ENDPATH**/ ?>