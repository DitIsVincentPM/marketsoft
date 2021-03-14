



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
            <div class="card">
                <div id="active_users" class="card-body">
                    <p>Loading...</p>
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
                        <div class="progress-bar bg-info" style="width: <?php echo e(DB::table('tickets')->where('status', '!=', 3)->count() / DB::table('tickets')->count() * 100); ?>%"></div>
                    </div>
                    <span class="progress-description">
                        <?php echo e(round(DB::table('tickets')->where('status', '!=', 3)->count() / DB::table('tickets')->count() * 100, 0)); ?>% of the total tickets
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
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
                                    <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                        <div class='justify-content-center text-center icon-container'>
                                            <img class="admin-img" alt="<?php echo e($user->name); ?>" src="<?php echo e($user->profile_picture); ?>" width="100px" height="100px" />
                                            <div class='status-circle'>
                                                <div class="demo-up">
                                                    <span class="server-status" type="up"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p>
                                                <span><?php echo e($user->name); ?></span>
                                                <br>
                                                <small><?php echo e($user->Role->name); ?></small>
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
            <div class="col-lg-6 col-md-12 col-sm-12">
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
                                            <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                                <div class='justify-content-center text-center icon-container'>
                                                    <img class="admin-img" alt="<?php echo e($user->name); ?>" src="<?php echo e($user->profile_picture); ?>" width="100px" height="100px" />
                                                    <div class='status-circle'>
                                                        <div class="demo-up">
                                                            <span class="server-status" type="up"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <p>
                                                        <span><?php echo e($user->name); ?></span>
                                                        <br>
                                                        <small><?php echo e($user->Role->name); ?></small>
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
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {
                    'placeholder': 'mm/dd/yyyy'
                })
                //Money Euro
                $('[data-mask]').inputmask()

                //Date range picker
                $('#reservationdate').datetimepicker({
                    format: 'L'
                });
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })
                //Date range as a button
                $('#daterange-btn').daterangepicker({
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function(start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
                )

                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                });

                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                });

            })
            // BS-Stepper Init
            document.addEventListener('DOMContentLoaded', function() {
                window.stepper = new Stepper(document.querySelector('.bs-stepper'))
            });

            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false;

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                url: "/target-url", // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            });

            myDropzone.on("addedfile", function(file) {
                // Hookup the start button
                file.previewElement.querySelector(".start").onclick = function() {
                    myDropzone.enqueueFile(file);
                };
            });

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });

            myDropzone.on("sending", function(file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress").style.opacity = "1";
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            });

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
                document.querySelector("#total-progress").style.opacity = "0";
            });

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#actions .start").onclick = function() {
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
            };
            document.querySelector("#actions .cancel").onclick = function() {
                myDropzone.removeAllFiles(true);
            };
            // DropzoneJS Demo Code End

        </script>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>
        <script src="/js/API/active_users.js"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Vendor.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/softwarelol/resources/views/Admin/dashboard.blade.php ENDPATH**/ ?>