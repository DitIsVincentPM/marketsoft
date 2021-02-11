



<?php $__env->startSection('title'); ?>
Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-3">
    <div class="list-group col-3">
        <a onClick="change(0)" style="cursor: pointer;" id="general-button" class="list-group-item list-group-item-action active" aria-current="true">
            <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">General Settings</span>
        </a>
        <a onClick="change(1)" style="cursor: pointer;" id="mail-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="mail" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Mail Settings</span>
        </a>
        <a onClick="change(2)" style="cursor: pointer;" id="module-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="box" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Module Settings</span>
        </a>
        <a onClick="change(4)" style="cursor: pointer;" id="addon-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="upload" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Addon Settings</span>
        </a>
        <a onClick="change(5)" style="cursor: pointer;" id="theme-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="layout" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Theme Settings</span>
        </a>
        <a onClick="change(3)" style="cursor: pointer;" id="other-button" class="list-group-item list-group-item-action">
            <i style="width: 16px;" data-feather="bookmark" class="mr-1"></i>
            <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Other Settings</span>
        </a>
    </div>
    
    <div style="display: block;" class="col-9" id="general">
        <form enctype="multipart/form-data" method="POST" action="<?php echo e(route('admin.settings.save')); ?>">
            <input hidden name="type" value="general"></input>
            <?php echo csrf_field(); ?>
            <div class="card">
                <div class="card-header">
                    General Settings
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="companyname" value="<?php echo e($settings->CompanyName); ?>">
                            <div class="form-text">Putt the name here the name that will show everywhere as you company name.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label for="exampleInputEmail1" class="form-label">Company Logo</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" value="<?php echo e($settings->CompanyLogo); ?>" class="form-control" readonly>
                                    <div class="input-group-btn">
                                        <span class="fileUpload btn btn-primary">
                                            <span type="button" class="upl" id="upload">Upload</span>
                                            <input id="image" type="file" name="companylogo" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">This will be your logo that will be used in the navbar.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label class="form-label">Navbar Icon</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="navbaricon" class="form-control">
                                        <option <?php if($settings->NavbarIcon == 0): ?> selected <?php endif; ?> value="0">Company Name</option>
                                        <option <?php if($settings->NavbarIcon == 1): ?> selected <?php endif; ?> value="1">Company Logo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-text">For turning on company logo or text.</div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-12"><br>
                            <label class="form-label">Company Favicon</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" value="<?php echo e($settings->CompanyFavicon); ?>" class="form-control" readonly>
                                    <div class="input-group-btn">
                                        <span class="fileUpload btn btn-primary">
                                            <span type="button" class="upl" id="upload">Upload</span>
                                            <input id="image" type="file" name="faviconlogo" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">This will be your logo that will be used in the navbar.</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    
    <div style="display: none;" class="col-9" id="mail">
        <div class="card">
            <div class="card-header">
                Mail Settings
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="exampleInputEmail1" class="form-label">Mail:</label>
                        <input type="text" class="form-control" name="mail" value="<?php echo e($settings->Email); ?>">
                        <div class="form-text">Enter your website support email here.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div style="display: none;" class="col-9" id="module">
        <div class="card">
            <div class="card-header">
                Module Settings
            </div>
        </div>
    </div>

    
    <div style="display: none;" class="col-9" id="addon">
        <div class="card mb-3">
            <div class="card-header">
                Addon Settings
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            This feature has not been released yet. Please stay tuned for updates.
        </div>
        <?php for($i=0; $i < count($addons); $i++): ?> 
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <p class="mb-0 mt-1 pull-left"><?php echo e($addons[$i]["name"]); ?> <small>(V<?php echo e($addons[$i]["version"]); ?>)</small></p>
                <?php if($addons[$i]["enabled"] == true): ?>
                <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
                <?php else: ?>
                <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php echo e($addons[$i]["description"]); ?>

            </div>
    </div>
    <?php endfor; ?>
    </div>

    
    <div style="display: none;" class="col-9" id="theme">
        <div class="card mb-3">
            <div class="card-header">
                Theme Settings
            </div>
        </div>
        <div class="alert alert-primary" role="alert">
            This feature has not been released yet. Please stay tuned for updates.
        </div>
        <?php for($i=0; $i < count($themes); $i++): ?> 
        <div class="card mt-3 mb-3">
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
    <?php endfor; ?>
</div>


<div style="display: none;" class="col-9" id="other">
    <div class="card">
        <div class="card-header">
            Other Settings
        </div>
        <div class="card-body">

        </div>
    </div>
</div>
</div>

<script>
    document.onload = check;
    function check() {
        var url = window.location.href;
        console.log(url.lastIndexOf('#'));
        var id = url.substring(url.lastIndexOf('#') + 1);
        if (id == "general") {
            id = 0;
        } else if (id == "mail") {
            id = 1;
        } else if (id == "module") {
            id = 2;
        } else if (id == "other") {
            id = 3;
        } else if (id == "addon") {
            id = 4;
        } else if (id == "theme") {
            id = 5;
        }
        change(id);
    }
</script>
<script>
    function change(number) {
        if (number == 0) {
            document.getElementById('general').style.display = "block";
            document.getElementById('mail').style.display = "none";
            document.getElementById('module').style.display = "none";
            document.getElementById('addon').style.display = "none";
            document.getElementById('theme').style.display = "none";
            document.getElementById('other').style.display = "none";

            document.getElementById('general-button').classList.add('active');
            document.getElementById('mail-button').classList.remove('active');
            document.getElementById('module-button').classList.remove('active');
            document.getElementById('addon-button').classList.remove('active');
            document.getElementById('theme-button').classList.remove('active');
            document.getElementById('other-button').classList.remove('active');
        } else if (number == 1) {
            document.getElementById('general').style.display = "none";
            document.getElementById('mail').style.display = "block";
            document.getElementById('module').style.display = "none";
            document.getElementById('addon').style.display = "none";
            document.getElementById('theme').style.display = "none";
            document.getElementById('other').style.display = "none";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('mail-button').classList.add('active');
            document.getElementById('module-button').classList.remove('active');
            document.getElementById('addon-button').classList.remove('active');
            document.getElementById('theme-button').classList.remove('active');
            document.getElementById('other-button').classList.remove('active');
        } else if (number == 2) {
            document.getElementById('general').style.display = "none";
            document.getElementById('mail').style.display = "none";
            document.getElementById('module').style.display = "block";
            document.getElementById('addon').style.display = "none";
            document.getElementById('theme').style.display = "none";
            document.getElementById('other').style.display = "none";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('mail-button').classList.remove('active');
            document.getElementById('module-button').classList.add('active');
            document.getElementById('addon-button').classList.remove('active');
            document.getElementById('theme-button').classList.remove('active');
            document.getElementById('other-button').classList.remove('active');
        } else if (number == 3) {
            document.getElementById('general').style.display = "none";
            document.getElementById('mail').style.display = "none";
            document.getElementById('module').style.display = "none";
            document.getElementById('addon').style.display = "none";
            document.getElementById('theme').style.display = "none";
            document.getElementById('other').style.display = "block";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('mail-button').classList.remove('active');
            document.getElementById('module-button').classList.remove('active');
            document.getElementById('addon-button').classList.remove('active');
            document.getElementById('theme-button').classList.remove('active');
            document.getElementById('other-button').classList.add('active');
        } else if (number == 4) {
            document.getElementById('general').style.display = "none";
            document.getElementById('mail').style.display = "none";
            document.getElementById('module').style.display = "none";
            document.getElementById('addon').style.display = "block";
            document.getElementById('theme').style.display = "none";
            document.getElementById('other').style.display = "none";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('mail-button').classList.remove('active');
            document.getElementById('module-button').classList.remove('active');
            document.getElementById('addon-button').classList.add('active');
            document.getElementById('theme-button').classList.remove('active');
            document.getElementById('other-button').classList.remove('active');
        } else if (number == 5) {
            document.getElementById('general').style.display = "none";
            document.getElementById('mail').style.display = "none";
            document.getElementById('module').style.display = "none";
            document.getElementById('addon').style.display = "none";
            document.getElementById('theme').style.display = "block";
            document.getElementById('other').style.display = "none";

            document.getElementById('general-button').classList.remove('active');
            document.getElementById('mail-button').classList.remove('active');
            document.getElementById('module-button').classList.remove('active');
            document.getElementById('addon-button').classList.remove('active');
            document.getElementById('theme-button').classList.add('active');
            document.getElementById('other-button').classList.remove('active');
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('assets.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/admin/settings.blade.php ENDPATH**/ ?>