<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="5%"><?php echo e(Label::get('logo')); ?></th>
            <th width="40%"><?php echo e(Label::get('company_name')); ?></th>
            <th width="20%"><?php echo e(Label::get('registration_number')); ?></th>
            <th width="20%"><?php echo e(Label::get('website')); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><img src="<?php echo e($value->company->getImage()); ?>" height="32" /></td>
                <td><?php echo e($value->company->name); ?></td>
                <td><?php echo e($value->company->registration_number); ?></td>
                <td><a href="<?php echo e(Label::getURL($value->company->website)); ?>" target="_blank"><?php echo e($value->company->website); ?></a></td>
            </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
</div>
<?php else: ?>
    <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
<?php endif; ?>