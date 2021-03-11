<script>
    <?php if(Session::get('success') or Session::get('error') or Session::get('warning') or Session::get('info')): ?>
    window.onload = function () {
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "x",
        cancelButtonColor: "#dd6b55",
        timer: 4000,
        timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            <?php if($message = Session::get('success')): ?>
            icon: 'success',
            title: '<?php echo e($message); ?>'
            <?php elseif($message = Session::get('error')): ?>
            icon: 'error',
            title: '<?php echo e($message); ?>'
            <?php elseif($message = Session::get('warning')): ?>
            icon: 'warning',
            title: '<?php echo e($message); ?>'
            <?php elseif($message = Session::get('info')): ?>
            icon: 'info',
            title: '<?php echo e($message); ?>'
            <?php endif; ?>
        })
    };
    refresh();
    <?php endif; ?>

    function alert(alert) {
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "x",
        cancelButtonColor: "#dd6b55",
        timer: 4000,
        timerProgressBar: true,
        })

        Toast.fire({
            icon: alert[0],
            title: alert[1]
        })
    }
</script><?php /**PATH /var/www/softwarelol/resources/views/Vendor/alerts.blade.php ENDPATH**/ ?>