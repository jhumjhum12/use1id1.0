<div class="breadcrumbs">
<?php if(sizeof(\App\ScreenBuilder\Screen::$breadcrumbs)>1): ?>
    <ol class="breadcrumb">
        <?php $__currentLoopData = \App\ScreenBuilder\Screen::$breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug=>$name): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to($slug)); ?>"><?php echo e($name); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </ol>
<?php endif; ?>
</div>

<?php if(isset($submenu) && is_array($submenu)): ?>
    <div class="tab-nav">
        <div class="parent-submenu">
            <ul>
                <?php $__currentLoopData = $submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name=>$url): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li><a href="<?php echo e($url); ?>"><?php echo e($name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        </div>
    </div>
<?php elseif(sizeof(\App\ScreenBuilder\Screen::$sameParent)>1): ?>
<div class="tab-nav">
    <div class="parent-submenu">
        <ul>
            <?php $__currentLoopData = \App\ScreenBuilder\Screen::$sameParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slg=>$name): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><a <?php if($slug==$slg): ?> class="active" <?php endif; ?> href="<?php echo e(URL::to($slg)); ?>"><?php echo e($name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
</div>
<?php endif; ?>


<div class="heading text-center"><h1>
        <?php if(isset($title)): ?><?php echo e($title); ?>

        <?php elseif(isset(App\ScreenBuilder\Screen::$screen)): ?>
            <?php echo e(Label::get(\App\ScreenBuilder\Screen::$screen->label)); ?>

        <?php endif; ?>
    </h1></div>

<?php if(count($errors) > 0): ?>
    <div class="notifications">
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
    </div>
<?php endif; ?>

