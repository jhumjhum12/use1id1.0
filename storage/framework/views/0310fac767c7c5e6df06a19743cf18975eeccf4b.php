

<!-- Main Content -->
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        <img height="38" src="<?php echo e(URL::asset('img/1id.jpg')); ?>" />
                    </p>
                </div>
                <div class="panel-body reset-form">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="email" class="col-md-4 control-label email-label">E-Mail Address</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control input-reset-email" name="email" value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 btn-col">
                                <button type="submit" class="btn btn-primary reset-btn">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-original', ['class' => 'reset-page'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>