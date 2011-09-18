
<?php
use_helper('Date');
$x = $notification->getId();
?>

<div class="notification">

    <div class="noti-content">
        <?php if ($image == 'yes') { ?>
            <?php echo image_tag($notification->User->getImage(), 'width=50') ?>
        <?php } ?>
        <i class="<?php echo $notification->getRecordModel() ?>"></i>
        <a class="noti-author" href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $notification->User->getUsername() ?>">
            <?php echo $notification->User->getUsername() ?></a>

        <?php if ($notification->getRecordModel() == 'follow'): ?>
            <?php echo __('has approved your following request.', null, 'notification') ?>
        <?php elseif ($notification->getRecordModel() == 'link'): ?>
            <?php echo __('has published a', null, 'notification') ?> <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $notification->getRecordId() ?>"><?php echo __('link', null, 'notification') ?></a> <?php echo __('on your pubs.', null, 'notification') ?>
        <?php elseif ($notification->getRecordModel() == 'audio'): ?>
            <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=? and user_id=? and dest_user_id=?', array('audio', $notification->getRecordId(), $notification->getUserId(), $notification->getDestUserId())); ?>
            <?php $pub = $pubs[0] ?>
            <?php echo __('has published a', null, 'notification') ?> <a href="<?php echo sfConfig::get('app_base_url') ?>audio?user=<?php echo $notification->getUserId() ?>&aid=<?php echo $notification->getRecordId() ?>&autoplay=1"><?php echo __('audio', null, 'notification') ?></a> <a href="/pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('on your pubs.', null, 'notification') ?></a>.
        <?php elseif ($notification->getRecordModel() == 'photo'): ?>
            <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=? and user_id=? and dest_user_id=?', array('photo', $notification->getRecordId(), $notification->getUserId(), $notification->getDestUserId())); ?>
            <?php $pub = $pubs[0] ?>
            <?php echo __('has published a', null, 'notification') ?> <a href="<?php echo sfConfig::get('app_base_url') ?>photo/show?id=<?php echo $notification->getRecordId() ?>">photo</a> <a href="/pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('on your pubs.', null, 'notification') ?></a>.
        <?php elseif ($notification->getRecordModel() == 'text'): ?>
            <?php echo __('has published on', null, 'notification') ?> <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $notification->getRecordId() ?>">your pubs</a>.
        <?php elseif ($notification->getRecordModel() == 'comment'): ?>
            <?php echo __('comment your', null, 'notification') ?>
            <?php if ($notification->getRecordModel() == 'follow') { ?>
                <?php echo __('follow', null, 'follow') ?>
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'event') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>event/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('event', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'audio') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>audio?aid=<?php echo $notification->getRecordId() ?>&autoplay=1"><?php echo __('audio', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'photo') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>photo/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('photo', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'album_photo') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>album/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('Album', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'link') { ?>
                <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=?', array('link', $notification->getRecordId())); ?> 
                <?php $pub = $pubs[0]; ?> 
                <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('link', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'text') { ?>
                <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=?', array('text', $notification->getRecordId())); ?> 
                <?php $pub = $pubs[0]; ?> 
                <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('publication', null, 'notification') ?></a>.
            <?php } ?>

        <?php elseif ($notification->getRecordModel() == 'favlike'): ?>
            <?php echo __('like your', null, 'notification') ?>
            <?php if ($notification->getRecordModel() == 'follow') { ?>
                <?php echo __('follow', null, 'follow') ?>
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'comment') { ?>
                <?php $comment = Doctrine::getTable('comment')->find($notification->getRecordId()); ?>
                <?php $pub = Doctrine::getTable($comment->getRecordModel())->find($comment->getRecordId()); ?> 
                <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $pub->getId() ?>"><?php echo $notification->getRelatedModel() ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'event') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>event/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('event', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'audio') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>audio?aid=<?php echo $notification->getRecordId() ?>&autoplay=1"><?php echo __('audio', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'photo') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>photo/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('photo', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'album_photo') { ?>
                <a href="<?php echo sfConfig::get('app_base_url') ?>album/show?id=<?php echo $notification->getRecordId() ?>"><?php echo __('Album', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'link') { ?>
                <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=?', array('link', $notification->getRecordId())); ?> 
                <?php $pub = $pubs[0]; ?> 
                <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('link', null, 'notification') ?></a>.
            <?php } ?>
            <?php if ($notification->getRelatedModel() == 'text') { ?>
                <?php $pubs = Doctrine::getTable('pubs')->findByDql('record_model=? and record_id=?', array('text', $notification->getRecordId())); ?> 
                <?php $pub = $pubs[0]; ?> 
                <a href="<?php echo sfConfig::get('app_base_url') ?>pubs?pid=<?php echo $pub->getId() ?>"><?php echo __('publication', null, 'notification') ?></a>.
            <?php } ?>
        <?php endif; ?>
        <div class="noti-info">
            <?php echo format_date($notification->getCreatedAt(), "f") ?> 

        </div>
    </div>
</div>

