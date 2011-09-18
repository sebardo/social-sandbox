<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="comments-items-form-<?php echo time()?>" class="comments-items-form" action="<?php echo url_for('comment/create' ) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php echo $form->renderHiddenFields(); ?>  
    <?php echo $form->renderGlobalErrors() ?>

    <?php echo $form['description']->renderError() ?>
    <?php echo $form['description']?>
</form>
