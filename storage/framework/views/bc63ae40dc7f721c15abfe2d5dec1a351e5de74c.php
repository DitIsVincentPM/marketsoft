<div class="card mb-3">
    <div class="card-header">
        Theme Settings
    </div>
</div>
<div class="alert alert-primary" role="alert">
    This feature has not been released yet. Please stay tuned for updates.
</div>
<?php for($i=0; $i < count($themes); $i++): ?> <div class="card mt-3 mb-3">
    <div class="card-header">
        <p class="mb-0 mt-1 pull-left"><?php echo e($themes[$i]["name"]); ?> <small>(V<?php echo e($themes[$i]["version"]); ?>)</small></p>
        <?php if($themes[$i]["enabled"] == true): ?>
        <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
        <?php else: ?>
        <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php echo e($themes[$i]["description"]); ?>

    </div>
</div>
<?php endfor; ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/themes.blade.php ENDPATH**/ ?>