<?php $news = $sf_user->getGuardUser()->getNewMessages() ?>
<a rel="inbox" class="count-button" <?php if ($news > 0)
    echo 'style="opacity:1"'; ?>  href="#">
       <?php echo image_tag(sfConfig::get('app_base_url').'InboxPlugin/images/inbox.png') ?>
    <span id="FollowOuterUnseenCount" class="BoxCount" <?php if ($news > 0)
           echo 'style="display:block"'; ?>>
        <span id="FollowInnerUnseenCount"><?php echo $news ?></span>   
    </span>
</a>
<ul class="box" id="new-messages">
    <h2><a href="<?php echo sfConfig::get('app_base_url') ?>inbox" >Inbox <?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif') ?></a></h2>
</ul>