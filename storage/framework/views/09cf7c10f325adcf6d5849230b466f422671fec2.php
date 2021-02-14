



<?php $__env->startSection('title'); ?>
Announcements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Announcements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Info</a></li>
    <li class="breadcrumb-item active" aria-current="page">Announcements</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row">
        <div class="col-12">
            <?php if(count($announcements) == 0): ?>
                <div class="alert alert-primary text-center" role="alert">
                    There are currently zero announcements to display
                    <?php if(Auth::user()->is_admin): ?>
                    <a class="ml-1" href="<?php echo e(route('admin.announcements')); ?>">(Get Started)</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1 text-center" style="width: 5%;">
                                <p class="market-text-break announcement-title mb-0"><?php echo e($announcement->id); ?></p>
                            </div>
                            <div class="col-4">
                                <h5 class="market-text-break announcement-title"><?php echo e($announcement->name); ?></h5>
                            </div>
                            <div class="col-4 market-text-break">
                                <p class="announcement-description"><?php echo $announcement->description; ?></p>
                            </div>
                            <div class="col-2">
                                <p class="market-text-break announcement-date"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->format('m/d/Y')); ?></p>
                            </div>
                            <div class="col-1 text-center">
                                <a class="market-text-primary" href="<?php echo e(route('announcements.view', $announcement->id)); ?>" title="Read More"><i data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Announcements/index.blade.php ENDPATH**/ ?>