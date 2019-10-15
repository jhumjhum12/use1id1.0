

<?php $__env->startSection('content'); ?>

    <div class="my-data-heading">
        <img class="img-circle" src="<?php echo e($user->getImage()); ?>" width="120"> <br /><br />
        <h1><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </h1>
    </div>

    <p class="text-center">

            <?php if($contact==false): ?>
            <a class="btn btn-default" href="<?php echo e(route('contacts.invite.get', ['id'=>$user->personal_id])); ?>"><?php echo e(Label::get('send_invite')); ?></a>
            <?php else: ?>

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
            <?php endif; ?>



    </p>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>'' ,'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>