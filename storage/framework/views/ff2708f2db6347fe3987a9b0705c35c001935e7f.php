<div class="my-data-heading">
    <img class="img-circle" src="<?php echo e($user->getImage()); ?>" width="120">
    &nbsp;
    <img src="<?php echo e($user->getQRCode()); ?>" width="120" />

    <br /><br />
    <h1><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </h1>
</div>



<table class="user-info-table">
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('id')); ?></td>
            <td><?php echo e($user->getPersonalId()); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('personal_id')); ?></td>
            <td><?php echo e($user->personal_id); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('i_mail')); ?></td>
            <td><?php echo e($user->email); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('first_name')); ?></td>
            <td><?php echo e($user->first_name); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('last_name')); ?></td>
            <td><?php echo e($user->last_name); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('gender')); ?></td>
            <td><?php echo e($user->getGender()); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('middle_name')); ?></td>
            <td><?php echo e($user->middle_name); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('nickname')); ?></td>
            <td><?php echo e($user->nickname); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('birthday')); ?></td>
            <td><?php echo e($user->birthday); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('country_of_birth')); ?></td>
            <td><?php echo e(Label::getCountry($user->country_of_birth)); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('city_of_birth')); ?></td>
            <td><?php echo e($user->place_of_birth); ?></td>
        </tr>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('blood_type_group')); ?></td>
            <td><?php echo e($user->getBloodType()); ?></td>
        </tr>
        <?php if(isset($myOwn)): ?>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('selected_language')); ?></td>
            <td><?php echo e($user->language->lang_txt); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="mydata-user"><?php echo e(Label::get('address')); ?></td>
            <td><?php echo e($user->street); ?> <?php echo e($user->house_number); ?><br /><?php echo e($user->postal_code); ?> <?php echo e($user->city); ?></td>
        </tr>
    </table>