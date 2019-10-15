<div class="grid">
<?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

    <div class="grid-item">

        <p style="line-height: 100px; height: 100px; ">
        <img width="80" src="<?php echo e($company->getImage()); ?>" />
        </p>

        <h4 style="margin-bottom: 0"><?php echo e($company->name); ?></h4>

        <hr style="margin: 4px 0" />
        

        <form style="padding: 0" method="POST" action="<?php echo e(route('contacts.company.post', ['id' => $company->id])); ?>">
        <div class="grid-buttons">
        
        <p><?php echo e(Label::get('register_as')); ?></p>
        <button type="submit" name="type" value="customer" class="btn <?php if($company->isContact(Auth::user()->id, 'customer')): ?> btn-primary <?php else: ?> btn-default <?php endif; ?> "><?php echo e(Label::get('customer')); ?></button>
        <button type="submit" name="type" value="employee" class="btn <?php if($company->isContact(Auth::user()->id, 'employee')): ?> btn-primary <?php else: ?> btn-default <?php endif; ?>"><?php echo e(Label::get('employee')); ?></button>
        </div>
        </form>

    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    <?php if(sizeof($companies)==0): ?>
        <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
    <?php endif; ?>

</div>