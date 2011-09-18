<?php use_helper('Date') ?> 
<div id="comment-<?php echo $comment->getId() ?>"  class="comment-item">
    <a href="<?php echo sfConfig::get('app_base_url').'pubs?user='.$comment->User->getUsername()?>">
        <?php echo image_tag($comment->User->getImage(), 'width=35') ?>
    </a>
    <a href="<?php echo sfConfig::get('app_base_url').'pubs?user='.$comment->User->getUsername()?>">
        <b><?php echo $comment->User->getUsername(); ?></b> 
    </a><?php echo $comment->getDescription() ?>
    <div><?php echo format_date($comment->getCreatedAt(), "f") ?> 
        · <?php include_component('favlike', 'favlikes', array('object' => $comment, 'model' => 'comment', 'id' => rand(0, 999999))) ?>
        <?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { // si estoy en mi muro ?>
            · <a class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=comment&record_id=<?php echo $comment->getId() ?>&div_id=comment-<?php echo $comment->getId() ?>"><span><?php echo __("Delete", null, 'pubs')?></span></a>
        <?php } else { ?> 
            <?php if ($sf_user->getGuardUser()->getId() == $comment->User->getId()) { // o si soy dueño de la publicacion ?>
                · <a class="delete-action" rel="delete"  href="<?php echo sfConfig::get('app_base_url') ?>pubs/deleteConfirm?record_model=comment&record_id=<?php echo $comment->getId() ?>&div_id=comment-<?php echo $comment->getId() ?>"><span><?php echo __("Delete", null, 'pubs')?></span></a>
            <?php } ?> 
        <?php } ?>
    </div>             
</div>