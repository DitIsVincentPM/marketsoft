{{-- Market Software --}}
{{-- Copyright (c) 2021 Market Software <support@marketsoftware.com> --}}
@extends('Vendor.admin')

@section('title')
    Admin
@endsection

@section('header-title')
    Dashboard
@endsection

@section('header-breadcrumb')
    <ol class="market-breadcrumb breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    @if ($version[1] == 'alert-danger')
        <div class="mb-3 alert alert-danger alert-dismissible fade show mt-3" role="alert">
            Oh no! It seems like your running an old version of marketsoft please update to the newest version!
            <button type="button" hidden class="btn btn-danger btn-sm right v-center">Update</button>
        </div>
    @endif
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div id="active_users" class="card-body">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
        {{-- <div class="form-group">
            <label>Minimal</label>
            <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
        </div> --}}
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Sales</span>
                    <span class="info-box-number">{{ DB::table('ca_ownedProducts')->count() }}</span>
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
                    <span class="info-box-number">{{ DB::table('users')->count() }}</span>
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
                    <span class="info-box-number">{{ DB::table('tickets')->where('status', '!=', 3)->count() }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ DB::table('tickets')->where('status', '!=', 3)->count() / DB::table('tickets')->count() * 100}}%"></div>
                    </div>
                    <span class="progress-description">
                        {{ round(DB::table('tickets')->where('status', '!=', 3)->count() / DB::table('tickets')->count() * 100, 0) }}% of the total tickets
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
                    @php $s = 0; @endphp
                    @forelse ($active_users as $a_user)
                        @foreach ($users as $user)
                            @if ($a_user->user_id == $user->id)
                                @if (Permission::is_admin($user->role_id) == false)
                                    <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                        <div class='justify-content-center text-center icon-container'>
                                            <img class="admin-img" alt="{{ $user->name }}" src="{{ $user->profile_picture }}" width="100px" height="100px" />
                                            <div class='status-circle'>
                                                <div class="demo-up">
                                                    <span class="server-status" type="up"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p>
                                                <span>{{ $user->name }}</span>
                                                <br>
                                                <small>{{ $user->Role->name }}</small>
                                            </p>
                                        </div>
                                    </div>
                                    @php $s = $s + 1; @endphp
                                @endif
                            @endif
                        @endforeach
                        @endforeach
                        @if ($s == 0)
                            <div class="col-12">
                                <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1" role="alert">
                                    Currently there are <strong>0 members</strong> online!
                                </div>
                            </div>
                        @endif
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
                            @php $x = 0; @endphp
                            @foreach ($admins_online as $a_user)
                                @foreach ($users as $user)
                                    @if ($a_user->user_id == $user->id)
                                        @if (Permission::is_admin($user->role_id) == true)
                                            <div class="col-lg-4 col-md-6 col-sm-6 justift-content-center text-center">
                                                <div class='justify-content-center text-center icon-container'>
                                                    <img class="admin-img" alt="{{ $user->name }}" src="{{ $user->profile_picture }}" width="100px" height="100px" />
                                                    <div class='status-circle'>
                                                        <div class="demo-up">
                                                            <span class="server-status" type="up"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <p>
                                                        <span>{{ $user->name }}</span>
                                                        <br>
                                                        <small>{{ $user->Role->name }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                            @php $x = $x + 1; @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            @if ($x == 0)
                                <div class="col-12">
                                    <div class="mb-1 alert alert-info alert-dismissible text-center fade show mt-1" role="alert">
                                        Currently there are <strong>0 staff members</strong> online!
                                    </div>
                                </div>
                            @endif
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
                        data: [{{ $newusers[0] }}, {{ $newusers[1] }}, {{ $newusers[2] }},
                            {{ $newusers[3] }}, {{ $newusers[4] }}, {{ $newusers[5] }},
                            {{ $newusers[6] }}, {{ $newusers[7] }}, {{ $newusers[8] }},
                            {{ $newusers[9] }}, {{ $newusers[10] }}, {{ $newusers[11] }}
                        ],
                        label: "New Users",
                        fill: true,
                        backgroundColor: 'rgba(62, 149, 205, 0.7)',
                        pointRadius: 0,
                        borderWidth: 1,
                        pointHitRadius: 20,
                        borderColor: 'rgba(0, 0, 0, 0.2)',
                    }, {
                        data: [{{ $sales[0] }}, {{ $sales[1] }}, {{ $sales[2] }},
                            {{ $sales[3] }}, {{ $sales[4] }}, {{ $sales[5] }},
                            {{ $sales[6] }}, {{ $sales[7] }}, {{ $sales[8] }},
                            {{ $sales[9] }}, {{ $sales[10] }}, {{ $sales[11] }}
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
    @endsection

    @section('scripts')
        <script src="/js/API/active_users.js"></script>
    @endsection
