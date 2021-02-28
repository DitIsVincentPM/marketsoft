<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title" content="Site Title" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(route('index')); ?>" />
    <meta property="og:image" content="<?php echo e($companylogo); ?>" />
    <meta property="og:description" content="Site description" />
    <meta name="theme-color" content="#165ef7">

    <link rel="icon" href="<?php echo e($companyfavicon); ?>" type="image/png">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($companyname); ?></title>
    <link href="/css/custom-dark.css" rel="stylesheet">
    <link href="/css/asColorPicker.css" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-wysihtml5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</head>

<body class="antialiased">
    <nav class="market-navbar navbar navbar-expand-lg btn-block">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: black;" data-feather="align-justify"></i>
            </button>
            <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="market-navbar-large-header market-navbar-header navbar-brand"
                    href="<?php echo e(route('admin.index')); ?>">
                    <?php if($navbaricon == 1): ?> <img src="<?php echo e($companylogo); ?>" height="50"
                        alt="logo" /> <?php else: ?> <h4><?php echo e($companyname); ?></h4>
                    <?php endif; ?>
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;"
                    class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link market-navbar-link active"
                            aria-current="page" href="<?php echo e(route('admin.index')); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('admin.settings')); ?>">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('admin.users')); ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('admin.tickets')); ?>">Tickets</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.announcements')); ?>">Announcements</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.knowledgebase')); ?>">Knowledgebase</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sellers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="">Active Sellers</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.sellerrequests')); ?>">Seller
                                    Requests</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <?php if(Auth::check()): ?> <?php echo e(Auth::user()->name); ?> <?php else: ?>
                                Account <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if(Auth::check()): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.settings')); ?>"><i
                                            style="width: 16px;" data-feather="user" class="mr-1"></i><span
                                            class="nav-text">Account Settings</span></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>"><i
                                            style="width: 16px;" data-feather="sliders" class="mr-1"></i><span
                                            class="nav-text">Seller Dashboard</span></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.login')); ?>">Login</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('index')); ?>">Exit Admin Side</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if(trim($__env->yieldContent('header-title'))): ?>
        <div class="header-section background-gradient-primary">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 mt-5 col-max-mobile">
                    <h1 class="color-white" style="text-align: center;"><?php echo $__env->yieldContent('header-title'); ?></h1>
                    <div class="color-white">
                        <?php echo $__env->yieldContent('header-breadcrumb'); ?>
                        <br><br>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="mb-3"></div>
            <?php if($message = Session::get('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> <?php echo e($message); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if($message = Session::get('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> <?php echo e($message); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if($message = Session::get('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning:</strong> <?php echo e($message); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if($message = Session::get('info')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info:</strong> <?php echo e($message); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php if(trim($__env->yieldContent('header-title'))): ?>
        </div>
    <?php endif; ?>
</body>

<script src="/vendor/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()

</script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/jquery-clockpicker.min.js"></script>
<script src="/js/morris.min.js"></script>

</html>
<?php /**PATH /var/www/softwarelol/resources/views/Vendor/admin.blade.php ENDPATH**/ ?>