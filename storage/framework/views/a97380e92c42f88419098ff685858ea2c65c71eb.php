<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Roles Settings</h5>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createrole">Create New</button>
    </div>
    <table class="table mb-0 text-center">
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
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><i style="width: 20px;" data-feather="<?php echo e($role->icon); ?>"></i></td>
                <td><?php echo e($role->name); ?></td>
                <td><?php echo e($role->description); ?></td>
                <td><span style="color: <?php echo e($role->color); ?> !important;"><?php echo e($role->color); ?></span></td>
                <td><a href="" data-bs-toggle="modal" data-bs-target="#editrole-<?php echo e($role->id); ?>"><i style="width: 20px;" data-feather="edit"></i></a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <form method="POST" action="<?php echo e(route('admin.role.create')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Administrator">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Allow anyone to do anything on the site">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Icon:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="msgbox" data-feather="search"></i></span>
                                    <select class="form-select" id="icons" name="icon">
                                        <option selected>Select an Icon</option>
                                        <?php for($x = 0; $x <= count($icons) - 1; $x++): ?> <option value="<?php echo e($icons[$x]); ?>"><?php echo e($icons[$x]); ?></option>
                                            <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-text">This software is using <a href="https://feathericons.com/">feather icons</a>. Learn more on their site.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Color:</label>
                                <input type="color" class="form-control colorpicker br-3" name="color" style="border: none;">
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
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                                </div>
                            </div>
                            <?php elseif($group == $permission->group): ?>
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
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
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
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
                <button type="submit" class="btn btn-secondary">Create Role</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editrole-<?php echo e($role->id); ?>" tabindex="-1" aria-labelledby="editroleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroleLabel">Edit Administrator Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('admin.role.create')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo e($role->name); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role Description:</label>
                        <input type="text" class="form-control" name="description" value="<?php echo e($role->description); ?>">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Icon:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="msgbox" data-feather="<?php echo e($role->icon); ?>"></i></span>
                                    <select class="form-select" id="icons" name="icon">
                                        <option selected>Select an Icon</option>
                                        <?php for($x = 0; $x <= count($icons) - 1; $x++): ?> <option <?php if($role->icon == $icons[$x]): ?> selected <?php endif; ?> value="<?php echo e($icons[$x]); ?>"><?php echo e($icons[$x]); ?></option>
                                            <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-text">This software is using <a href="https://feathericons.com/">feather icons</a>. Learn more on their site.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role Color:</label>
                                <input type="color" class="form-control colorpicker br-3" name="color" value="<?php echo e($role->color); ?>" style="border: none;">
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
                                    <?php $__currentLoopData = $role_perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role_perm->permission_id == $permission->id): ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    <?php else: ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                                </div>
                            </div>
                            <?php elseif($group == $permission->group): ?>
                            <div class="col-4 mb-1">
                                <div class="form-check form-switch big-checkbox">
                                <?php $__currentLoopData = $role_perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role_perm->permission_id == $permission->id): ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    <?php else: ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <?php $__currentLoopData = $role_perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role_perm->permission_id == $permission->id): ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" checked type="checkbox" id="flexSwitchCheckDefault">
                                    <?php else: ?>
                                    <input name="<?php echo e($permission->key); ?>" class="form-check-input check" type="checkbox" id="flexSwitchCheckDefault">
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <label class="form-check-label" for="flexSwitchCheckDefault" style="text-transform: capitalize;"><?php echo e($permission->key); ?></label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Edit Role</button>
            </div>
        </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/roles.blade.php ENDPATH**/ ?>