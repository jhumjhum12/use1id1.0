

<?php $__env->startSection('content'); ?>

<div id="reg-page">
    <div class="register-form">
        <form class="form-horizontal" role="form" method="POST" action="">
             <?php echo e(csrf_field()); ?>

            <div class="login-logo">
                <p class="text-center">
                    <img height="38" src="<?php echo e(URL::asset('img/1id.jpg')); ?>" />
                </p>
                <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-group-register">
                        <div class="register-inline">
                            <label for="language" class="control-label"><?php echo e(\App\Label::get("language")); ?></label>
                        </div>
                        <div class="register-inline">

                            <select id="language" name="selected_lang" class="form-control">
                                <option value="1" selected>English</option>
                                <option value="2">Deutsch</option>
                                <option value="3">Dutch</option>
                                <option value="4">French</option>
                            </select>

                            
                        </div>
                    </div>

                    <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="first-name" class="control-label"><?php echo e(\App\Label::get("first_name")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="first-name" type="text" name="first_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="last-name" class="control-label"><?php echo e(\App\Label::get("last_name")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="last-name" type="text" name="last_name" class="form-control">
                        </div>
                    </div>

                    <div class="register-msg">
                        <p class="msg">Message:</p>

                        <p>Use your first and last name as in your passport ID</p>
                        
                    </div>

                </div>
                <div class="col-md-6">
                     <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?> form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-password" class="control-label"><?php echo e(\App\Label::get("password")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-password" type="password" name="password" class="form-control">
                        </div>
                    </div>

                     <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-repeat-password" class="control-label"><?php echo e(\App\Label::get("repeat_pass")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-repeat-password" type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                     <div class="form-group form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-reference" class="control-label"><?php echo e(\App\Label::get("reference_user")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-reference" type="text"
                                   disabled="disabled" readonly="readonly"
                                   name="reference_user"
                                   value="<?php if(isset($inviter)): ?><?php echo e($inviter->first_name); ?> <?php echo e($inviter->last_name); ?><?php endif; ?>"
                                   class="form-control">
                        </div>
                    </div>

                     <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?> form-group-register">
                        <div class="register-label register-inline">
                            <label for="reg-email" class="control-label"><?php echo e(\App\Label::get("email")); ?></label>
                        </div>
                        <div class="register-inline">
                            <input id="reg-email" type="email" value="<?php echo e($email); ?>" name="email" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block reg-btn"><?php echo e(\App\Label::get("register")); ?></button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span>Already Registered? <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> <a href="<?php echo e(url('/login')); ?>"> <?php echo e(\App\Label::get("back_to_login")); ?></a></span>
                </div> 
            </div>
        </form>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-original', ['class'=>'register-page'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>