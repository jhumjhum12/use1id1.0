<?php if(count($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="20%"><?php echo e(Label::get('company_name')); ?></th>
            <th width="20%"><?php echo e(Label::get('job_title')); ?></th>
            <th width="15%"><?php echo e(Label::get('start_date')); ?></th>
            <th width="15%"><?php echo e(Label::get('end_date')); ?></th>
            <th width="15%"><?php echo e(Label::get('revisions')); ?></th>
            <?php if(!isset($noActions)): ?>
            <th width="15%"><?php echo e(Label::get('actions')); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><strong><?php echo e($value->company_name); ?></strong></td>
            <td><?php echo e($value->job_title); ?></td>
            <td><?php echo e($value->start_date); ?></td>
            <td><?php echo e($value->end_date); ?></td>
            <td><i class="fa fa-comment-o"></i> <?php echo e(count($value->revisions)); ?></td>
            <?php if(!isset($noActions)): ?>
            <td>
                <a class="btn btn-primary" href="?<?php echo e($db_table); ?>=<?php echo e($value->id); ?>"><?php echo e(\App\Label::get('Edit')); ?></a>
                <?php echo $__env->make('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $value->id ] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
<?php else: ?>
    <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
<?php endif; ?>