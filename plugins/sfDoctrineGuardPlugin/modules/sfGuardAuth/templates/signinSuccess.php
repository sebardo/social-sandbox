<div style="float: right">
    <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>

    <?php if (sfConfig::get('sf_app') != "backend") { ?>
        <?php echo use_stylesheet('/sfDoctrineGuardPlugin/css/sfGuardRegister.css') ?>
        <div class="register_form">
            <div class="mainTitle"><div class="mainTitle"><?php echo __('Sign up', null, 'sf_guard') ?></div></div>
            <?php echo get_component('sfGuardRegister', 'form') ?>
        </div>
    <?php } ?>
</div>
