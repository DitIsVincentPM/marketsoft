<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e($companyfavicon); ?>" type="image/png">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($companyname); ?></title>
    <link href="/css/custom-dark.css" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="/css/morris.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/js/jquery.js"></script>
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
                    <?php if($navbaricon == 1): ?> <img src="<?php echo e($companylogo); ?>" height="35"
                        alt="logo" /> <?php else: ?> <h3 class="mb-0 v-center"><?php echo e($companyname); ?></h3>
                    <?php endif; ?>
                </a>
                <ul style="margin-left: auto !important; margin-right: auto !important; justify-content: center !important;"
                    class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link market-navbar-link active"
                            aria-current="page" href="<?php echo e(route('index')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('products.index')); ?>">Online Store</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="market-navbar-small-header market-navbar-header nav-link dropdown-toggle market-navbar-link"
                            href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Information
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo e(route('announcements.index')); ?>">Announcements</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo e(route('knowledgebase.index')); ?>">Knowledgebase</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('users')); ?>">All Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="market-navbar-small-header market-navbar-header nav-link"
                            href="<?php echo e(route('support.ticket')); ?>">Support Tickets</a>
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
                                            style="width: 15px;margin-right: 5px!important;" data-feather="user"></i><span
                                            class="nav-text">Account Settings</span></a></li>
                                <?php if(Permission::is_admin(Auth::user()->role_id)): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.index')); ?>"><i
                                                style="width: 16px;margin-right: 5px!important;" data-feather="sliders"></i><span
                                                class="nav-text">Administration</span></a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.logout')); ?>"><i
                                            style="width: 16px;margin-right: 5px!important;" data-feather="log-out"></i><span
                                            class="nav-text">Account Logout</span></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.login')); ?>">Login</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('auth.register')); ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="header">
        <?php if($__env->yieldContent('header-title')): ?>
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
        <?php endif; ?>
    </div>

    <div class="container">
        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Success:</strong> <?php echo e($message); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif($message = Session::get('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error:</strong> <?php echo e($message); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif($message = Session::get('warning')): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-3 " role="alert">
                <strong>Warning:</strong> <?php echo e($message); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif($message = Session::get('info')): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3 " role="alert">
                <strong>Info:</strong> <?php echo e($message); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>

    </div>

    <footer class="mt-5 bg-dark text-center text-white">
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

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Copyright © 2020:
            <a class="text-dark" href="<?php echo e(route('index')); ?>"><?php echo e($companyname); ?></a>
        </div>
    </footer>

    <div style="width: 400px; padding: 0% !important; padding-right: 1rem !important;"
        class="accordion position-fixed bottom-0 end-0 p-3">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#shoppingcart" aria-expanded="false" aria-controls="shoppingcart">
                    Shopping Cart
                </button>
            </h2>
            <div id="shoppingcart" class="accordion-collapse collapse">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Quantity</th>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total = 0;
                        ?>
                        <?php $__currentLoopData = ShoppingCart::GetShoppingCart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = Products::GetAll(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->product_id == $product->id): ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($item->qty); ?></td>
                                        <td><?php echo e($product->name); ?></td>
                                        <td><?php echo e($product->price * $item->qty); ?></td>
                                    </tr>
                                    <?php
                                        $total = $total + $product->price * $item->qty;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr class="remove-line">
                            <th scope="row"></th>
                            <td>Total:</td>
                            <td>$<?php echo e($total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/vendor/feather-icons/dist/feather.min.js"></script>
</script>
<script>
    feather.replace();

</script>

</html>
<?php /**PATH /var/www/softwarelol/resources/views/Vendor/main.blade.php ENDPATH**/ ?>