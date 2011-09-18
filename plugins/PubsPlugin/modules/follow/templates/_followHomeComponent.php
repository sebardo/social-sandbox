<div class="your-activity following-activity">
    <span class="following">
        <span class="home-right-component-title"><?php echo __('Following', null, 'follow') ?></span>
        <span class="user-stat-link">
            <?php echo count($datos->getFollowing())?>
        </span>
    </span>
    <?php if (count($datos->getFollowing()) > 0) {  ?>
        <?php foreach ($datos->getFollowing() as $following): ?>
            <?php $following_data = Doctrine::getTable('sfGuardUser')->findOneBy('id', $following->getFollowId()); ?>
            <li class="user-thumb-list-member">
                <a title="<?php echo $following_data->getUsername(); ?>" data-user-id="<?php echo $following->getFollowId() ?>" class="user-profile-link" href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $following_data->getUsername(); ?>">
                    <?php echo image_tag($following_data->getImage(), 'width=20px'); ?> 
                </a>
            </li>
        <?php endforeach; ?>
    <?php } ?>
</div>
<div class="your-activity new-followers-activity">
    <span class="followers">
        <span class="home-right-component-title"><?php echo __('Followers', null, 'follow') ?></span> <span class="user-stat-link">
         <?php echo count($datos->getFollower())?>
        </span>
    </span>
    <?php if (count($datos->getFollower()) > 0) {
        ?>
        <?php foreach ($datos->getFollower() as $follower): ?>
            <?php $follower_data = Doctrine::getTable('sfGuardUser')->findOneBy('id', $follower->getUserId()); ?>
            <li class="user-thumb-list-member">
                <a title="<?php echo $follower_data->getUsername(); ?>" data-user-id="<?php echo $follower->getUserId() ?>" class="user-profile-link" href="<?php echo sfConfig::get('app_base_url') ?>pubs?user=<?php echo $follower_data->getUsername(); ?>">
                    <?php echo image_tag($follower_data->getImage(), 'width=20px'); ?> 
                </a>
            </li>
        <?php endforeach; ?>
    <?php } ?>
</div>
