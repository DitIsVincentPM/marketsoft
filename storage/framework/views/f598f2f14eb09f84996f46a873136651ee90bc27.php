<div class="card">
    <div class="card-header">
        Mail Settings
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <label for="exampleInputEmail1" class="form-label">Mail:</label>
                <input type="text" class="form-control" name="mail" value="<?php echo e(Settings::where('key', 'SupportMail')->first()->value); ?>">
                <div class="form-text">Enter your website support email here.</div>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/mail.blade.php ENDPATH**/ ?>