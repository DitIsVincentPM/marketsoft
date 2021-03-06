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
        <h1 class="login-title text-center">Login with Email Address</h1>
        <form method="POST" action="<?php echo e(route('auth.login.new')); ?>">
            <div class="form-group">
                <label for="email" class="pb-2">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password" class="pb-2">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
        <?php if(Settings::key('GoogleStatus') != 0 or Settings::key('DiscordStatus') != 0 or Settings::key('GithubStatus') != 0): ?>
            <div class="title-heading">
                <span>Or Login With...</span>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <?php if(Settings::key('DiscordStatus') == 1): ?>
                <div class="col-4">
                    <a href="<?php echo e(route('discord.redirect')); ?>">
                        <button class="btn btn-discord justify-content-center w-100">
                            <i class="fab fa-discord" style="margin-right: 5px!important;"></i> Discord
                        </button>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(Settings::key('GoogleStatus') == 1): ?>
                <div class="col-4">
                    <a href="<?php echo e(route('google.redirect')); ?>">
                        <button class="btn btn-google justify-content-center w-100">
                            <i class="fab fa-google" style="margin-right: 5px!important;"></i> Google
                        </button>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(Settings::key('GithubStatus') == 1): ?>
                <div class="col-4">
                    <a href="<?php echo e(route('github.redirect')); ?>">
                        <button class="btn btn-github justify-content-center w-100">
                            <i class="fab fa-github" style="margin-right: 5px!important;"></i> GitHub
                        </button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Authentication/login.blade.php ENDPATH**/ ?>