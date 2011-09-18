<style type="text/css">
    .LV_valid{
        background-image: url("<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/images/sprite-icons.png");
        background-position: -141px -304px;
        display: inline-block;
        height: 13px;
        margin-left: 10px;
        width: 18px;
        text-indent: -999999px
    }
    .LV_invalid{
        color: #FF0000;
        display: block;
        font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
        font-size: 12px;
        margin-left: 10px;
        text-align: left;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#loading',window.parent.document).hide();
        $('#facebox',window.parent.document).find('#loading').hide();
<?php if ($form->getObject()->isNew()): ?>    
            var valType = new LiveValidation('audio_filename');
            valType.add( Validate.Presence , { failureMessage: "<?php echo __("Select an mp3", null, 'audio')?>" });
            valType.add( Validate.Inclusion, { within: [ 'mp3' ], partialMatch: true, failureMessage: "<?php echo __("File types supported [mp3]", null, 'audio')?>"  } );
<?php endif; ?>

        $('#form_new_audio').submit(function(){
            if($(this).find('.LV_invalid').text() == '') 
                $('#facebox',window.parent.document).find('#loading').show();
            $('#loading',window.parent.document).show();
        });
    });
</script>   
<div>
    <form id="form_new_audio" action="<?php echo url_for('audio/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

        <?php if ($form->getObject()->isNew()): ?>
            <div>
                <span class="help"> <?php echo __('Select a mp3 file from your computer.', null, 'audio') ?> </span>
                <?php echo $form['filename']->render(array("size" => "30")) ?>
                <span class="error">
                    <?php echo $form['filename']->renderError() ?>
                </span>
            </div>
        <?php endif; ?>        
        <table>
            <tr>
                <?php if ($form->getObject()->isNew()): ?>
                    <td>
                        <span class="help"><?php echo __('Description', null, 'audio') ?></span>
                    </td>
                    <td>
                        <?php echo $form['description']->renderError() ?>
                        <?php echo $form['description']->render(array("size" => "25")) ?>
                        <?php echo $form->renderHiddenFields() ?>
                    </td>
                <?php endif; ?>  
                <td align="right">
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to(__('Delete', null, 'audio'), 'audio/delete?id=' . $form->getObject()->getId() . '&duid=' . $duid, array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
                        &nbsp;<?php echo link_to(__('Publish', null, 'audio'), 'pubs/publishing?model=audio&duid=' . $duid . '&record=' . $form->getObject()->getId(), array('class' => 'button', 'id' => 'publish')) ?>
                    <?php endif; ?>
                    <?php if ($form->getObject()->isNew()): ?>
                        <input type="submit" class="button" value="<?php echo __('Upload', null, 'audio') ?>" style="float:right" />
                        <?php echo $form->renderGlobalErrors() ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form> 
</div>