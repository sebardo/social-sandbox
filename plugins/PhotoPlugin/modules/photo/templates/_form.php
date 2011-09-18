<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php
echo url_for('photo/create'.((isset($isProfile)&&$isProfile) ? '?forProfile=1': ''));
        ?>" method="post" accept-charset="utf-8" id="form<?php echo (isset($isProfile)&&$isProfile) ? 'Profile': '';?>Photo" name="formPhoto" enctype="multipart/form-data">
    <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>

    <div class="contForm">
        <div class="subGroup">
            <div>
                <div class="label">
                    <label for="photo_title"><?php echo __('Title', null, 'photo')?></label>
                </div>
                <div class="field">
                    <?php echo $form['title']->render() ?>
                </div>
            </div>

            <div>
                <div class="field">
                    <?php echo $form['name']->render() ?>
                </div>
                    <?php echo $form['name']->renderError();?>
            </div>
            <?php echo $form->renderHiddenFields(); ?>
        </div>
        <div id="footForm">
            <input id="sendImage" type="submit" value="<?php echo __('Send', null, 'photo')?>" class="button" />
            <input type="reset" value="<?php echo __('Cancel', null, 'photo')?>" id="cancel" class="button"/>
        </div>
    </div>

</form>
