



<?php $__env->startSection('title'); ?>
Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Ticket #<?php echo e($tickets->id); ?></a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="primary-section">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0 mt-1 pull-left">Ticket Information</h4>
                        <?php if($tickets->status == 3): ?>
                            <form method="POST" action="<?php echo e(route('admin.tickets.delete', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                                <button type="submit" class="pull-right btn btn-danger btn-sm">Delete</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.tickets.open', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                                <button class="btn btn-success btn-sm pull-right" style="margin-right: 5px;">Open Ticket</button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.tickets.close', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                                <button class="btn btn-danger btn-sm pull-right">Close Ticket</button>
                            </form>
                        <?php endif; ?>
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
                            <span class="text-success">Open</span>
                            <?php elseif($tickets->status == 3): ?>
                            <span class="text-danger">Closed</span>
                            <?php endif; ?>
                        </h5>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <div class="pull-left mt-1">
                            Send a Admin Whisper
                        </div>
                        <form method="POST" action="<?php echo e(route('admin.tickets.whisper', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Send Whisper</button>
                            </div>
                    </div>
                    <div class="card-body" style="1.00rem">
                        <textarea style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="pull-left mt-1">
                            Reply to the Ticket
                        </div>
                        <form method="POST" action="<?php echo e(route('admin.tickets.reply', $tickets->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm">Add Reply</button>
                            </div>
                    </div>
                    <div class="card-body" style="1.00rem">
                        <?php if($tickets->status == 3): ?>
                            <textarea disabled style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                        <?php else: ?>
                            <textarea style="border-radius: 5px;" placeholder="Hello! I purchased an item on the website today and haven't recieved it in my account purchases for download. Can I recieve some assistance?" class="ticket-reply-textbox form-control" name="message"></textarea>
                        <?php endif; ?>
                    </div>
                    </form>
                </div>
                <?php
                $x = count($ticket_replies) +2;
                ?>
                <?php $__currentLoopData = $ticket_replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket_reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->id == $ticket_reply->user_id): ?>
                            <?php if($ticket_reply->is_whisper == 1): ?>
                                <div class="card shadow" style="background-color: #e0e0e0 !important;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-4">
                                                Admin Whisper
                                            </div>
                                            <div class="col-4">
                                                Sent By: <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?>

                                            </div>
                                            <div class="col-4 text-right">
                                                Sent: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket_reply->created_at)->format('m/d/Y')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <img class="center-image rounded-circle" width="55px" src="<?php echo e($user->profile_picture); ?>">
                                                <p class="pt-1">
                                                    <?php if($user->is_admin == 1): ?>
                                                    <span class="text-danger"><i style="width: 15px;" data-feather="tool"></i> Admin</span>
                                                    <?php elseif($user->is_seller == 1): ?>
                                                    <span class="text-warning"><i style="width: 15px;" data-feather="shopping-bag"></i> Seller</span>
                                                    <?php else: ?>
                                                    <span class="text-info"><i style="width: 15px;" data-feather="user"></i> Member</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="col-10">
                                                <p class="text-left" style="width: 87%;"><?php echo e($ticket_reply->message); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                            <?php
                            $x--
                            ?>
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-4">
                                                Reply: #<?php echo e($x); ?>

                                            </div>
                                            <div class="col-4">
                                                Sent By: <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?>

                                            </div>
                                            <div class="col-4 text-right">
                                                Sent: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket_reply->created_at)->format('m/d/Y')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <img class="center-image rounded-circle" width="55px" src="<?php echo e($user->profile_picture); ?>">
                                                <p class="pt-1">
                                                    <?php if($user->is_admin == 1): ?>
                                                    <span class="text-danger"><i style="width: 15px;" data-feather="tool"></i> Admin</span>
                                                    <?php elseif($user->is_seller == 1): ?>
                                                    <span class="text-warning"><i style="width: 15px;" data-feather="shopping-bag"></i> Seller</span>
                                                    <?php else: ?>
                                                    <span class="text-info"><i style="width: 15px;" data-feather="user"></i> Member</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="col-10">
                                                <p class="text-left" style="width: 87%;"><?php echo e($ticket_reply->message); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                Reply: #1
                            </div>
                            <div class="col-4">
                                Sent By: <?php echo e($tickets->name); ?>

                            </div>
                            <div class="col-4 text-right">
                                Sent: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tickets->created_at)->format('m/d/Y')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->id == $tickets->user_id): ?>
                                <img class="center-image rounded-circle" width="55px" src="<?php echo e($user->profile_picture); ?>">
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <p class="pt-1">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->id == $tickets->user_id): ?>
                                    <?php if($user->is_admin == 1): ?>
                                    <span class="text-danger"><i style="width: 15px;" data-feather="tool"></i> Admin</span>
                                    <?php elseif($user->is_seller == 1): ?>
                                    <span class="text-warning"><i style="width: 15px;" data-feather="shopping-bag"></i> Seller</span>
                                    <?php else: ?>
                                    <span class="text-info"><i style="width: 15px;" data-feather="user"></i> Member</span>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                            <div class="col-10">
                                <p class="text-left" style="width: 87%;"><?php echo e($tickets->message); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/admin/tickets/view.blade.php ENDPATH**/ ?>