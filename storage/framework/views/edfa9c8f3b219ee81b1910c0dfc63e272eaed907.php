



<?php $__env->startSection('title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
<div class="container mb-3">
    <?php echo e($knowledgebase->name); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Knowledgebase</li>
    <li class="breadcrumb-item">#<?php echo e($knowledgebase->id); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-5 mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body br-0">
                <div class="text-center" style="font-size: 24px;">
                    <?php echo $knowledgebase->description; ?>

                </div>
            </div>
            <div class="card-footer br-0">
                <div class="pull-left">Created On: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $knowledgebase->created_at)->format('m/d/Y')); ?></div>
                <div class="pull-right">Total Views: <?php echo e($knowledgebase->views); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<div class="text-center mt-3 mb-3">
    <p>This Website is Powered by <a href="https://marketsoft.io">MarketSoft.io</a></p>
</div>
<footer class="footer-bg text-center text-lg-start">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">Footer Content</h5>

        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
          molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
          voluptatem veniam, est atque cumque eum delectus sint!
        </p>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Links</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="#!" class="text-dark">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 4</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-0">Links</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!" class="text-dark">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-dark">Link 4</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-bg text-center p-3">
    Copyright © <?php echo e(date("Y")); ?>:
    <a class="text-dark" href="<?php echo e(route('index')); ?>"><?php echo e($companyname); ?></a>
  </div>
</footer>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Knowledgebase/view.blade.php ENDPATH**/ ?>