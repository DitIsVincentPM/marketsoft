




<?php $__env->startSection('title'); ?>
Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Support Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Support Tickets</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(count($tickets) == 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="pull-left mb-0 mt-1">Your Tickets</h4>
                        <a href="<?php echo e(route('ticket.new')); ?>"><button class="pull-right btn btn-secondary btn-sm">Create New</button></a>
                    </div>
                    <div class="col-md-12 col-md-offset-2">
                        <div class="alert alert-primary text-center mt-3" role="alert">
                            You have 0 tickets attached to your account.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="pull-left mb-0 mt-1">Your Tickets</h4>
                        <a href="<?php echo e(route('ticket.new')); ?>"><button class="pull-right btn btn-secondary btn-sm">Create New</button></a>
                    </div>
                    <table class="table mb-0 text-center">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Message</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if (strlen($ticket->message) >= 20) {
                                $message_sized = substr($ticket->message, 0, 20). " ... ";
                                }
                                else {
                                $message_sized = $ticket->message;
                                }
                            ?>
                            <tr>
                                <td><?php echo e($ticket->id); ?></td>
                                <td><?php echo $message_sized; ?></td>
                                <td>
                                    <?php if($ticket->priority == 0): ?>
                                        Low Priority
                                    <?php elseif($ticket->priority == 1): ?>
                                        Medium Priority
                                    <?php elseif($ticket->priority == 2): ?>
                                        High Priority
                                    <?php endif; ?>
                                </td>
                                <td>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($category->id == $ticket->category): ?>
                                        <?php echo e($category->name); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('m/d/Y')); ?></td>
                                <?php if($ticket->status == 0): ?>
                                <td class="text-warning"> 
                                    Waiting Reply
                                </td>
                                <?php elseif($ticket->status == 1): ?>
                                <td class="text-info">
                                    Replied
                                </td>
                                <?php elseif($ticket->status == 2): ?>
                                <td class="text-success">
                                Complete
                                </td>
                                <?php elseif($ticket->status == 3): ?>
                                <td class="text-danger">
                                Closed
                                </td>
                                <?php endif; ?>
                                <td><a href="<?php echo e(route('ticket.view', $ticket->id)); ?>"><i data-feather="eye"></i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Modules/TicketSystem/ticket.blade.php ENDPATH**/ ?>