<?php $noti = count($sf_user->getGuardUser()->DestUserNotifications->getTable()->findByDQL('dest_user_id =? and is_active=?', array($sf_user->getGuardUser()->getId(),0)));?>

<a rel="pubs" class="count-button" <?php if ($noti > 0)
    echo 'style="opacity:1"'; ?>  href="#">
       <?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/pubs.png') ?>
    <span class="BoxCount" <?php if ($noti > 0)
           echo 'style="display:block"'; ?>>
        <span ><?php echo $noti ?></span>   
    </span>
</a>
<ul class="box" id="new-advices">
    <h2><a href="<?php echo sfConfig::get('app_base_url') ?>pubs" >Notifications <?php echo image_tag('/PubsPlugin/images/loading.gif')?></a></h2>
</ul>
