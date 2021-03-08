



<?php $__env->startSection('title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Knowledgebase</li>
</ol>
<div class="row mt-4">
    <div class="col-12">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input type="search" placeholder="Search..." id="search" class="input-search admin-search-input form-control" style="width: 700px!important;">
            </div>
            <button type="button" class="btn btn-light">
                <i style="width: 16px;" data-feather="search" class="mr-1"></i>
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="primary-section">
    <div class="row">
        <div class="col-6">
            <h2>Featured Articles:</h2>
            <?php $__currentLoopData = $featured_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="color: #ccc!important;">
                                            <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="bookmark"></i>
                                            <?php echo e(Shorten::string($featured_article->name, 50)); ?>

                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-6">
            <h2>Article Categories</h2>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Knowledgebase/index.blade.php ENDPATH**/ ?>