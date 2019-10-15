

<?php $__env->startSection('headline', 'You Have Contact Request'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi,</span>

        <p>Your just received contact request from
            <strong><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></strong> <i>(<?php echo e($user->email); ?>)</i>.</p>

        <p>To see your current contacts you can click <a href="<?php echo e(route('contacts.view')); ?>"><strong>HERE</strong></a></p>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>