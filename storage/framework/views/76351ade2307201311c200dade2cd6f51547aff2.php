<a style="background-color: #3f435a !important;" class="btn-sm text-center list-group-item list-group-item-action">
    <span class="text-center">Settings</span>
</a>
<a id="tab-button" data-name="general" onClick="change('general')" style="<?php if($check[0] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" class="list-group-item list-group-item-action active">
    <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">General</span>
</a>
<a onClick="change('mail')" style="<?php if($check[1] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="mail" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="mail" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Mail</span>
</a>
<a onClick="change('modules')" style="<?php if($check[2] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="modules" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="box" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Modules</span>
</a>
<a onClick="change('addons')" style="<?php if($check[3] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="addons" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="upload" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Addons</span>
</a>
<a onClick="change('themes')" style="<?php if($check[4] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="themes" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="layout" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Themes</span>
</a>
<a onClick="change('roles')" style="<?php if($check[5] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="roles" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="bookmark" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Roles</span>
</a>
<a onClick="change('legal')" style="<?php if($check[6] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="legal" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="book" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">Legal Documents</span>
</a>
<a onClick="change('oauth2')" style="<?php if($check[7] !=true): ?> display: none; <?php endif; ?> cursor: pointer;" id="tab-button" data-name="oauth2" class="list-group-item list-group-item-action">
    <i style="width: 16px;" data-feather="share-2" class="mr-1"></i>
    <span style="margin-left: 2%; position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">OAuth2 Settings</span>
</a>
<br><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/sidebar.blade.php ENDPATH**/ ?>