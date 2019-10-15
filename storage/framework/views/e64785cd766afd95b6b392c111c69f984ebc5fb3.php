<?php $__env->startSection('content'); ?>

    <?php echo $result; ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title'=>$screen->name], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>