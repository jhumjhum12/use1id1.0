<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="<?php echo e(URL::asset('img/favicon.png')); ?>"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>1ID</title>

    <!-- Styles -->
    <link href="<?php echo e(URL::asset('js/alertify.js-0.3.11/themes/alertify.bootstrap.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(URL::asset('js/alertify.js-0.3.11/themes/alertify.core.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(URL::asset('js/alertify.js-0.3.11/themes/alertify.test.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(URL::asset('css/app.css')); ?>" rel="stylesheet" type="text/css" >
    <link href="<?php echo e(URL::asset('css/one.css')); ?>" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if(Auth::user() && Auth::user()->isAdmin()): ?>
        <link href="<?php echo e(URL::asset('css/screen-builder.css')); ?>" rel="stylesheet" type="text/css" >
    <?php endif; ?>
    <script src="https://use.fontawesome.com/5c91db09bb.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body <?php if(isset($class)): ?> class="<?php echo e($class); ?>" <?php endif; ?>>



<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <img height="38" src="<?php echo e(URL::asset('img/1id.jpg')); ?>" />
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <?php if(Auth::check()): ?>
                    <li><a href="#">
                            <img src="<?php echo e(Auth::user()->getImage()); ?>" class="profile-img img-circle" />
                            <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> (<?php echo e(Auth::user()->getPersonalId()); ?>)
                        </a></li>
                    <?php endif; ?>
                            <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                        <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                    <?php else: ?>
                        <li class="langs">
                            <ul>
                                <li><a href="#"><span>EN</span></a></li>
                                <li><a href="#"><span>NL</span></a></li>
                                <li><a href="#"><span>FR</span></a></li>
                            </ul>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo e(route('1id.get-first-page')); ?>">
                                        Dashboard
                                    </a>
                                </li>
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <li>
                                        <a href="<?php echo e(route('builder.angular.index')); ?>">
                                            Admin: Screen Builder
                                        </a>
                                    </li>
									<li>
										<a href="<?php echo e(route('builder.angular.index')); ?>">
											Admin: Screen Builder Copy
										</a>
									</li>
                                    <li>
                                        <a href="<?php echo e(route('translator')); ?>">
                                            Admin: Translator
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('customize')); ?>">
                                            Admin: Customizing
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo e(url('/logout')); ?>"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

            </ul>

            <!--
            <form class="navbar-form navbar-right">
                <input class="form-control" placeholder="Search..." type="text">
            </form>
            -->
        </div>
    </div>
</nav>

<div class="oneidcontainer" >
    <?php echo $__env->yieldContent('content'); ?>
</div>

<!-- Scripts -->
<script src="<?php echo e(URL::asset('js/app.js')); ?>"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo e(URL::asset('js/alertify.js-0.3.11/lib/alertify.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/1id.js')); ?>"></script>


<div id="dialogBox" class="white_content"></div>
<div id="dialogBox2" class="white_content_new"></div>
<div id="fade" class="black_overlay"></div>
</body>
</html>
