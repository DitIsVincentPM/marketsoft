
<?php $__env->startSection('charactercounter'); ?>
<?php
    if (strlen($products->description) >= 20) {
    $description_sized = substr($products->description, 0, 20). " ... ";
    }
    else {
    $description_sized = $products->description;
    }
?>
<?php $__env->stopSection(); ?><?php /**PATH /var/www/softwarelol/resources/views/Vendor/scripts.blade.php ENDPATH**/ ?>