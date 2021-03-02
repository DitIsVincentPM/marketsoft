



<?php $__env->startSection('title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Knowledgebase</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <?php $__currentLoopData = $knowledgebases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $knowledgebase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-11" style="width: 95%;">
                    <h5 class="market-text-break announcement-title"><?php echo e($knowledgebase->name); ?><br><small><?php echo $knowledgebase->description; ?></small></h5>
                </div>
                <div class="col-1" style="width: 5%;">
                    <a style="position: absolute;top: 50%;transform: translateY(-50%);" class="pull-right market-text-primary" href="<?php echo e(route('knowledgebase.articel.view', $knowledgebase->id)); ?>" title="Read More"><i class="pull-right" data-feather="eye"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Knowledgebase/category.blade.php ENDPATH**/ ?>