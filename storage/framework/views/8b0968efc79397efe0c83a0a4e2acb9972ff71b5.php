<div class="card mb-3">
    <div class="card-header">
        Addon Settings
    </div>
</div>
<div class="alert alert-primary" role="alert">
    This feature has not been released yet. Please stay tuned for updates.
</div>
<?php for($i=0; $i < count($addons); $i++): ?> <div class="card mt-3 mb-3">
    <div class="card-header">
        <p class="mb-0 mt-1 pull-left"><?php echo e($addons[$i]["name"]); ?> <small>(V<?php echo e($addons[$i]["version"]); ?>)</small></p>
        <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Remove</button>
    </div>
    <div class="card-body">
        <?php echo e($addons[$i]["description"]); ?>

    </div>
</div>
<?php endfor; ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/addons.blade.php ENDPATH**/ ?>