



<?php $__env->startSection('title'); ?>
    Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="pull-right market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="tab-content" data-name="ticket" style="display: block;">
        <div class="card shadow" id="loader">
            <div class="card-header">
                Tickets
                <div class="card-tools">
                    <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th><span class="pull-right">View</span></th>
                    </tr>
                </thead>
                <tbody id="table">

                </tbody>
            </table>
            <div class="card-footer" id="footer"></div>
        </div>
    </div>

    <div id="tab-content" data-name="category" style="display: none;">
        <div class="card shadow" id="loader2">
            <div class="card-header">
                Ticket Categories
                <div class="card-tools">
                    <button type="button" class="btn btn-tool animate-icon" data-bs-toggle="modal" data-bs-target="#createcategory">
                        <i class="far fa-plus-square"></i>
                    </button>
                    <button type="button" class="btn btn-tool animate-icon" onclick="refresh()" id="refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <table class="table mb-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody id="category-table">
                </tbody>
            </table>
            <div class="card-footer" id="c-footer"></div>
        </div>
    </div>

    <!-- Create New Category Modal -->
    <div class="modal fade" id="createcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createcategoryLabel">Create new Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('admin.category.create')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input name="name" type="text" class="form-control" placeholder="General Support">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Category Description</label>
                            <textarea placeholder="Support for just about anything on the website/software." name="description" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Create Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createcategoryLabel">Create new Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input id="name" type="text" class="form-control" placeholder="General Support">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Category Description</label>
                        <textarea placeholder="Support for just about anything on the website/software." id="description" class="form-control"></textarea>
                    </div>
                    <input id="id" hidden value=""></input>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="categoryupdate()" class="btn btn-secondary">Update Category</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/API/tickets.js"></script>
    <script src="/js/custom-tabs.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/Modules/TicketSystem/index.blade.php ENDPATH**/ ?>