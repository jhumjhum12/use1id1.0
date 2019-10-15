 <table class="table table-bordered table-striped mb-0">
 <?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<?php if(($column!='id') && ($column!='created_at') && ($column!='updated_at')): ?>	
 <tr><td><?php echo e($column); ?></td><td><input type="text" name="<?php echo e($column); ?>" class="addcolumn"/></td></tr>
 <?php endif; ?>	
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </table>