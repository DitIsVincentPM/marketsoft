



<?php $__env->startSection('title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
Knowledgebase
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
<ol class="justify-content-center market-breadcrumb breadcrumb">
  <li class="breadcrumb-item"><a href="#">Admin</a></li>
  <li class="breadcrumb-item"><a href="#">Knowledgebase</a></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mt-5">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="mt-1 mb-0 pull-left">Categorys</h4>
        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#creatcategory">Create New</button>
      </div>
      <div class="card-body pb-0">
        <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mb-2">
          <div class="col-1 text-center">
            <p class="market-text-break announcement-title"><?php echo e($category->id); ?></p>
          </div>
          <div class="col-7">
            <h5 class="market-text-break announcement-title"><?php echo e($category->name); ?></h5>
          </div>
          <div class="col-2">
            <p class="market-text-break announcement-date"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->format('m/d/Y')); ?></p>
          </div>
          <div class="col-2 text-center">
            <form method="POST" action="<?php echo e(route('admin.knowledgebase.category.delete', $category->id)); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn btn-sm pull-right text-danger" title="Delete">
                <i data-feather="trash"></i>
              </button>
            </form>
            <button class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editcategory-<?php echo e($category->id); ?>">
              <i data-feather="edit-3"></i>
            </button>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <div class="card shadow mt-5">
      <div class="card-header">
        <h4 class="mt-1 mb-0 pull-left">Articles</h4>
        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#createarticle">Create New</button>
      </div>
      <div class="card-body pb-0">
        <?php $__currentLoopData = $knowledgebases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $knowledgebase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mb-2">
          <div class="col-1 text-center">
            <p class="market-text-break announcement-title"><?php echo e($knowledgebase->id); ?></p>
          </div>
          <div class="col-3">
            <h5 class="market-text-break announcement-title"><?php echo e($knowledgebase->name); ?></h5>
          </div>
          <div class="col-4 market-text-break">
            <p class="announcement-description"><?php echo $knowledgebase->description; ?></p>
          </div>
          <div class="col-2">
            <p class="market-text-break announcement-date"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $knowledgebase->created_at)->format('m/d/Y')); ?></p>
          </div>
          <div class="col-2 text-center">
            <form method="POST" action="<?php echo e(route('admin.knowledgebase.delete', $knowledgebase->id)); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn btn-sm pull-right text-danger" title="Delete">
                <i data-feather="trash"></i>
              </button>
            </form>
            <button class="btn btn-sm pull-right text-success" data-bs-toggle="modal" data-bs-target="#editknowledgebase-<?php echo e($knowledgebase->id); ?>">
              <i data-feather="edit-3"></i>
            </button>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="createarticle" tabindex="-1" aria-labelledby="createarticleLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createarticleLabel">Create New Article</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.knowledgebase.new')); ?>">
          <?php echo csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Article Title</label>
            <input name="name" type="text" class="form-control">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Article Description</label>
            <textarea name="description" class="summernote"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Articles Category</label>
            <select class="form-select" name="category">
              <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary pull-right">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php $__currentLoopData = $knowledgebases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $knowledgebase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editknowledgebase-<?php echo e($knowledgebase->id); ?>" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editknowledgebaseLabel">Edit Article for #<?php echo e($knowledgebase->id); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.knowledgebase.update', $knowledgebase->id)); ?>">
          <?php echo csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Articles Title</label>
            <input name="name" type="text" class="form-control" value="<?php echo e($knowledgebase->name); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Articles Description</label>
            <textarea name="description" class="summernote"><?php echo e($knowledgebase->description); ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Articles Category</label>
            <select class="form-select" name="category">
              <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option <?php if($category->id == $knowledgebase->category_id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary pull-right">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div class="modal fade" id="creatcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createarticleLabel">Create New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.knowledgebase.category.new')); ?>">
          <?php echo csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Category Title</label>
            <input name="name" type="text" class="form-control">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Category Description</label>
            <textarea name="description" class="summernote"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary pull-right">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editcategory-<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="editknowledgebaseLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editknowledgebaseLabel">Edit Category for #<?php echo e($category->id); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('admin.knowledgebase.category.update', $category->id)); ?>">
          <?php echo csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Category Title</label>
            <input name="name" type="text" class="form-control" value="<?php echo e($category->name); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Category Description</label>
            <textarea name="description" class="summernote"><?php echo e($category->description); ?></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary pull-right">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<footer class="bg-light text-center text-lg-start">
  <div class="text-center mt-3 mb-3">
    <p>Powered by <a href="https://marketsoft.io">MarketSoft.io</a></p>
  </div>
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
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright:
    <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
</footer>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/knowledgebase.blade.php ENDPATH**/ ?>