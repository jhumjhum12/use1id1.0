<?php $__env->startSection('content'); ?>

    <?php echo $result; ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title'=>$screen->name], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>