<?php $__env->startSection('content'); ?>

    <?php if($user->id != Auth::user()->id): ?>
    <form method="POST" action="<?php echo e(route('contacts.update-sharing.post', ['id'=>$user->id])); ?>">

    <h2>Sharing Options</h2>

        <table class="sharing-table">
            <tr class="row-one">
                <th class="first-field"></th>
                <th>Basic Info</th>
                <?php $__currentLoopData = $contact->sharingOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <th><?php echo e($v); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tr>
            <tr class="row-two">
                <td class="first-field"><?php echo e($user->first_name); ?> vs You:</td>
                <td><input type="checkbox" checked="checked" disabled="disabled"></td>
                <?php $__currentLoopData = $contact->sharingOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <td><input type="checkbox" <?php if(in_array($k, $shareInverted)): ?> checked="checked" <?php endif; ?> disabled="disabled" /></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tr>
            <tr class="row-three">
                <td class="first-field">You vs <?php echo e($user->first_name); ?>:</td>
                <td><input type="checkbox" checked="checked" disabled="disabled" /></td>
                <?php $__currentLoopData = $contact->sharingOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <td><label><input type="checkbox" name="share[]" <?php if(in_array($k, $share)): ?> checked="checked" <?php endif; ?> value="<?php echo e($k); ?>" /></label></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tr>
            <tr>
                <td colspan="9"><button class="btn btn-danger">Submit</button></td>
            </tr>
        </table>
        
    </form>
    <?php endif; ?>



    <h2><?php echo e(Label::get('basic_data')); ?></h2>
    <?php echo $__env->make('member.contacts.partials.basic-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <hr />

    <?php if($user->companies->count()>0 || $user->employee->count()>0): ?>
        <h2><?php echo e(Label::get('companies')); ?></h2>
        <?php if($myOwn ||  in_array(2, $share) && in_array(2, $shareInverted) ): ?>

            <?php if($user->companies->count()>0): ?>
                <h4><b><?php echo e(Label::get('owner_of')); ?></b></h4>
                <?php echo $__env->make('html-controls.table-builder.companies', ['data'=>$user->companies, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

            <?php if($user->employee->count()>0): ?>
                <h4><b><?php echo e(Label::get('employee_of')); ?></b></h4>
                <?php echo $__env->make('html-controls.table-builder.companies-employee', ['data'=>$user->employee, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <hr />
    <?php endif; ?>

    <h2><?php echo e(Label::get('work_experience')); ?></h2>
        <?php if($myOwn ||  in_array(1, $share) && in_array(1, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.work_experience', ['data'=>$user->workExperience, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />

    <h2><?php echo e(Label::get('projects')); ?></h2>
        <?php if($myOwn ||  in_array(3, $share) && in_array(3, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.projects', ['data'=>$user->projects, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />

    <h2><?php echo e(Label::get('references')); ?></h2>
        <?php if($myOwn ||  in_array(4, $share) && in_array(4, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.references', ['data'=>$user->references, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />

    <h2><?php echo e(Label::get('education')); ?></h2>
        <?php if($myOwn ||  in_array(5, $share) && in_array(5, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.education', ['data'=>$user->education, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />

    <h2><?php echo e(Label::get('spoken_languages')); ?></h2>
        <?php if($myOwn ||  in_array(6, $share) && in_array(6, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.spoken_languages', ['data'=>$user->spokenLanguages, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />

    <h2><?php echo e(Label::get('contact_info')); ?></h2>
        <?php if($myOwn ||  in_array(7, $share) && in_array(7, $shareInverted) ): ?>
            <?php echo $__env->make('html-controls.table-builder.contact_info', ['data'=>$user->contactInfo, 'noActions'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('member.contacts.partials.no-share', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <hr />


    <script>
        window.onload = function(e){

            var count = 0;
            var len = $('.sharing-table tr:nth-child(2) td').length;

            for(i=0; i<=len; i++) {
                var checked = 0;
                $(".sharing-table tr:nth-child(2) td:nth-child("+i+"):has(:checkbox:checked)").each(function(){
                    checked++;
                });
                $(".sharing-table tr:nth-child(3) td:nth-child("+i+"):has(:checkbox:checked)").each(function(){
                    checked++;
                });
                var css="";
                if(checked==2) css = "match";
                if(checked==1) css = "semi-match";
                if(css!="") {
                    // set classes
                    $(".sharing-table tr:nth-child(1) th:nth-child("+i+")").addClass(css);
                    $(".sharing-table tr:nth-child(2) td:nth-child("+i+")").addClass(css);
                    $(".sharing-table tr:nth-child(3) td:nth-child("+i+")").addClass(css);
                }
            }

            // $('sharing-table')
        };

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>'' ,'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>