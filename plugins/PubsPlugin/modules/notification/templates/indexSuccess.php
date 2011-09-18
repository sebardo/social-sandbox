<div class="notiContainer">
    <div class="noti_left">
        <div class="noti-header">
            <h1><?php echo __('Notifications List', null, 'notification')?></h1>
        </div>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li>
                    <?php include_partial('notification', array('notification' => $notification, 'image' => 'no')); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>