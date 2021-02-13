



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
<div class="pl-0 alert alert-primary" role="alert">
    Your running on version V<?php echo e($version); ?> of MarketSoft.
</div>
<div class="row mt-3">
    <div class="col-3">
        <div class="list-group">
            <a onClick="change(0)" style="<?php if($check[0] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="general-button" class="list-group-item list-group-item-action active" aria-current="true">
                <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">General Settings</span>
            </a>
            <a onClick="change(1)" style="<?php if($check[1] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="mail-button" class="list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="mail" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Mail Settings</span>
            </a>
            <a onClick="change(2)" style="<?php if($check[2] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="module-button" class="list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="box" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Module Settings</span>
            </a>
            <a onClick="change(4)" style="<?php if($check[3] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="addon-button" class="list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="upload" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Addon Settings</span>
            </a>
            <a onClick="change(5)" style="<?php if($check[4] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="theme-button" class="list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="layout" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Theme Settings</span>
            </a>
            <a onClick="change(3)" style="<?php if($check[5] != true): ?> display: none; <?php endif; ?> cursor: pointer;" id="other-button" class="list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="bookmark" class="mr-1"></i>
                <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Roles Settings</span>
            </a>
        </div>
    </div>

    
    <div style="display: block;" class="col-9" id="general">
    <?php if($check[0] == true): ?>
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
    <?php endif; ?>
    </div>

    
    <div style="display: none;" class="col-9" id="mail">
    <?php if($check[1] == true): ?>
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
    <?php endif; ?>
    </div>

    
    <div style="display: none;" class="col-9" id="module">
    <?php if($check[2] == true): ?>
        <div class="card mb-3">
            <div class="card-header">
                Module Settings
            </div>
        </div>
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <p class="mb-0 mt-1 pull-left"><?php echo e($module->name); ?></p>
                <?php if($module->is_enabled == 1): ?>
                <button class="pull-right md-0 mt-0 btn-sm btn btn-success">Enable</button>
                <?php else: ?>
                <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Disable</button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php echo e($module->description); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </div>

    
    <div style="display: none;" class="col-9" id="addon">
    <?php if($check[3] == true): ?>
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
                <button class="pull-right md-0 mt-0 btn-sm btn btn-danger">Remove</button>
            </div>
            <div class="card-body">
                <?php echo e($addons[$i]["description"]); ?>

            </div>
        </div>
        <?php endfor; ?>
    <?php endif; ?>
</div>


<div style="display: none;" class="col-9" id="theme">
<?php if($check[4] == true): ?>
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
<?php endfor; ?>
<?php endif; ?>
</div>


<div style="display: none;" class="col-9" id="other">
<?php if($check[5] == true): ?>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 mt-2 pull-left">Roles Settings</h5>
            <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createrole">Create New</button>
        </div>
        <table class="table table-striped mb-0 text-center">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><i style="width: 20px;" data-feather="tool"></i></td> 
                    <td>Administrator</td>
                    <td>Has all permissions to management dashboard.</td>
                    <td><span style="color: #eb4034 !important;">#eb4034</span></td>
                    <td><a href="" data-bs-toggle="modal" data-bs-target="#editrole"><i style="width: 20px;" data-feather="edit"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="createrole" tabindex="-1" aria-labelledby="createroleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createroleLabel">Create new System Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Name:</label>
                        <input type="text" class="form-control" placeholder="Administrator">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Icon:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="msgbox" data-feather="search"></i></span>
                                    <select class="form-select" id="icons">
                                        <option selected>Select an Icon</option>
                                        <?php for($x = 0; $x <= count($icons) - 1; $x++): ?> 
                                        <option value="<?php echo e($icons[$x]); ?>"><?php echo e($icons[$x]); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-text">This software is using <a href="https://feathericons.com/">feather icons</a>. Learn more on their site.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Color:</label>
                                <input type="color" class="form-control colorpicker br-3" style="border: none;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php 
                    $group = NULL;
                    ?>

                    <div class="row">
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($group == NULL): ?>
                    <?php
                    $group = $permission->group;
                    ?>
                    <div class="col-12">
                        <hr class="mb-2">
                        <div class="form-check" style="font-size: 16px;">
                            <input class="form-check-input check" type="checkbox" value="" id="<?php echo e($permission->group); ?>_checkall">
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo e($permission->group); ?>:
                            </label>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <div class="col-4 mb-1">
                        <div class="form-check form-switch big-checkbox">
                            <input class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                        </div>
                    </div>
                    <?php elseif($group == $permission->group): ?>
                    <div class="col-4 mb-1">
                        <div class="form-check form-switch big-checkbox">
                            <input class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                        </div>
                    </div>
                    <?php elseif($group != $permission->group): ?>
                    <?php
                    $group = $permission->group;
                    ?>
                    <div class="col-12">
                        <hr class="mb-2 mt-2">
                        <div class="form-check" style="font-size: 16px;">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" id="<?php echo e($permission->group); ?>_checkall">
                                <?php echo e($permission->group); ?>:
                            </label>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <div class="col-4 mb-2">
                        <div class="form-check form-switch big-checkbox">
                            <input class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editrole" tabindex="-1" aria-labelledby="editroleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroleLabel">Edit Administrator Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Edit Role</button>
            </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>

</div>

<script>
$('#icons').change(function() {
    opt = $(this).val();
    $('#msgbox').attr("data-feather", opt);
    feather.replace();
})
</script>

<script>
<?php 
$group = NULL;
?>

<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($group == NULL): ?>
<?php
$group = $permission->group;
?>

$("#<?php echo e($permission->group); ?>_checkall").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});

<?php elseif($group == $permission->group): ?>
<?php elseif($group != $permission->group): ?>
<?php
$group = $permission->group;
?>

$("#<?php echo e($permission->group); ?>_checkall").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script>

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