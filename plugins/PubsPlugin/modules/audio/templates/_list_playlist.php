<div sasc="1" scol="" class="listListTitle clearFloat">
    <div class="col1" id="slCol1"></div>
    <div sort="0" class="idx"><span>#</span></div>
    <div sort="0" class="list"><span><?php echo __('LIST NAME', null, 'audio') ?></span></div>
    <div sort="0" class="play"><span><?php echo __('PLAYS', null, 'audio') ?></span></div>
    <?php if($sf_user->isAuthenticated()) { ?>
        <div class="options"><span><?php echo __('ACTIONS', null, 'audio') ?></span></div>
    <?php } ?>
</div>
<ul id="listListUl">
    <?php 
    $k = 0;
    foreach ($playlists as $playlist):
        $string = $playlist->getDescription();
        $k++; if ($k % 2 == 0) { $color = "#ffffff";} else { $color = "#e2e2e2"; }
        ?>
        <li class="listItem" id="listItem_<?php echo $playlist->getId() ?>">
            <div class="playBtn clearfix">
                <div class="gripper"></div>
                <img name='<?php echo $string; ?>' title="Reproducir Playlist" src="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/images/play.png" id="<?php echo $playlist->getId() ?>" class="play-playlist" style="cursor: pointer;">
            </div>
            <div class="listIdx">1</div>
            
            
            <div class="listDescription">
            <div id="<?php echo $playlist->getId() ?>" class="edit listName">
                    <?php echo $playlist->getName() ?>
            </div>
            <?php  if($string != ""){  ?>
              <div id="playlist_<?php echo $playlist->getId()?>" style='display:none'>
                <?php
                $json_o=json_decode($string);
                $y=0;
                foreach ($json_o AS $property ){
                  foreach ($property AS $indice => $valor){             
                    if($indice == "name"){
                      $y++;
                      echo "<span id='name_song'>".$y." - ".$valor."</span><br>";
                    }
                  }
                }?>
                  </div>
            <?php }?>
            </div>  
            
            
           <div id="list_plays_<?php echo $playlist->getId() ?>" class="plays">
                    <?php echo $playlist->getPlays() ?>
           </div>
           <div class="opt">
             <?php if ($sf_user->isAuthenticated()) { ?>
                        <i  id="<?php echo $playlist->getId()?>"  class="view_pl view-playlist"></i>
                        <a id="delete_playlist_<?php echo $playlist->getId() ?>" style="cursor:pointer" rel="delete"  href="<?php echo sfConfig::get('app_base_url')?>pubs/deleteConfirm?record_model=playlist&record_id=<?php echo $playlist->getId() ?>&div_id=listItem_<?php echo $playlist->getId() ?>"><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/delete.png") ?></a>            
                        <a style="cursor:pointer"  onclick=editar('<?php echo $playlist->getId() ?>')><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/edit.png") ?> </a>
                        <a  rel='<?php echo $string; ?>' class="jp-add-playlist" style="cursor:pointer"><?php echo image_tag(sfConfig::get('app_base_url') ."PubsPlugin/images/add-audio.png", "width=20") ?> </a>
             <?php  } ?>
           </div>
            
        </li>
    <?php endforeach; ?>
</ul>
