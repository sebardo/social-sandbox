<span id="favlike-action-<?php echo $id ?>" class="favlike-item" data="<?php echo sfConfig::get('app_base_url') ?>favlike/favlike?user_id=<?php echo $sf_user->getGuardUser()->getId() ?>&dest_user_id=<?php echo $object->getUserId() ?>&record_model=<?php echo $model ?>&record_id=<?php echo $object->getId() ?>&div_id=favlike-action-<?php echo $id ?>"  href="#">
     <?php echo __('Like', null , 'pubs')?> (<?php echo count($favlikes); ?>)
</span>  
