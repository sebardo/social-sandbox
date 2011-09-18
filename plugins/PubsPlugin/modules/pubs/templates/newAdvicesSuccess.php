<?php $newss = count($news) + count($newsfav) + count($newscom); ?>
<h2><a href="<?php echo sfConfig::get('app_base_url') ?>pubs" ><?php echo __('Notifications', null, 'notification')?></a></h2>
<?php foreach ($notifications as $notification): ?>
    <li>
        <?php include_partial('notification/notification', array('notification' => $notification, 'image' => 'yes')); ?>
    </li>
<?php endforeach; ?>

<div class="new-advice-footer"><a href="/notification"><?php echo __('See all notification', null, 'notification')?></a></div>