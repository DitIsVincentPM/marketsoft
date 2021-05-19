



<?php $__env->startSection('title'); ?>
    Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="market-breadcrumb breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($version[1] == 'alert-danger'): ?>
        <div class="mb-3 alert alert-danger alert-dismissible fade show mt-3" role="alert">
            Oh no! It seems like your running an old version of marketsoft please update to the newest version!
            <button type="button" hidden class="btn btn-danger btn-sm right v-center">Update</button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card" id="loader">
                <div id="active_users" class="card-body">
                    <p class="mb-0">Loading...</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Sales</span>
                    <span class="info-box-number"><?php echo e(DB::table('ca_ownedProducts')->count()); ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-user-friends"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number"><?php echo e(DB::table('users')->count()); ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-warning" style="color: white !important;"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Monthly Revenue</span>
                    <span class="info-box-number">$0</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-comments"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Open Tickets</span>
                    <span class="info-box-number"><?php echo e(DB::table('tickets')->where('status', '!=', 3)->count()); ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-info" <?php if(DB::table('tickets')->where('status', '!=', 3)->count() != 0): ?>style="width: <?php echo e((DB::table('tickets')->where('status', '!=', 3)->count() /DB::table('tickets')->count()) * 100); ?>%"<?php endif; ?>></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Recently Added Products</h3>

                    <div class="card-tools">
                        <span title="<?php echo e(count($products)); ?> Products" class="badge badge-info"><?php echo e(count($products)); ?></span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="item">
                                <div class="product-img">
                                    <img src="/images/products/<?php echo e($product->Images[0]->image_url); ?>" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?php echo e($product->name); ?>

                                        <span class="badge badge-warning float-right">$<?php echo e($product->price); ?></span></a>
                                    <span class="product-description">
                                        <?php echo e(Shorten::string($product->description, 50)); ?>

                                    </span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('admin.products')); ?>" class="uppercase">View All Products</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins Online</h3>

                    <div class="card-tools">
                        <span title="<?php echo e(count($admins_online)); ?> Online admins" class="badge badge-info"><?php echo e(count($admins_online)); ?></span>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <?php $x = 0; ?>
                        <?php $__currentLoopData = $admins_online; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($a_user->user_id == $user->id): ?>
                                    <?php if(Permission::is_admin($user->role_id) == true): ?>
                                        <li class="item">
                                            <div class="icon-container product-img">
                                                <img class="admin-img img-size-50" alt="<?php echo e($user->name); ?>" src="<?php echo e($user->profile_picture); ?>" />
                                                <div class='status-circle'>
                                                    <div class="demo-up">
                                                        <span class="server-status" type="up"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title"><?php echo e($user->name); ?>

                                                    <span style="background-color: <?php echo e($user->Role->color); ?> !important; color: white;" class="badge float-right"><?php echo e($user->Role->name); ?></span></a>
                                                <span class="product-description">
                                                    <?php echo e($user->email); ?>

                                                </span>
                                            </div>
                                        </li>
                                        <?php $x = $x + 1; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo e(route('admin.users')); ?>" class="uppercase">View All Users</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Chart(document.getElementById("chart"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                    "October", "November", "December"
                ],
                datasets: [{
                    data: [<?php echo e($newusers[0]); ?>, <?php echo e($newusers[1]); ?>, <?php echo e($newusers[2]); ?>,
                        <?php echo e($newusers[3]); ?>, <?php echo e($newusers[4]); ?>, <?php echo e($newusers[5]); ?>,
                        <?php echo e($newusers[6]); ?>, <?php echo e($newusers[7]); ?>, <?php echo e($newusers[8]); ?>,
                        <?php echo e($newusers[9]); ?>, <?php echo e($newusers[10]); ?>, <?php echo e($newusers[11]); ?>

                    ],
                    label: "New Users",
                    fill: true,
                    backgroundColor: 'rgba(62, 149, 205, 0.7)',
                    pointRadius: 0,
                    borderWidth: 1,
                    pointHitRadius: 20,
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                }, {
                    data: [<?php echo e($sales[0]); ?>, <?php echo e($sales[1]); ?>, <?php echo e($sales[2]); ?>,
                        <?php echo e($sales[3]); ?>, <?php echo e($sales[4]); ?>, <?php echo e($sales[5]); ?>,
                        <?php echo e($sales[6]); ?>, <?php echo e($sales[7]); ?>, <?php echo e($sales[8]); ?>,
                        <?php echo e($sales[9]); ?>, <?php echo e($sales[10]); ?>, <?php echo e($sales[11]); ?>

                    ],
                    label: "Sales",
                    fill: true,
                    backgroundColor: 'rgba(36, 123, 255, 0.7)',
                    pointRadius: 0,
                    pointHitRadius: 20,
                    borderWidth: 1,
                    borderColor: 'rgba(0, 0, 0, 0.2)',
                }]
            },
            options: {
                legend: {
                    labels: {
                        fontColor: 'black'
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'black'
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: 'black'
                        },
                    }]
                }
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="/js/API/active_users.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/dashboard.blade.php ENDPATH**/ ?>