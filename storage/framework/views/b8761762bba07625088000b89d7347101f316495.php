<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="description" content="A Market, Business, Hosting Company Software for a small price!">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Vincent Van Hoof, Pierce Gearhart">
    <meta property="og:title" content="<?php echo e(trim(View::yieldContent('title'))); ?> - <?php echo e(Settings::key('CompanyName')); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(route('index')); ?>" />
    <meta property="og:image" content="<?php echo e(Settings::where('key', 'CompanyFavicon')->first()->value); ?>" />
    <meta property="og:description" content="Our revolutionary platform will help you find the best products." />
    <meta name="theme-color" content="#165ef7">

    <link rel="icon" href="<?php echo e(Settings::where('key', 'CompanyFavicon')->first()->value); ?>" type="image/png">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(Settings::where('key', 'CompanyName')->first()->value); ?></title>
    <link href="/css/custom-dark.css" rel="stylesheet">
    <link href="/css/asColorPicker.css" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-wysihtml5.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/59ac7ac104.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/alertdark.css">
    <?php echo $__env->yieldContent('scripts'); ?>
</head>

<body class="antialiased">
    <div class="alert alert-danger alert-server btn-sm mb-0 text-center" style="border-radius: 0px!important;" role="alert">
        <strong>IMPORTANT:</strong> You are running a beta version of MarketSoft. This isn't inteded to be used for full scale production.
    </div>
    <nav class="market-navbar navbar navbar-expand-lg btn-block">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: black;" data-feather="align-justify"></i>
            </button>
            <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="market-navbar-large-header market-navbar-header navbar-brand" href="<?php echo e(route('admin.index')); ?>">
                <?php if(Settings::key('NavbarIconStatus') == 1): ?> <img src="<?php echo e(Settings::key('CompanyLogo')); ?>" height="35" alt="logo" /> <?php else: ?> <h4 class="mb-0 v-center"><?php echo e(Settings::key('CompanyName')); ?></h4>
                    <?php endif; ?>
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;" class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link market-navbar-link active" aria-current="page" href="<?php echo e(route('admin.index')); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link" href="<?php echo e(route('admin.settings')); ?>">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link" href="<?php echo e(route('admin.products')); ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link" href="<?php echo e(route('admin.users')); ?>">Users</a>
                    </li>
                    <?php if(Modules::is_enabled('TicketSystem')): ?>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link" href="<?php echo e(route('admin.tickets')); ?>">Tickets</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sellers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.sellerrequests')); ?>">Seller
                                    Requests</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(Auth::check()): ?> <?php echo e(Auth::user()->name); ?> <?php else: ?>
                                Account <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php if(Auth::check()): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.settings')); ?>"><i style="width: 16px;" data-feather="user" class="mr-1"></i><span class="nav-text">Account Settings</span></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>"><i style="width: 16px;" data-feather="sliders" class="mr-1"></i><span class="nav-text">Seller Dashboard</span></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.login')); ?>">Login</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link" href="<?php echo e(route('index')); ?>">Exit Admin Side</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (! empty(trim($__env->yieldContent('header-title')))): ?>
        <div class="header">
            <div style="z-index: 500;" class="row">
                <div class="col-1">
                </div>
                <div style="margin-top: 10rem;" class="col-10 col-max-mobile header-breadcrumb">
                    <h1 class="color-white" style="text-transform:uppercase; text-align: center;"><?php echo $__env->yieldContent('header-title'); ?>
                    </h1>
                    <div class="color-white">
                        <?php echo $__env->yieldContent('header-breadcrumb'); ?>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="mb-3"></div>
        <?php echo $__env->yieldContent('content'); ?>
        <?php if (! empty(trim($__env->yieldContent('header-title')))): ?>
    </div>
    <footer class="mt-5 bg-dark text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Copyright © 2020:
            <a class="text-dark" href="<?php echo e(route('admin.index')); ?>"><?php echo e(Settings::key('CompanyName')); ?></a>
        </div>
    </footer>
    <?php endif; ?>
</body>
<?php echo $__env->make('Vendor.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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