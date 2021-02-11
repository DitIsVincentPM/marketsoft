




<?php $__env->startSection('title'); ?>
Seller
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Seller Registration
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Seller</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="<?php echo e(route('auth.seller.new')); ?>">
            <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="market-form-label form-label">Full Name:</label>
                    <input placeholder="John Doe" type="text" name="name" class="market-form-input form-control">
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">Company Name:</label>
                    <input placeholder="Johns Development" type="text" name="company" class="market-form-input form-control">
                    <div class="form-text">If you aren't a part of a company or brand, put your full name again.</div>
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">Email Address:</label>
                    <input placeholder="johndoe123@gmail.com" type="email" name="email" class="market-form-input form-control">
                    <div class="form-text">Use your company email address, or personal if you don't belong to a company.</div>
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">Your Age:</label>
                    <input placeholder="25" type="number" name="age" class="market-form-input form-control">
                </div>
                <div class="form-group">
                    <label class="market-form-label form-label">What do you plan on selling?</label>
                    <textarea placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum." class="market-form-input form-control" name="selling"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Become a Seller</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/auth/seller.blade.php ENDPATH**/ ?>