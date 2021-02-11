



<?php $__env->startSection('title'); ?>
Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="primary-section">
        <div class="card shadow">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="mb-0 mt-2">Tickets</h3>
                </div>
                <div class="pull-right">
                    <select class="market-form-input form-control">
                        <option>Waiting Reply</option>
                        <option>Replied</option>
                        <option>Closed</option>
                    </select>
                </div>
            </div>
            <table class="table table-striped mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><b><?php echo e($ticket->id); ?></b></td>
                            <td><?php echo e($ticket->name); ?></td>
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
                                <?php if($ticket->status == 0): ?>
                                    <span class="text-primary">Waiting Reply</span>
                                <?php elseif($ticket->status == 1): ?>
                                    <span class="text-info">Replied</span>
                                <?php elseif($ticket->status == 2): ?>
                                    <span class="text-success">Complete</span>
                                <?php elseif($ticket->status == 3): ?>
                                    <span class="text-danger">Closed</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->format('m/d/Y')); ?></td>
                            <td><a href="<?php echo e(route('admin.tickets.view', $ticket->id)); ?>"><i data-feather="eye"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="card shadow">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="mb-0 mt-1">Ticket Categories</h3>
                </div>
                <div class="pull-right">
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#createcategory">Create New</button>
                </div>
            </div>
            <table class="table table-striped mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $ticket_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><b><?php echo e($category->id); ?></b></td>
                            <td><?php echo e($category->name); ?></td>
                            <td>
                            <?php echo e($category->description); ?>

                            </td>
                            <td><a class="text-primary" href="" data-bs-toggle="modal" data-bs-target="#editcategory<?php echo e($category->id); ?>"><i data-feather="edit"></i></a></td>
                            <td><a class="text-danger" href=""><i data-feather="trash"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create New Category Modal -->
<div class="modal fade" id="createcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createcategoryLabel">Create new Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.category.create')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input name="name" type="text" class="form-control" placeholder="General Support">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Category Description</label>
                <textarea placeholder="Support for just about anything on the website/software." name="description" class="form-control"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">Create Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $__currentLoopData = $ticket_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Edit Category <?php echo e($category->id); ?> Modal -->
<div class="modal fade" id="editcategory<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="editcategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editcategoryLabel">Edit Category #<?php echo e($category->id); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.category.update', $category->id)); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input name="name" type="text" class="form-control" value="<?php echo e($category->name); ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Category Description</label>
                <textarea name="description" class="form-control"><?php echo e($category->description); ?></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">Edit Category</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/admin/tickets.blade.php ENDPATH**/ ?>