<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('member.contacts.partials.contact-grid', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['slug'=>'contacts', 'title'=>'View Contacts',  'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>