<?php $__env->startSection('content'); ?>

<div class="login-form">
    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="login-logo">
            <p class="text-center">
                <img height="38" src="<?php echo e(URL::asset('img/1id.jpg')); ?>" />
            </p>
        </div>
        <div class="form-group form-group-login">
            <div class="login-inline inline-label">
                <label for="language" class="control-label"><?php echo e(\App\Label::get("language")); ?></label>
            </div>
            <div class="login-inline inline-field">

                <select id="language" name="language" class="form-control form-language">
                    <option value="" selected>Profile Language</option>
                    <option value="en">English</option>
                    <option value="nl">Dutch</option>
                    <option value="fr">French</option>
                    <option value="de">Deutsch</option>
                    <option value="sr">Serbian</option>
                </select>

                
            </div>
        </div>

        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> form-group-login">
            <div class="login-inline inline-label">
                <label for="email" class="control-label"><?php echo e(\App\Label::get("email")); ?></label>
            </div>
            <div class="login-inline inline-field">

              
					<input id="email" type="email" class="form-control form-input" name="email" value="<?php echo e(Cookie::get('useremail')); ?>" required autofocus>
				

                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?> form-group-login">
            <div class="login-inline inline-label">
                <label for="password" class="control-label"><?php echo e(\App\Label::get("password")); ?></label>
            </div>
                <div class="login-inline inline-field">
                    <input id="password" type="password" class="form-control form-input" name="password" value="<?php echo e(Cookie::get('password')); ?>" required>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                    <?php endif; ?>
                </div>
        </div>

        <div class="form-group form-group-login">
            <button id="login-btn" type="submit" class="btn btn-primary btn-block">
                <?php echo e(\App\Label::get("login")); ?>

            </button>
        </div>

        <div class="form-group form-group-login">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" <?php echo e(Cookie::get('test') ? 'checked' : ''); ?>> <?php echo e(\App\Label::get("remember_me")); ?>

                </label>
            </div>
        </div>

    </form>

    <div class="text-center login-actions">
        <p><a href="<?php echo e(url('/password/reset')); ?>">
                <?php echo e(\App\Label::get("forgot_password")); ?>

        </a></p>
        <p><?php echo e(\App\Label::get("dont_have_account_yet")); ?> <a href="<?php echo e(url('/register')); ?>"><?php echo e(\App\Label::get("click_to_register")); ?></a></p>
    </div>

</div>

<script>
        
document.getElementById("login-btn").onclick = function(e){
    createCookie('help',1);
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-original', ['class'=>'login-page'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>