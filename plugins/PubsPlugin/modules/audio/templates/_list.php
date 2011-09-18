<div class="tablaLista" id="tablaListaLugar">
    <div sasc="1" scol="" class="songListTitle clearFloat">
        <div class="col1" id="slCol1"></div>
        <div sort="0" class="idx"><span>#</span></div>
        <div sort="0" class="song"><span><?php echo __('SONG', null, 'audio') ?></span></div>
        <div sort="0" class="play"><span><?php echo __('PLAYS', null, 'audio') ?></span></div>
        <?php if ($sf_user->isAuthenticated()) { ?>
            <div class="options"><span><?php echo __('ACTIONS', null, 'audio') ?></span></div>
        <?php } ?>
    </div>
    <ul id="songListUl">
        <li class="songItemList" id="songItemList_000000" style="display: none"></li>
        <?php
        $k = 0;
        foreach ($audios as $audio):
            $k++;
            if ($k % 2 == 0) {
                $color = "#ffffff";
            } else {
                $color = "#e2e2e2";
            }
            ?>
            <li class="songItemList" id="songItemList_<?php echo $k ?>">
                <div class="playBtn clearfix">
                    <div class="gripper"></div>
                    <?php echo image_tag(sfConfig::get('app_base_url') .'PubsPlugin/images/play.png', 'name="' . $audio->getFilename() . '" title="' . $audio->getDescription() . '" id="' . $audio->getId() . '" class="play" style="cursor: pointer;"') ?>
                   
                </div>
                <div class="songIdx c">&nbsp;</div>
                <div id="<?php echo $audio->getId() ?>" class="edit songName"><?php echo $audio->getDescription() ?></div>
                
                <div id="plays_<?php echo $audio->getId() ?>" class="plays"><?php echo $audio->getPlays() ?></div>
                <div class="opt">
                    <?php if ($sf_user->isAuthenticated()) { ?>
                        <a id="delete_audio_<?php echo $k ?>" style="cursor:pointer" rel="delete"  href="<?php echo sfConfig::get('app_base_url')?>pubs/deleteConfirm?record_model=<?php echo $sf_context->getModuleName() ?>&record_id=<?php echo $audio->getId() ?>&div_id=songItemList_<?php echo $k ?>"><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/delete.png") ?></a>            
                        <a style="cursor:pointer" ><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/edit.png") ?> </a>
                        <a name="<?php echo $audio->getDescription() ?>" rel="<?php echo $audio->getFilename() ?>" class="jp-add" style="cursor:pointer"><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/add-audio.png", "width=20") ?> </a>
                        <?php } ?>
                </div>
            </li>
            <?php endforeach; ?>
    </ul>
</div>