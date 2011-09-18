<?php include_javascripts(); ?>
<style type="text/css">
    .LV_valid{
        display: none;
    }
    .LV_invalid{
        color: #FF0000;
        display: block;
        font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
        font-size: 12px;
        margin-left: 10px;
        text-align: left;
        float: left;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
         $('#facebox',window.parent.document).find('#loading').hide();
        var valType = new LiveValidation('text_description');
        valType.add( Validate.Presence, { failureMessage: "<?php echo __("Can't be empty!", null, 'pubs')?>" } );
        $('#form_new_text').submit(function(){
            if($(this).find('.LV_invalid').text() == '') 
                $('#facebox',window.parent.document).find('#loading').show();
        });
    });
</script>
<form id="form_new_text" action="<?php echo url_for('text/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="dest_user_id" value="<?php echo $sf_request->getParameter('duid') ?>" />



    <?php //echo $form->renderGlobalErrors() ?>


    <?php echo $form['description']->renderError() ?>
    <?php echo $form['description'] ?>

    <?php echo $form->renderHiddenFields() ?>
    <input type="submit" value="<?php echo __('Save', null, 'pubs')?>" class="button" style="float: right"/>

</form>
