<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="25%"><?php echo e(Label::get('customer')); ?>/<?php echo e(Label::get('project_name')); ?> </th>
            <th width="20%"><?php echo e(Label::get('person')); ?></th>
            <th width="15%"><?php echo e(Label::get('job_title')); ?></th>
            <th width="10%"><?php echo e(Label::get('date')); ?></th>
            <th width="10%"><?php echo e(Label::get('referee_position')); ?></th>
            <th width="5%"><?php echo e(Label::get('revisions')); ?></th>
            <?php if(!isset($noActions)): ?>
            <th width="15%"><?php echo e(Label::get('actions')); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
        <tr>
            <td><strong><?php if(isset($value->project->work_experience_id)): ?> <?php echo e($value->project->customer_name); ?>/<?php echo e($value->project->project_name); ?><?php endif; ?></strong> </td>
            <td><?php echo e($value->person_name); ?></td>
            <td><?php echo e($value->job_title); ?></td>
            <td><?php echo e($value->reference_date); ?></td>
            <td><?php echo e($value->job_position); ?></td>
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
<?php if(isset($value->project->customer)): ?> <?php echo e($value->project->customer); ?>/<?php echo e($value->project->project_name); ?><?php endif; ?>