<div class="inbox-box">
    <div class="inbox-box-title">
        <?php $datos_dest = Doctrine::getTable('sfGuardUser')->find($dest); ?>
        <h2><?php echo __('Send a message to', null, 'inbox') ?>  <?php echo $datos_dest->getUsername() ?></h2>
    </div>
    <form name="form_new_message" id="form_new_message" class="form_new_message" action="" method="post" enctype="multipart/form-data">
        <div>
            <?php echo $form['description']->render(array("class" => "box-editor")) ?>
            <?php if ($form['description']->renderError())
                $form['description']->renderError() ?>
        </div>
        <div style="margin-top: 5px;">
            <span id="loading" style="display: none"><?php echo image_tag(sfConfig::get('app_base_url') . '/PubsPlugin/images/loading.gif') ?></span>&nbsp;&nbsp;
            <a id="new-reply"  class="button new-reply" href="#"><?php echo __('Send', null, 'inbox') ?></a>
        </div>
        <?php echo $form->renderHiddenFields(); ?>
    </form>
</div>                
