<?php $__env->startSection('content'); ?>

        <div class="container">
            <div class="content">
                <div class="title title-404"><?php echo e(isset($error) ? $error : "404 Error"); ?></div>
            </div>
        </div>
    </body>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>