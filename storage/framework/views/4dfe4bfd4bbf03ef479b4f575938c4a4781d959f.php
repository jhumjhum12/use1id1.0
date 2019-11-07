<?php if(sizeof($data)>0): ?>
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th width="20%">Url</th>
            <th width="10%">Username</th>
            <th width="10%">Password</th>
			<th width="20%">Notes</th>
            <th width="20%">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><strong><?php echo e($value->name); ?></strong></td>
            <td><?php echo e($value->url); ?></td>
            <td><?php echo e($value->username); ?></td>
            <td><span><i class="fa fa-lock"></i></span></td>
			<td><?php echo e($value->notes); ?></td>
            <td>
                <a class="btn btn-primary" href="?<?php echo e($db_table); ?>=<?php echo e($value->id); ?>"><?php echo e(\App\Label::get('Edit')); ?></a>
                <?php echo $__env->make('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $value->id ] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
<?php else: ?>
    <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
<?php endif; ?>