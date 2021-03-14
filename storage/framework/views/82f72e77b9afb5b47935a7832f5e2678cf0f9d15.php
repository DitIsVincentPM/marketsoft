



<?php $__env->startSection('title'); ?>
    Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Tickets
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="tab-content" data-name="ticket" style="display: block;">
        <div class="row">
            <div class="col-10">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" placeholder="Search..." id="search" class="input-search admin-search-input form-control" />
                    </div>
                    <button onclick="some()" type="button" class="btn btn-primary">
                        <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                    </button>
                </div>
            </div>
            <div class="col-2">
                <button onclick="refresh()" style="font-size: 18px !important;" class="btn-lg btn btn-primary w-100">Reload</button>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="mb-0 mt-2">Tickets</h3>
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
                    <tr style="height: 200px;">
                        <th></th>
                        <th></th>
                        <th>
                            <div style="margin: 0; position: absolute; top: 55%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);" class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
            <div class="card-footer" id="footer"></div>
        </div>
    </div>

    <div id="tab-content" data-name="category" style="display: none;">
        <div class="row">
            <div class="col-10">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" placeholder="Search..." id="category-search" class="admin-search-input form-control" />
                    </div>
                    <button onclick="categorysome()" type="button" class="btn btn-primary">
                        <i style="width: 16px;" data-feather="search" class="mr-1"></i>
                    </button>
                </div>
            </div>
            <div class="col-2">
                <button onclick="categoryrefresh()" style="font-size: 18px !important;" class="btn-lg btn btn-primary w-100">Reload</button>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="mb-0 mt-1">Ticket Categories</h3>
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