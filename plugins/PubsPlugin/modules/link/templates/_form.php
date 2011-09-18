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
        $('#publish').click(function(){
            $('#facebox',window.parent.document).find('#loading').show();   
        });
        
        $('#facebox',window.parent.document).find('#loading').hide();
<?php if ($form->getObject()->isNew()): ?>    
                    var valType = new LiveValidation('link_url');
                    valType.add( Validate.Presence , { failureMessage: "<?php echo __("Can't be empty!", null, 'pubs')?>" } );
                    valType.add( Validate.Inclusion, { within: [ 'http://' ] , partialMatch: true , failureMessage: "<?php echo __('Must be contain a URL', null, 'pubs')?>" } );
<?php endif; ?>
                $('#form_new_link').submit(function(){
                    if($(this).find('.LV_invalid').text() == '') 
                        $('#facebox',window.parent.document).find('#loading').show();
               
                });
            });
</script>

<form id="form_new_link" action="<?php echo url_for('link/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2" align="right">
                    <?php echo $form->renderHiddenFields(false) ?>
                    <?php if (!$form->getObject()->isNew()): ?>

                        &nbsp;<?php echo link_to('Delete', 'link/delete?id=' . $form->getObject()->getId() . '&duid=' . $duid, array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
                        &nbsp;<?php echo link_to('Publish', 'pubs/publishing?model=link&duid=' . $duid . '&record=' . $form->getObject()->getId(), array('class' => 'button', 'id' => 'publish')) ?>
                    <?php endif; ?>


                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <?php if ($form->getObject()->isNew()): ?>
                <tr>
                    <td>
                        <?php echo $form['url']->render(array('size' => '30')) ?>
                    </td>
                    <td valign="top"><input type="submit" value="<?php echo __('Attach', null, 'pubs')?>" class="button" style="float: right" /></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>
