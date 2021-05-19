




<?php $__env->startSection('title'); ?>
Ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Ticket #<?php echo e($tickets->id); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active" aria-current="page">#<?php echo e($tickets->id); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="primary-section">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Ticket Information</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">Ticket ID: <?php echo e($tickets->id); ?></h5>
                        <h5 class="mb-3">
                            Category:
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($category->id == $tickets->category): ?>
                            <?php echo e($category->name); ?>

                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </h5>
                        <h5 class="mb-3">Created On: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y')); ?></h5>
                        <h5 class="mb-3">
                            Priority:
                            <?php if($tickets->priority == 0): ?>
                            Low Priority
                            <?php elseif($tickets->priority == 1): ?>
                            Medium Priority
                            <?php elseif($tickets->priority == 2): ?>
                            High Priority
                            <?php endif; ?>
                        </h5>
                        <h5 class="mb-0">
                            Status:
                            <?php if($tickets->status == 0): ?>
                            <span class="text-warning">Waiting Reply</span>
                            <?php elseif($tickets->status == 1): ?>
                            <span class="text-info">Replied</span>
                            <?php elseif($tickets->status == 2): ?>
                            <span class="text-success">Complete</span>
                            <?php elseif($tickets->status == 3): ?>
                            <span class="text-danger">Closed</span>
                            <?php endif; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <?php if($tickets->status == 3): ?>
                <?php else: ?>
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left mt-1">
                            Reply to the Ticket
                        </div>
                        <form method="POST" action="<?php echo e(route('ticket.new.reply', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Add Reply</button>
                            </div>
                    </div>
                    <div class="card-body" style="1.00rem">
                        <textarea style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="form-control ticket-reply-textbox" name="message"></textarea>
                    </div>
                    </form>
                </div>
                <?php endif; ?>
                <div id="comments">
                    <div class="card">
                        <div class="card-body" style="height: 200px;">
                            <div style="margin: 0; position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-left">
                                Sent By: <?php echo e(Auth::user()->firstname); ?> <?php echo e(Auth::user()->lastname); ?>

                            </div>
                            <div class="col-6 text-right">
                                Sent: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                <img class="center-image rounded-circle" width="55px" src="<?php echo e(Auth::user()->profile_picture); ?>">
                                <p class="pt-1">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->id == $tickets->user_id): ?>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role->id == $user->role_id): ?>
                                    <span style="color: <?php echo e($role->color); ?> !important;"><i style="width: 15px;" data-feather="<?php echo e($role->icon); ?>"></i> <?php echo e($role->name); ?></span>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                            <div class="col-10">
                                <?php echo e($tickets->message); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="ticket_id" value="<?php echo e($tickets->id); ?>" hidden></input>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="/js/API/ticket.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Modules/TicketSystem/view.blade.php ENDPATH**/ ?>