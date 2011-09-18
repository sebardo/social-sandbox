
<div id="previewPhoto" style="min-height:250px;min-width:250px;" >
    <div style="position:absolute;background-color: #000000;">
        <a class="button publish" href="#" style="margin:10px;"><?php echo __('Publish', null, 'photo')?></a>
        <a class="button nyroModalClose" href="#" style="margin:10px;"><?php echo __('Close', null, 'photo')?></a>
    </div>
    <?php echo image_tag('../'.$photo->getLink('big'),'style=max-height: 500px;');?>
</div>
<script type="text/javascript">
    var isWall=<?php echo sfContext::getInstance()->getModuleName()=='pubs'?'true':'false';?>;
    var sendingPubication=false;
    $('#previewPhoto .publish').click(function(e){
        if(!sendingPubication){
            e.preventDefault();
            sendingPubication=true;
            var user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
            var dest_user_id = '<?php echo $sf_user->getGuardUser()->getId() ?>';
            var record = '<?php echo $photo->getAlbum()->getId(); ?>';
            var model='album_photo';
            $.post('<?php echo url_for('/pubs/insertPub'); ?>',{user_id:user_id,dest_user_id:dest_user_id,record:record,model:model,view:true},function(result){
                 if(result){
                     $('.top-center-pubs',parent.document).after(result);
                }
                $('.nyroModalClose').click();
                sendingPubication=false;
            });
        }
    });
</script>