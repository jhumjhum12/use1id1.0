<?php
if(!isset($slug)) $slug = null;
\App\ScreenBuilder\ScreenNew::init($slug);
?><!DOCTYPE html>
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
<script src="<?php echo e(asset('js/use1id.js')); ?>" defer></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body <?php if(isset($class)): ?> class="<?php echo e($class); ?>" <?php endif; ?>>

<?php if(Auth::check()): ?>
<?php echo $__env->make('layouts.parts.feedback', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

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

                <?php if(\App\ScreenBuilder\Screen::helpAvailable() && Auth::check() ): ?>
                <li class="dropdown help">
                    <span data-id="0" class="open-help">Show Help</span>
                    <span data-id="1" class="close-help">Hide Help</span>
                </li>
                <?php endif; ?>

                <?php if(Auth::check()): ?>
                <li><a href="<?php echo e(URL::to('general-data')); ?>">
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

                    

                </li>

                    <li class="dropdown admin-tools">
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
                                    <a href="<?php echo e(route('builder.angular.indexnew')); ?>">
                                        Admin: Screen Builder New
                                    </a>
                                </li>
								<li>
                                    <a href="<?php echo e(route('builder.angular.index')); ?>">
                                        Admin: Screen Builder
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('translator')); ?>">
                                        Admin: Translator
                                    </a>
                                </li>
								 <li>
                                        <a href="<?php echo e(route('customize')); ?>" >
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


<section id="page">

    <div class="main">


        <?php echo $__env->make('layouts.parts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('layouts.parts.alertify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

<div id="dialogBox" class="white_content"></div>
	<div id="dialogBox1" class="white_content"></div>
	<div id="dialogBox3" class="template_content"></div>
 <div id="dialogBox2" class="white_content_new"></div>
  <div id="fade" class="black_overlay"></div>
    <?php if(Auth::check()): ?>
    <?php echo $__env->make('layouts.parts.help', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>


</section>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-6">

                <h2>LVIS GmbH</h2>

                <p>Hollenweg 51</p>
                <p>CH-4114 Hofstetten SO</p>
                <p>CHE-273.325.999</p>
                <p>Switzerland</p>
                <p><a href="mailto:info@use1id.com">info@use1id.com</a></p>

            </div>
            <div class="col-md-6 col-xs-6">
                <h2>FOLLOW use1ID <br><small>on different social media:</small></h2>

                <h4><a href="https://twitter.com/LVISuse1ID" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></h4>
                <h4><a href="https://www.linkedin.com/groups/7072587" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin</a></h4>
                <h4><a href="https://www.facebook.com/LVISuse1ID/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center copyright">
                Copyright &#169; All Rights Reserved
            </div>
        </div>
    </div>
</footer>
    <!-- Scripts -->
    <script src="<?php echo e(URL::asset('js/app.js')); ?>"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo e(URL::asset('js/alertify.js-0.3.11/lib/alertify.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/1id.js')); ?>"></script>
	


</body>
</html>
