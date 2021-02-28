



<?php $__env->startSection('title'); ?>
    Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-breadcrumb'); ?>
    <ol class="justify-content-center market-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="primary-section ">
        <?php if($version[1] == 'alert-danger'): ?>
            <div class="mb-3 alert alert-danger alert-dismissible fade show mt-3" role="alert">
                Oh no! It seems like your running an old version of marketsoft please update to the newest version!
                <button type="button" hidden class="btn btn-danger btn-sm right v-center">Update</button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>Currently there <?php echo app('translator')->choice('is|are',$users_online); ?> <strong><?php echo e($users_online); ?>

                                <?php echo app('translator')->choice('User|Users',$users_online); ?></strong> on the site!</p>
                        <span class="right v-center icon-admin" data-feather="<?php echo app('translator')->choice('user|users',$users_online); ?>"></span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>TOTAL SALES</strong></h4>
                        <p><?php echo e(DB::table('ca_ownedProducts')->count()); ?></p>
                        <span class="right v-center icon-admin" data-feather="shopping-bag"></span>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4><strong>TOTAL USERS</strong></h4>
                        <p><?php echo e(DB::table('users')->count()); ?></p>
                        <span class="right v-center icon-admin" data-feather="users"></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4><strong>MONTLY REVENUE</strong></h4>
                        <p>$0</p>
                        <span class="right v-center icon-admin" data-feather="credit-card"></span>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4><strong>OPEN TICKETS</strong></h4>
                        <p><?php echo e(DB::table('tickets')->where('status', '!=', 3)->count()); ?></p>
                        <span class="right v-center icon-admin" data-feather="file"></span>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <canvas id="chart"></canvas>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Users Online
                    </div>
                    <div class="card-body">
                        <?php $s = 0; ?>
                        <?php $__empty_1 = true; $__currentLoopData = $active_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($a_user->user_id == $user->id): ?>
                                    <?php if(Permission::is_admin($user->role_id) == false): ?>
                                        <div class="col-4 justift-content-center text-center">
                                            <img src="<?php echo e($user->profile_picture); ?>" width="100px" height="100px"
                                                class="rounded-circle" />
                                            <br>
                                            <div>
                                                <p>
                                                <div class="demo-up">
                                                    <span class="server-status" type="up"></span>
                                                    <span><?php echo e($user->name); ?></span>
                                                    <br>
                                                    <small><?php echo e(Permission::getRole($user->role_id)->name); ?></small>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                        <?php $s = $s + 1; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($s == 0): ?>
                                <div class="col-12">
                                    <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1" role="alert">
                                        Currently there are <strong>0 members</strong> online!
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Staff Online
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php $x = 0; ?>
                                <?php $__currentLoopData = $admins_online; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($a_user->user_id == $user->id): ?>
                                            <?php if(Permission::is_admin($user->role_id) == true): ?>
                                                <div class="col-4 justift-content-center text-center">
                                                    <img src="<?php echo e($user->profile_picture); ?>" width="100px" height="100px"
                                                        class="rounded-circle" />
                                                    <br>
                                                    <div>
                                                        <p>
                                                        <div class="demo-up">
                                                            <span class="server-status" type="up"></span>
                                                            <span><?php echo e($user->name); ?></span>
                                                            <br>
                                                            <small><?php echo e(Permission::getRole($user->role_id)->name); ?></small>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php $x = $x + 1; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($x == 0): ?>
                                    <div class="col-12">
                                        <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1" role="alert">
                                            Currently there are <strong>0 staff members</strong> online!
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
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
                            fontColor: 'white'
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'white'
                            },
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: 'white'
                            },
                        }]
                    }
                }
            });

        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/dashboard.blade.php ENDPATH**/ ?>