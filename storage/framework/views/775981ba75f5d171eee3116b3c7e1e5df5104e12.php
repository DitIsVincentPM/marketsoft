<div class="card mb-3">
    <div class="card-header">
        Module Settings
    </div>
</div>
<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form action="<?php echo e(route('admin.modules.toggle', $module->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <p class="mb-0 mt-1 pull-left"><?php echo e($module->name); ?></p>
                <?php if($module->status == 'enabled'): ?>
                    <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
                <?php else: ?>
                    <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php echo e($module->description); ?>

            </div>
        </div>
    </form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/modules.blade.php ENDPATH**/ ?>