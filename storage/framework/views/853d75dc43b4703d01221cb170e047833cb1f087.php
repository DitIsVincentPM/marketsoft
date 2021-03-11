



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
<div class="row mt-5">
    <div class="col-12">
        <div class="input-group justify-content-center">
            <div class="form-outline">
                <input type="search" placeholder="Search..." id="search" class="input-search admin-search-input form-control" style="width: 700px!important;border-top-left-radius: 4px!important; border-bottom-left-radius: 4px!important;">
            </div>
            <button type="button" class="btn btn-search">
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
            <h2 class="mb-4">Featured Articles:</h2>
            <?php $__currentLoopData = $featured_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a class="article-title" href="<?php echo e(route('knowledgebase.article.view', $featured_article->id)); ?>">
                                            <h4 class="article-title mb-3">
                                                <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="bookmark"></i>
                                                <?php echo e(Shorten::string($featured_article->name, 50)); ?>

                                            </h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            Published on <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $featured_article->created_at)->format('m/d/Y')); ?>

                                        </h5>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($featured_article->category_id == $category->id): ?>
                                                    Posted in <a class="article-category" href=""><?php echo e($category->name); ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-6">
            <h2 class="mb-4">Article Categories:</h2>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a class="article-title" href="<?php echo e(route('knowledgebase.category', $category->id)); ?>">
                                            <h4 class="article-title mb-3">
                                                <i style="width: 20px;margin-right: 3px!important;margin-top: -3px!important;" data-feather="book"></i>
                                                <?php echo e(Shorten::string($category->name, 50)); ?>

                                            </h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            Created on <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('m/d/Y')); ?>

                                        </h5>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5 class="mb-0" style="color: #ccc!important;">
                                            <?php echo e(count($category->Articles)); ?> <?php echo app('translator')->choice('article|articles', count($category->Articles)); ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Knowledgebase/index.blade.php ENDPATH**/ ?>