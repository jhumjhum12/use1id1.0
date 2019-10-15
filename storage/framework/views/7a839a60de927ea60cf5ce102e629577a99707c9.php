<?php $__env->startSection('content'); ?>


    <div class="page">

        <div class="main">

            <h1>E-Mail Activation</h1>

            <?php if($activationSuccess): ?>

                <h3>Activation Successful!</h3>
                <p>Thank you!</p>
            <?php else: ?>
                <h3>Code is already used, expired or invalid.</h3>

            <?php endif; ?>


</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>