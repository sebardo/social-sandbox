
<?php
use_helper('Date');
$obj = $pubs->getObject();
$obj = $obj[0];
$x = $pubs->getId();
?>
<ul class="pubs"><li>
        <div  id="<?php echo $pubs->getId() ?>" class="pub-item">
            <?php echo image_tag($pubs->getUser()->getImage(), 'width=50') ?>
            <div class="pub-content" >
                <div class="pub-author" <?php if ($pubs->getRecordModel() == 'follow' || $pubs->getRecordModel() == 'location')
                echo 'style="float: left"' ?>>
                    <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $pubs->User->getUsername() ?>">
<?php echo $pubs->User->getUsername() ?>
                    </a>
                </div>
                <?php if ($pubs->getRecordModel() == 'location'): ?>
                    <?php include_component('location', 'locationPub', array('id' => $obj->getId())) ?>   
                <?php elseif ($pubs->getRecordModel() == 'follow'): ?>
                    <?php include_component('follow', 'followPub', array('obj' => $obj)) ?>   
                <?php elseif ($pubs->getRecordModel() == 'link'): ?>
                    <?php include_component('link', 'link', array('id' => $obj->getId())) ?>
                <?php elseif ($pubs->getRecordModel() == 'audio'): ?>
                    <?php include_component('audio', 'audio', array('id' => $obj->getId())) ?>
                <?php elseif ($pubs->getRecordModel() == 'photo'): ?>
                    <?php include_component('photo', 'pubContent', array('pub' => $pubs, 'obj' => $obj)); ?>
                <?php elseif ($pubs->getRecordModel() == 'album_photo'): ?>
                    <?php include_component('album', 'pubContent', array('pub' => $obj)); ?>
                <?php else: ?>
                    <!--text-->
                    <?php echo $obj->getDescription() ?>
                <?php endif; ?>

<?php if ($sf_user->isAuthenticated()): ?>
                    <div class="pub-info">
                        <i class="<?php echo $pubs->getRecordModel() ?>"></i>
                        <?php echo distance_of_time_in_words(strtotime($pubs->getCreatedAt()), strtotime($pubs->getFormatDate()), false) ?>
                        <?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { // si estoy en mi muro  ?>
                            <b>·</b><a id="delete-action-<?php echo $x ?>" class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=pubs<?php //echo $sf_context->getModuleName() ?>&record_id=<?php echo $pubs->getId() ?>&div_id=<?php echo $x ?>"><span><i class="delete"></i><?php echo __('Delete', null, 'pubs') ?></span></a>
                        <?php } else { ?> 
                            <?php if ($sf_user->getGuardUser()->getId() == $pubs->User->getId()) { // o si soy dueño de la publicacion  ?>
                                <b>·</b><a id="delete-action-<?php echo $x ?>" class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=pubs<?php //echo $sf_context->getModuleName() ?>&record_id=<?php echo $pubs->getId() ?>&div_id=<?php echo $x ?>"><span><i class="delete"></i><?php echo __('Delete', null, 'pubs') ?></span></a>
                            <?php } ?> 
    <?php } ?>
                        <b>·</b>
                        <span>
                            <i class="favlike"></i>
    <?php include_component('favlike', 'favlikes', array('object' => $obj, 'model' => $pubs->getRecordModel(), 'id' => $x)) ?>
                        </span>
                        <b>·</b>
                        <a rel="delete" href="<?php echo sfConfig::get('app_base_url') ?>pubs/share?url=<?php echo sfConfig::get('app_base_url') ?>pubs/sharePub?pid=<?php echo $pubs->getId() ?>">
                            <span>
                                <i class="share"></i>
    <?php echo __('Share', null, 'pubs') ?>
                            </span>
                        </a>
                        <b>·</b>
                    <?php include_component('comment', 'comments', array('object' => $obj, 'model' => $pubs->getRecordModel(), 'datos' => $datos)) ?>
                    </div>
<?php endif; ?>
            </div>

        </div>
    </li></ul>
