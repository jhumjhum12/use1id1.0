<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="30%"><?php echo e(Label::get('institution')); ?> </th>
            <th width="25%"><?php echo e(Label::get('course_name')); ?></th>
            <th width="15%"><?php echo e(Label::get('duration')); ?></th>
            <th width="10%"><?php echo e(Label::get('revisions')); ?></th>
            <?php if(!isset($noActions)): ?>
            <th width="20%"><?php echo e(Label::get('actions')); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><strong><?php echo e($value->institution_name); ?></strong></td>
            <td><?php echo e($value->course_name); ?></td>
            <td><?php echo e($value->start_date); ?>-<?php echo e($value->end_date); ?></td>
            <td><?php ( $version = \App\Models\BiographyVersion::find($value->version_id)); ?>  
									<?php echo e($version->version); ?></td>
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