

<?php $__env->startSection('headline', 'You are invited to 1ID'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi,</span>

        <p>Your just sent invitation to <?php echo e($email); ?> join 1ID.</p>

        <?php if($txt): ?>
        <p><b>Message:</b> <i><?php echo e($txt); ?></i></p>
        <?php endif; ?>

        <p>Upon successfully registering invitee will be able to start using 1ID.</p>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>