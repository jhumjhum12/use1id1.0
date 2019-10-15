<hr style="margin: 10px 0" />
<div id="revisions">
 <?php $i = 0; ?>

 <div class="form-group">

  <div class="control-label">
    <label><?php echo e(Label::get("revision")); ?></label>
  </div>

  <div id="revision-selector">
      
  </div>

   <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div style="clear: both" class="revision" data-id="<?php echo e($key); ?>">

     <div class="revisions-clear">
       <textarea name='revisions[]' class="form-control editor"><?php echo e($text or ''); ?></textarea>
     </div>
    </div>

   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 </div>
</div>

