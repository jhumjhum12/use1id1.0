

<?php $__env->startSection('content'); ?>

    <form method="GET" action="<?php echo e(route('contacts.search')); ?>">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="<?php echo e($searchString); ?>" placeholder="Search 1iD">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><?php echo e(Label::get('search')); ?></button>
          </span>
                </div>
            </div>
        </div>
    </form>

    <?php echo $__env->make('member.contacts.partials.contact-grid', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>'Search 1iD', 'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>