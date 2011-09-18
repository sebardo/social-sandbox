
<?php
use_helper('Date');
$obj = $pubs->getObject();
$obj = $obj[0];
$x = $pubs->getId();
?>
<ul class="pubs"><li>
        <div  id="<?php echo $pubs->getId() ?>" class="pub-item">
            <?php echo image_tag($pubs->getDestUser()->getImage(), 'width=50') ?>
            <div class="pub-content">
                <div class="pub-author" <?php if ($pubs->getRecordModel() == 'follow')echo 'style="float: left"' ?>>
                    <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $pubs->User->getUsername() ?>">
                        <?php echo $pubs->DestUser->getUsername() ?>
                    </a>
                </div>
                <?php if ($pubs->getRecordModel() == 'location'): ?>
                    <?php include_component('location', 'locationPub', array('id' => $obj->getId())) ?>   
                <?php elseif ($pubs->getRecordModel() == 'event'): ?>
                <span style="display: block"><a href="/event/show/id/<?php echo $obj->getId()?>"><b><?php echo $obj->getName() ?></b></a></span>
                <span style="display: block"><b>Date:</b> <?php echo $obj->getDate() ?></span>
                <span style="display: block"><b>Address:</b> <?php echo $obj->getAddress() ?></span>
                <span style="display: block"><?php echo $obj->getDescription() ?></span>
                <?php elseif ($pubs->getRecordModel() == 'comment'): ?>
                <span style="display: block"><?php echo $obj->getDescription() ?></span>
                <?php elseif ($pubs->getRecordModel() == 'follow'): ?>
                   <?php include_component('follow', 'followPub', array('obj' => $obj))?>   
                <?php elseif ($pubs->getRecordModel() == 'link'): ?>
                    <?php include_component('link', 'link', array('id' => $obj->getId()))?>
                <?php elseif ($pubs->getRecordModel() == 'audio'): ?>
                    <?php include_component('audio', 'audio', array('id' => $obj->getId())) ?>
                <?php elseif ($pubs->getRecordModel() == 'photo'): ?>
                    <?php include_component('photo', 'pubContent', array('obj' => $obj)); ?>
                <?php elseif ($pubs->getRecordModel() == 'album_photo'): ?>
                    <?php include_component('album', 'pubContent', array('pub' => $obj)); ?>
                <?php else: ?>
                    <?php echo $obj->getDescription() ?>
                <?php endif; ?>
                <div class="pub-info" style="display: block!important">
                    <i class="<?php echo $pubs->getRecordModel() ?>"></i>
                    <?php echo format_date($pubs->getCreatedAt(), "f") ?> 
                    <?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { // si estoy en mi muro ?>
                        <b>·</b><a id="delete-action-<?php echo $x ?>" class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=favlike&record_id=<?php echo $pubs->getId() ?>&div_id=<?php echo $x ?>"><span><i class="delete"></i>Delete</span></a>
                    <?php } else { ?> 
                        <?php if ($sf_user->getGuardUser()->getId() == $pubs->User->getId()) { // o si soy dueño de la publicacion ?>
                            <b>·</b><a id="delete-action-<?php echo $x ?>" class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=favlike&record_id=<?php echo $pubs->getId() ?>&div_id=<?php echo $x ?>"><span><i class="delete"></i>Delete</span></a>
                        <?php } ?> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </li></ul>
