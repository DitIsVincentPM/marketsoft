



<?php $__env->startSection('title'); ?>
Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Browse Members
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Team</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row team-users-row justify-content-center">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-3">
            <div class="card mb-3">
                <div class="card-body">
                    <img class="team-users-profile profile-picture-users mb-2" src="<?php echo e($user->profile_picture); ?>">
                    <h5 class="team-users-name text-center" data-toggle="tooltip" data-placement="bottom" <?php if($user->is_admin == 1): ?> title="Administrator" <?php elseif($user->is_seller == 1): ?> title="Seller" <?php else: ?> title="Member" <?php endif; ?>>
                    <?php if($user->is_admin == 1): ?> 
                        <i style="width: 18px;" data-feather="tool"></i> <?php echo e($user->name); ?>

                    <?php elseif($user->is_seller == 1): ?>
                        <i style="width: 18px;" data-feather="shopping-bag"></i> <?php echo e($user->name); ?>

                    <?php else: ?>
                        <i style="width: 18px;" data-feather="user"></i> <?php echo e($user->name); ?>

                    <?php endif; ?>
                    </h5>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/team/users.blade.php ENDPATH**/ ?>