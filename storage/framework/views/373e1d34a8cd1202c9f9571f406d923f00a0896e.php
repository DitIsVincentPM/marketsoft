



<?php $__env->startSection('title'); ?>
Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="pull-right market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <div class="pl-0 alert <?php echo e($version[1]); ?>" role="alert">
            <?php echo e($version[0]); ?>

        </div>
        
        <?php if($check[0] == true): ?>
            <div style="display: block;" id="tab-content" data-name="general">
                <?php echo $__env->make('Admin.Vendor.Settings.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>

        
        <?php if($check[1] == true): ?>
            <div style="display: none;" id="tab-content" data-name="mail">
                <?php echo $__env->make('Admin.Vendor.Settings.mail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>

        
        <?php if($check[2] == true): ?>
            <div style="display: none;" id="tab-content" data-name="modules">
                <?php echo $__env->make('Admin.Vendor.Settings.modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>

        
        <?php if($check[5] == true): ?>
            <div style="display: none;" id="tab-content" data-name="roles">
                <?php echo $__env->make('Admin.Vendor.Settings.roles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>

        
        <?php if($check[6] == true): ?>
            <div style="display: none;" id="tab-content" data-name="legal">
                <?php echo $__env->make('Admin.Vendor.Settings.legal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>

        
        <?php if($check[7] == true): ?>
            <div style="display: none;" id="tab-content" data-name="oauth2">
                <?php echo $__env->make('Admin.Vendor.Settings.oauth2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
<script>
    $('#icons').change(function() {
        opt = $(this).val();
        $('#msgbox').attr("data-feather", opt);
        feather.replace();
    })
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
    <?php
    $group = NULL;
    ?>

    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($group == NULL): ?>
    <?php
    $group = $permission->group;
    ?>

    $("#<?php echo e($permission->group); ?>_checkall").click(function() {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    <?php elseif($group == $permission->group): ?>
    <?php elseif($group != $permission->group): ?>
    <?php
    $group = $permission->group;
    ?>

    $("#<?php echo e($permission->group); ?>_checkall").click(function() {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/settings.blade.php ENDPATH**/ ?>