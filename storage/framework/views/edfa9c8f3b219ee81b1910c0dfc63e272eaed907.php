



<?php $__env->startSection('title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
<div class="container mb-3">
    <?php echo e($knowledgebase->name); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Knowledgebase</li>
    <li class="breadcrumb-item">#<?php echo e($knowledgebase->id); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-5 mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body br-0">
                <div class="text-center" style="font-size: 24px;">
                    <?php echo $knowledgebase->description; ?>

                </div>
            </div>
            <div class="card-footer br-0">
                <div class="pull-left">Created On: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $knowledgebase->created_at)->format('m/d/Y')); ?></div>
                <div class="pull-right">Total Views: <?php echo e($knowledgebase->views); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Knowledgebase/view.blade.php ENDPATH**/ ?>