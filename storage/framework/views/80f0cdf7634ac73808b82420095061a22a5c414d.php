<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="30%"><?php echo e(Label::get('language')); ?></th>
            <th width="15%"><?php echo e(Label::get('listening')); ?></th>
            <th width="15%"><?php echo e(Label::get('speaking')); ?></th>
            <th width="15%"><?php echo e(Label::get('reading')); ?></th>
            <th width="10%"><?php echo e(Label::get('writing')); ?></th>
            <?php if(!isset($noActions)): ?>
            <th width="15%"><?php echo e(Label::get('actions')); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <tr>
            <td><strong><?php echo e($value->language->name); ?></strong></td>
            <td><?php echo e($value->listening); ?></td>
            <td><?php echo e($value->speaking); ?></td>
            <td><?php echo e($value->reading); ?></td>
            <td><?php echo e($value->writing); ?></td>
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