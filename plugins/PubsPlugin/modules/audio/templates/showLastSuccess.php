<li class="songItemList" id="songItemList_<?php echo $k ?>">
    <div class="playBtn clearfix">
        <div class="gripper"></div>
        <?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/play.png', 'name="' . $audio->getFilename() . '" title="' . $audio->getDescription() . '" id="' . $audio->getId() . '" class="play" style="cursor: pointer;"') ?>
    </div>
    <div class="songIdx c">&nbsp;</div>
    <div id="<?php echo $audio->getId() ?>" class="edit songName"><?php echo $audio->getDescription() ?></div>
    <div id="plays_<?php echo $audio->getId() ?>" class="plays"><?php echo $audio->getPlays() ?></div>
    <div class="opt">
        <?php if ($sf_user->isAuthenticated()) { ?>
            <a id="delete_audio_<?php echo $k ?>" style="cursor:pointer" rel="delete"  href="<?php echo sfConfig::get('app_base_url')?>pubs/deleteConfirm?record_model=<?php echo $sf_context->getModuleName() ?>&record_id=<?php echo $audio->getId() ?>&div_id=songItemList_<?php echo $k ?>"><?php echo image_tag("/PubsPlugin/images/delete.png") ?></a>            
            <a style="cursor:pointer" ><?php echo image_tag(sfConfig::get('app_base_url')."PubsPlugin/images/edit.png") ?> </a>
            <a name="<?php echo $audio->getDescription() ?>" rel="<?php echo $audio->getFilename() ?>" class="jp-add" style="cursor:pointer"><?php echo image_tag(sfConfig::get('app_base_url')."PubsPlugin/images/add-audio.png", "width=20") ?> </a>
        <?php } ?>
    </div>
</li>
<script type="text/javascript">
$('.play').click(function(){
    parent.hola();
});
    $('a[rel*=delete]').unbind('keydown.facebox');
    $('a[rel*=delete]').facebox();
</script>