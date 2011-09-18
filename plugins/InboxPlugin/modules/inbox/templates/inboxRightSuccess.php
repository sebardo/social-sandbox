<script>
    $(document).ready(function()
    {
<?php if ($first_message) { ?>
            $('#new-reply').click(function(key){
                if($('#inbox_description').val() != ''){
                    $('#loading').show();
                    var user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
                    var user_id_a = '<?php echo $dest ?>';
                    var msj = $('#inbox_description').val();
                    var record_id = $('#inbox_record_id').val();
                    $.getJSON(base_url+"inbox/insertReply?id="+user_id+"&id_a="+user_id_a+"&message="+msj+"&record_id="+record_id,
                    function(data){
                        $.get(base_url+"inbox/lastReply?recordId=<?php echo $first_message->getId() ?>",
                        function(info){
                            $('.pane-components-inner .component').append(info);
                            $('#inbox_description').val('');
                            $('#loading').hide();
                        });
                    });
                }
            });
<?php } ?>  
    });
</script>
<?php if ($first_message) { ?>
    <?php $datos_dest = Doctrine::getTable('sfGuardUser')->find($first_message->getUserId()); ?>
<?php } ?>                     
<div class="details-pane">
    <div class="inner-pane active">
        <div class="pane-toolbar pane-built-in">
            <br style="clear: both;">
            <div class="component gray-component send-message-box">
                <?php include_partial('newReply', array('form' => $form, 'first_message' => $first_message, 'dest' => $dest)) ?>

            </div>
        </div>
        <div class="pane-components" >
            <div class="pane-components-inner">
                <div class="component">
                    <?php echo include_component('inbox', 'listReplys', array('record_id' => $first_message->getRecordId())) ?>
                </div>
            </div>
        </div>
    </div>
</div>
