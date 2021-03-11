<?php $__env->startSection('title'); ?>
    View Product #<?php echo e($product->id); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    View Product #<?php echo e($product->id); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL SALES</strong></h4>
                    <p>0</p>
                    <span class="right v-center icon-admin" data-feather="shopping-bag"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL VIEWS</strong></h4>
                    <p>0</p>
                    <span class="right v-center icon-admin" data-feather="users"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>TOTAL EARNINGS</strong></h4>
                    <p>$0</p>
                    <span class="right v-center icon-admin" data-feather="credit-card"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-mb-3 col-sm-6">
            <div style="background-color: #3f435a !important;" class="cursor-pointer btn-sm text-center list-group-item list-group-item-action">
                <span class="text-center">Settings</span>
            </div>
            <a id="tab-button" data-name="general" onClick="change('general')" class="cursor-pointer list-group-item list-group-item-action active">
                <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                <span class="tab-button">General</span>
            </a>
            <a id="tab-button" data-name="sections" onClick="change('sections')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="sliders" class="mr-1"></i>
                <span class="tab-button">Sections</span>
            </a>
            <a id="tab-button" data-name="images" onClick="change('images')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="image" class="mr-1"></i>
                <span class="tab-button">Images</span>
            </a>
            <a id="tab-button" data-name="modules" onClick="change('modules')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="box" class="mr-1"></i>
                <span class="tab-button">Modules</span>
            </a>
            <a id="tab-button" data-name="transaction" onClick="change('transaction')" class="cursor-pointer list-group-item list-group-item-action">
                <i style="width: 16px;" data-feather="credit-card" class="mr-1"></i>
                <span class="tab-button">Transactions</span>
            </a>
        </div>
        <div class="col-lg-9 col-mb-9 col-sm-6">
            <div style="display: block;" id="tab-content" data-name="general">
                <div class="card">
                    <div class="card-header">
                        General Settings
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo e($product->name); ?>">
                                <div class="form-text">Put the product name here.</div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="price" value="<?php echo e($product->price); ?>">
                                <div class="form-text">Put the product price here.</div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">Product Description</label>
                                <textarea type="text" class="form-control" name="description"><?php echo e($product->description); ?></textarea>
                                <div class="form-text">Put the product description here.</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm pull-right">Submit</button>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="sections">
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8 mt-1">
                                Sections
                            </div>
                            <div class="text-right col-4">
                                <button onclick="create_section()" class="btn btn-sm btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul id="sortable">
                        </ul>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="images">
                <form action="<?php echo e(route('admin.products.image', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <label class="form-label">Image Upload</label>
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input style="height: 40px!important;" type="text" value="Nothing yet." class="form-control" readonly>
                                        <div class="input-group-btn">
                                            <span class="fileUpload btn btn-primary">
                                                <span type="button" class="upl" id="upload">Upload</span>
                                                <input id="image" type="file" name="image" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-text">Here you can upload images to showcase on the product page.</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <button type="submit" class="btn btn-primary btn-sm pull-right">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <?php $__currentLoopData = $product->Images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-12 col-sm-12 mt-5">
                            <form action="" method="POST">
                                <img alt="Image #<?php echo e($image->id); ?> is not working" style="width: 100%; height: 100%; border-top-right-radius: 25px; border-top-left-radius: 25px;" src="/images/products/<?php echo e($image->image_url); ?>"></img>
                                <div class="card-header" style="height: 48px;">
                                    <p class="mt-1 pull-left">Image #<?php echo e($image->id); ?></p>
                                    <button class="btn btn-sm btn-danger pull-right">Remove</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="modules">
                <div class="default-tab">
                    <ul style="position: static !important;" class="nav nav-tabs" role="tablist">
                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo e($module->name); ?>"><?php echo e($module->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade" id="<?php echo e($module->name); ?>">
                                <div class="card">
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="tab-content" data-name="transaction">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        var config = {
            "id": "<?php echo e($product->id); ?>",
            "name": "<?php echo e($product->name); ?>",
        };

    </script>
    <script src="/js/custom-tabs.js"></script>
    <script>

    </script>
    <script src="/js/API/product.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Products/view.blade.php ENDPATH**/ ?>