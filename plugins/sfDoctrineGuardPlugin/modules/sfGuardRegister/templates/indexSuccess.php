<?php use_helper('I18N') ?>

<?php if ($sf_user->getFlash('notice') == "register_ok") { ?>
    <div class="register_ok" style="float: right">
        <div class="mainTitle"><?php echo __('Registration Complete', null, 'sf_guard') ?> </div>
        <div class="subtitle"><?php echo __('You can access the Social Network.', null, 'sf_guard') ?></div>
    </div>  
<?php } elseif ($sf_user->getFlash('notice') == "send_mail") { ?>
    <div class="register_ok" style="float: right">
        <div class="mainTitle"><?php echo __('Your registration was successful', null, 'sf_guard') ?></div>
        <div class="subtitle"><?php echo __('We sent a message to your e-mail with instructions for activating your account.', null, 'sf_guard') ?> </div>
    </div>  
<?php } else { ?>
    <div class="register_form_page">
        <div class="mainTitle"><?php echo __('Sign up', null, 'sf_guard') ?></div>
        <?php echo get_component('sfGuardRegister', 'form') ?>
    </div>
<?php } ?>
