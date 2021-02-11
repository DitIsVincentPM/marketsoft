




<?php $__env->startSection('title'); ?>
New Ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Submit a Ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Submit a Ticket</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row justify-content-center">
        <div class="col-10">
            <form method="POST" action="<?php echo e(route('support.ticket.new.create')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="market-form-label form-label">Name:</label>
                        <input placeholder="John Doe" type="text" name="name" class="market-form-input form-control" <?php if(Auth::check()): ?> value="<?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>" <?php endif; ?>>
                        <div class="form-text">Use the Name attached to your account.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="market-form-label form-label">Email Address:</label>
                        <input placeholder="johndoe123@gmail.com" type="email" name="email" class="market-form-input form-control" <?php if(Auth::check()): ?> value="<?php echo e(Auth::user()->email); ?>" <?php endif; ?>>
                        <div class="form-text">Use the Email Address attached to your account.</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Category:</label>
                <select class="form-control market-form-input" name="category" aria-label="Default select example">
                    <?php $__currentLoopData = $ticket_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Priority:</label>
                <select class="form-control market-form-input" name="priority" aria-label="Default select example">
                    <option value="2">High</option>
                    <option value="1">Medium</option>
                    <option value="0" selected>Low</option>
                </select>
            </div>
            <div class="form-group">
                <label class="market-form-label form-label">Message:</label>
                <textarea placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="market-form-input form-control" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="float: right;">Submit Ticket</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/support/ticket/new.blade.php ENDPATH**/ ?>