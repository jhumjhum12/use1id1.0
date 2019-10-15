<script>

    var alerts = [];
    <?php $__currentLoopData = Notification::container()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        alerts.push({"type": "<?php echo e($notification->getType()); ?>", "text": "<?php echo e($notification->getMessage()); ?>"});
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</script>

