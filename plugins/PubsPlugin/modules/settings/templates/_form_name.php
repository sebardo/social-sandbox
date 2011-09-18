<fieldset class="labelLeft">
    <legend></legend>
    <p>
        <label for="contactAddress">
			<?php echo __('Email Address', null, 'setting')?></label>
        <?php echo $form['email_address']->render() ?>
        <span class="error">
            <?php echo $form['email_address']->renderError(); ?>
        </span>
    </p>
    <p>
        <label for="displayName"><?php echo __('Username', null, 'setting')?></label>
        <?php echo $form['username']->render() ?>
    </p>
    <?php if ($form['username']->hasError()){?>
    <p class="error">
        <label></label>
        <span class="error">
            <?php echo $form['username']->renderError(); ?>
        </span>
    </p>
    <?php } ?>
    <p class="">
        <label for="firstName"><?php echo __('Name', null, 'setting')?></label>
        <?php echo $form['first_name']->render() ?>
            <span class="error">
            <?php echo $form['first_name']->renderError(); ?>
        </span>
    </p>
    <p class="">
        <label for="lastName"><?php echo __('Last Name', null, 'setting')?></label>
        <?php echo $form['last_name']->render() ?>
            <span class="error">
            <?php echo $form['last_name']->renderError(); ?>
        </span>
    </p>
<!--    <p class="">
        <label></label>
        <input type="checkbox" checked="" value="true" name="showFullName">
	Mostrar todos mis datos en las busquedas de personas, mi nombre y foto, etc.
    </p>-->
    <p class="save right">
        <button class="button" type="submit"><?php echo __('Save changes', null, 'setting')?>
            <span class="saveSuccess"></span>
        </button>
    </p>

    <?php echo $form->renderHiddenFields(); ?>
</fieldset>

