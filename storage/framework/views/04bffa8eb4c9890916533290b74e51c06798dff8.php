<?php $__env->startSection('content'); ?>

            <form method="POST" action="<?php echo e(route('contacts.invite.post')); ?>">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Invite someone to join 1iD">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><?php echo e(Label::get('invite')); ?></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <br />
                            <textarea name="message" class="form-control" placeholder="Optional Message"></textarea>
                    </div>
                </div>
            </form>


            <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-5">
                        <i class="fa fa-envelope-o"></i>
                        <?php echo e($contact->email); ?>

                    </div>
                    <div class="col-xs-2">
                            <?php echo e(Label::get('pending')); ?>

                    </div>
                    <div class="col-xs-2">

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

            <hr />

            <?php $__currentLoopData = $accepted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="row">
                    <div class="col-xs-3">
                    </div>
                    <div class="col-xs-5">
                        <i class="fa fa-envelope-o"></i>
                        <?php echo e($contact->email); ?>

                    </div>
                    <div class="col-xs-2">
                        <strong class="text-success"><?php echo e(Label::get('accepted')); ?></strong>
                    </div>
                    <div class="col-xs-2">

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>'Invite', 'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>