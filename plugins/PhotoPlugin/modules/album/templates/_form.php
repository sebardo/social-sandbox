
<form action="<?php echo url_for('album/create') ?>" method="post" accept-charset="utf-8" id="formAlbum" name="formLugar" enctype="multipart/form-data" >
      <?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="put" /><?php endif; ?>
    <?php echo $form; ?>
    <input id="enviarAlbum" type="submit" value="<?php echo $t[81] ?>" />
</form>
