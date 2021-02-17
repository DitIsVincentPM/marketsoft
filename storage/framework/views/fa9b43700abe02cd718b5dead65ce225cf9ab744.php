<?php $__env->startSection('title'); ?>
Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
User Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Login</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-5 justify-content-center">
    <div class="col-8">
        <form method="POST" action="<?php echo e(route('auth.login.new')); ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Authentication/login.blade.php ENDPATH**/ ?>