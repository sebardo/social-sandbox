<?php include_javascripts(); ?>
<style type="text/css">
    table, .help{font-family: "lucida grande",tahoma,verdana,arial,sans-serif;font-size: 12px;}
    table{width: 100%;}
    table.new_short td{padding-right: 5px;}
    .help{color: #999999;padding-bottom: 5px;display: block;}
    .new_photo{text-align: left;}
    .new_photo form{
        margin-bottom: 0px;
    }
    .LV_valid{
        background-image: url("/PubsPlugin/images/sprite-icons.png");
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
        text-align: left;
    }
    .button{
        float: right;
        -moz-border-radius: 4px 4px 4px 4px;
        background: url("https://si2.twimg.com/a/1302111227/phoenix/img/buttons/bg-btn.gif") repeat-x scroll 0 0 #DDDDDD;
        border-color: #BBBBBB #BBBBBB #999999;
        border-style: solid;
        border-width: 1px;
        color: #333333;
        cursor: pointer;
        margin: 0;
        overflow: hidden;
        padding: 5px 9px;
        text-shadow: 0 1px #F0F0F0;
    }
    .contPubPhoto{
        display: inline-block
    }
    .contPubPhoto a {
    border: 1px solid #CCCCCC;
    display: inline-block;
    margin-right: 2px;
    padding: 2px;
}
</style>
<script>
    jQuery(document).ready(function($) {
        $('#loading',parent.document).hide();

        <?php if (!$isUploaded): ?>
        var valType = new LiveValidation('photo_name');
        valType.add( Validate.Presence,{failureMessage: "<?php echo __("Select a image", null, 'photo')?>"} );
        valType.add( Validate.Inclusion, { within: [ '.jpg' , '.png', '.gif', '.JPG', '.PNG', '.GIF'  ], partialMatch: true, failureMessage: "<?php echo __("File types supported [jpg, png, gif]", null, 'photo')?>"  } );
        $('#form_new_photo').submit(function(){
                 if($(this).find('.LV_invalid').text() == '') 
                 $('#loading',window.parent.document).show();
        });
        <?php endif; ?>
            
        <?php if ($isUploaded): ?>
            $('#facebox',window.parent.document).animate({height:'160px'}, 500);
            $('.pop_up',window.parent.document).animate({height:'160px'}, 500);
            $('.content',window.parent.document).animate({height:'160px'}, 500);
            $('.iframeNewPhotoSuccess',window.parent.document).animate({height:'160px'}, 500);
            $.post('<?php echo url_for('photo/previewPubliPhoto'); ?>',{'photo_id':'<?php echo $photo->getId(); ?>'},function(result){});
        <?php endif; ?>
    });
</script>
<div class="new_photo">
    <form name="form_new_photo" id="form_new_photo" class="form_new_photo_short" action="<?php echo url_for('photo/share?duid=' . $dest_user_id); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
        
      <?php if ($form->getObject()->isNew()){ ?>
            <div>
                <span class="help"> <?php echo __('Select an image file from your computer.', null, 'photo')?> </span>
                <?php echo $form['name']->render(array("size" => "25")) ?>
                <span class="error">
                    <?php echo $form['name']->renderError() ?>
                </span>
            </div>
        <?php }elseif (!$form->getObject()->isNew()){ ?>
            <div style="overflow:hidden">
              <?php include_component('photo', 'pubContent', array('obj' => $form->getObject())); ?>
            </div>
        <?php } ?> 
        <table>
            <tr>
                <?php if ($form->getObject()->isNew()): ?>
                    <td>
                        <span class="help"><?php echo __('Title', null, 'photo')?></span>
                    </td>
                    <td>
                        <?php echo $form['title']->renderError() ?>
                        <?php echo $form['title']->render(array("size" => "25")) ?>
                        <?php echo $form->renderHiddenFields() ?>
                        
                    </td>
                <?php endif; ?>  
                <td align="right">
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to(__('Delete', null, 'photo'), 'photo/deletePreview?photoId=' . $form->getObject()->getId() . '&duid=' . $duid, array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
                        &nbsp;<?php echo link_to(__('Publish', null, 'photo'), 'pubs/publishing?model=photo&duid=' . $duid . '&record=' . $form->getObject()->getId(), array('class' => 'button', 'id' => 'publish')) ?>
                    <?php endif; ?>
                    <?php if ($form->getObject()->isNew()): ?>
                        <input type="submit" class="button" value="<?php echo __('Upload', null, 'photo')?>" style="float:right" />
                        <?php echo $form->renderGlobalErrors() ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>
</div>




