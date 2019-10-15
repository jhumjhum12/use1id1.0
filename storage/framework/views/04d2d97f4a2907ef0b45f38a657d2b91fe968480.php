<div class="grid">
<?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

    <div class="grid-item">

        <img width="80" class="img-circle" src="<?php echo e($contact->member->getImage()); ?>" />

        <h4 style="margin-bottom: 0"><?php echo e($contact->member->getName()); ?></h4>

        <?php if($contact->status==1): ?>
        <small><?php echo e($contact->member->email); ?></small>
            <br />
        <?php endif; ?>

        <?php if($contact->status_txt): ?>
        <strong><?php echo e($contact->status_txt); ?></strong>
        <br />
        <?php endif; ?>

        <div class="grid-buttons">

        <?php if($contact->status===null): ?>
            <a class="btn btn-default" href="<?php echo e(route('contacts.invite.get', ['id'=>$contact->member->personal_id])); ?>"><?php echo e(Label::get('send_invite')); ?></a>
        <?php endif; ?>
        <?php if($contact->user_1 == Auth::user()->id && $contact->status==0): ?>
            <a class="btn btn-default disabled" href="javascript:void(0)"><?php echo e(Label::get('request_pending')); ?></a>
        <?php endif; ?>
        <?php if($contact->user_2 == Auth::user()->id && $contact->status==0): ?>
            <a class="btn btn-default" href="<?php echo e(route('contacts.accept-invite', ['email'=>$contact->member->email])); ?>"><?php echo e(Label::get('accept')); ?></a>
        <?php endif; ?>
        <?php if($contact->status==1): ?>
            <a class="btn btn-primary" href="<?php echo e(route('contacts.view.details', $contact->member->id)); ?>"><?php echo e(Label::get('view_profile')); ?></a>
        <?php endif; ?>
        </div>


    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    <?php if(sizeof($contacts)==0): ?>
        <div class="well"><?php echo e(Label::get('no_results_found')); ?></div>
    <?php endif; ?>
</div>