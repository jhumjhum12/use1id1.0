<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="5%"><?php echo e(Label::get('logo')); ?></th>
            <th width="40%"><?php echo e(Label::get('company_name')); ?></th>
            <th width="20%"><?php echo e(Label::get('registration_number')); ?></th>
            <th width="20%"><?php echo e(Label::get('website')); ?></th>
            <?php if(!isset($noActions)): ?>
            <th width="15%"><?php echo e(Label::get('actions')); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <tr>
            <td><img src="<?php echo e($value->getImage()); ?>" height="32" /></td>
            <td><?php echo e($value->name); ?></td>
            <td><?php echo e($value->registration_number); ?></td>
            <td><a href="<?php echo e(Label::getURL($value->website)); ?>" target="_blank"><?php echo e($value->website); ?></a></td>
            <?php if(!isset($noActions)): ?>
            <td>
                <a class="btn btn-primary" href="?<?php echo e($db_table); ?>=<?php echo e($value->id); ?>"><?php echo e(\App\Label::get('Edit')); ?></a>
                <?php echo $__env->make('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $value->id ] , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </tbody>
</table>
</div>
<?php else: ?>
    <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
<?php endif; ?>