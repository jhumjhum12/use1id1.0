

<?php $__env->startSection('headline', 'Your email authentication is required'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: left; color: #1c2742">
        <span class="receiver-greeting" style="font-weight: bold; font-size: 18px; line-height: 36px;">Hi <?php echo e($user->first_name); ?>,</span>

        <p>Thank you for registering with 1ID.</p>

        <p>There is ONE MORE STEP to complete your registration. For security reasons, please confirm your email address
            by clicking the following link. Once your email address has been verified your account will be automatically
            activated:</p>

        <table cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" width="350px" height="40" bgcolor="#42566f"
                    style="color: #ffffff; display: block; -o-border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;">
                    <a href="<?php echo e($url); ?>"
                       style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block;">Click
                        Here to Confirm Your Email Address</a>
                </td>
            </tr>
        </table>

        <p>Upon successfully registering your account you can start using 1ID.</p>
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>