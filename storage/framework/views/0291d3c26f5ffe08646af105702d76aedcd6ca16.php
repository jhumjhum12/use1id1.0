<?php $__env->startSection('content'); ?>

    <!-- <div class="my-data-heading">
        <img class="img-circle" src="<?php echo e($user->getImage()); ?>" width="120"> <br /><br />
        <h1><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </h1>
    </div> -->

    <?php echo $__env->make('member.contacts.partials.basic-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <p class="text-center">

    </p>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>''], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>