<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e($companyfavicon); ?>" type="image/png">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($companyname); ?></title>
    <?php if(Auth::check()): ?>
        <?php if(Auth::user()->user_theme == 1): ?>
            <link href="/css/custom-dark.css" rel="stylesheet">
        <?php elseif(Auth::user()->user_theme == 0): ?>
            <link href="/css/custom-light.css" rel="stylesheet">
        <?php endif; ?>
    <?php else: ?>
        <link href="/css/custom-light.css" rel="stylesheet">
    <?php endif; ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/js/jquery.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</head>

<body class="antialiased">
    <div class="nav mr-5 ">
        <div class="ml-5 mt-4 navigation-branding">
            <?php if($navbaricon == 1): ?>
                <img style="margin-left: 3%;" src="<?php echo e($companylogo); ?>" width="200" />
            <?php else: ?>
                <?php if($companyname == 'MarketSoft'): ?>
                    <a href="/">
                        <p style="margin-left: 3%;">
                            <span class="nav-market">Market</span><span class="nav-soft">Soft</span>
                        </p>
                    </a>
                <?php else: ?>
                    <p style="margin-left: 3%;"><?php echo e($companyname); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="mr-5 navigation">
            <ul class="ul">
                <li><a href="/">Home</a></li>
                <li><a data-bs-toggle="dropdown">Products</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="">Digital Products</a>
                        <a class="dropdown-item" href="">Physical Products</a>
                        <a class="dropdown-item" href="<?php echo e(route('products.index')); ?>">View All Products</a>
                    </ul>
                </li>
                <li class="dropdown"><a data-bs-toggle="dropdown">Information</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="<?php echo e(route('announcements.index')); ?>">Announcements</a>
                        <a class="dropdown-item" href="<?php echo e(route('knowledgebase.index')); ?>">Knowledgebase</a>
                    </ul>
                </li>
                <li><a data-bs-toggle="dropdown">Support</a>
                    <ul class="mt-2 dropdown-menu">
                        <a class="dropdown-item" href="">Contact Us</a>
                        <a class="dropdown-item" href="<?php echo e(route('support.ticket')); ?>">Submit a Ticket</a>
                    </ul>
                </li>
                <?php if(Auth::check()): ?>
                    <li class="li-profile"><a data-bs-toggle="dropdown"><?php echo e(Auth::user()->name); ?> </a>
                        <ul class="mt-2 dropdown-menu dropdown-menu-left">
                            <?php if(Auth::check()): ?>
                                <a class="dropdown-item" href="<?php echo e(route('auth.settings')); ?>"><i style="width: 16px;"
                                        data-feather="user" class="mr-1"></i><span class="nav-text">Account
                                        Settings</span></a>
                                <a class="dropdown-item" href="<?php echo e(route('auth.logout')); ?>"><i style="width: 16px;"
                                        data-feather="log-out" class="mr-1"></i><span class="nav-text">Account
                                        Logout</span></a>
                                <?php if(Permission::check(['Admin', 'view']) == true): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.index')); ?>">
                                        <i style="width: 16px;" data-feather="settings" class="mr-1"></i>
                                        <span class="nav-text">Admin Side</span>
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="dropdown-item" href="<?php echo e(route('auth.login')); ?>">Login</a>
                                <a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>">Register</a>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="header">
        <?php if($__env->yieldContent('header-title')): ?>
            <div style="z-index: 500;" class="row">
                <div class="col-1">
                </div>
                <div style="margin-top: 10%;" class="col-10 col-max-mobile">
                    <h1 class="color-white" style="text-transform:uppercase; text-align: center;">
                        <?php echo $__env->yieldContent('header-title'); ?>
                    </h1>
                    <div class="color-white">
                        <?php echo $__env->yieldContent('header-breadcrumb'); ?>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="row" style="--bs-gutter-x: 0rem;">
        <div class="col-12">
            <div class="container">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            
        </div>
    </div>
</body>

<?php echo $__env->yieldContent('footer'); ?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/vendor/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()

</script>

</html>
<?php /**PATH /var/www/softwarelol/resources/views/Vendor/products.blade.php ENDPATH**/ ?>