<?php $__env->startSection('headline', 'New Registration'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: left; color: #1c2742">
        <p><strong>Hi,</strong></p>

        <p>New user has registered!</p>

        <p><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></p>

        
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>