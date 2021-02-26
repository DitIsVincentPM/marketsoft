<?php if($settings->tos_status == 0): ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Terms of Service</h5>
        <form action="<?php echo e(route('admin.tos.status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-success btn-sm pull-right">Enable</button>
        </form>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Terms of Service</h5>
        <form action="<?php echo e(route('admin.tos.status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger btn-sm pull-right">Disable</button>
        </form>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createtos" style="margin-right: 5px!important;">Create Section</button>
    </div>
    <table class="table text-center" style="margin-bottom: 0px!important;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $tos_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tos_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($tos_section->id); ?></td>
                    <td><?php echo e(Shorten::string($tos_section->title, 20)); ?></td>
                    <td><?php echo e(Shorten::string($tos_section->description, 45)); ?></td>
                    <td>
                        <form action="<?php echo e(route('admin.tos.section.delete', $tos_section->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#edittos<?php echo e($tos_section->id); ?>" class="btn btn-primary btn-sm pull-right" style="margin-right: 2px!important;">Edit</button>
                    </td>
                </tr>

                <div class="modal fade" id="edittos<?php echo e($tos_section->id); ?>" tabindex="-1" aria-labelledby="edittosLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="edittosLabel">Edit Section #<?php echo e($tos_section->id); ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="<?php echo e(route('admin.tos.create')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo e($tos_section->title); ?>">
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Section Description</label>
                                <textarea class="form-control" name="description" style="height: 100px"><?php echo e($tos_section->description); ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary">Edit Section</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createtos" tabindex="-1" aria-labelledby="createtosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createtosLabel">Create a Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(route('admin.tos.create')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Section Title</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" style="height: 100px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($settings->privacy_status == 0): ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Privacy Policy</h5>
        <form action="<?php echo e(route('admin.privacy.status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-success btn-sm pull-right">Enable</button>
        </form>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 mt-2 pull-left">Privacy Policy</h5>
        <form action="<?php echo e(route('admin.privacy.status')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger btn-sm pull-right">Disable</button>
        </form>
        <button class="btn btn-secondary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#createprivacy" style="margin-right: 5px!important;">Create Section</button>
    </div>
    <table class="table text-center" style="margin-bottom: 0px!important;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $privacy_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privacy_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($privacy_section->id); ?></td>
                    <td><?php echo e(Shorten::string($privacy_section->title, 20)); ?></td>
                    <td><?php echo e(Shorten::string($privacy_section->description, 45)); ?></td>
                    <td>
                        <form action="<?php echo e(route('admin.privacy.section.delete', $privacy_section->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm pull-right">Delete</button>
                        </form>
                        <button data-bs-toggle="modal" data-bs-target="#editprivacy<?php echo e($privacy_section->id); ?>" class="btn btn-primary btn-sm pull-right" style="margin-right: 2px!important;">Edit</button>
                    </td>
                </tr>

                <div class="modal fade" id="editprivacy<?php echo e($privacy_section->id); ?>" tabindex="-1" aria-labelledby="editprivacyLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editprivacyLabel">Edit Section #<?php echo e($privacy_section->id); ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="<?php echo e(route('admin.privacy.create')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo e($privacy_section->title); ?>">
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Section Description</label>
                                <textarea class="form-control" name="description" style="height: 100px"><?php echo e($privacy_section->description); ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary">Edit Section</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createprivacy" tabindex="-1" aria-labelledby="createprivacyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createprivacyLabel">Create a Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(route('admin.privacy.create')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Section Title</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" style="height: 100px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Vendor/Settings/legal.blade.php ENDPATH**/ ?>