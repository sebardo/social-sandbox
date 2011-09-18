<div class="your-activity following-activity">
    <span class="following">
        <span class="home-right-component-title">Siguiendo</span>
        <span class="user-stat-link">
            <?php
            $followings = Doctrine::getTable('Wall')->getFollowings($datos->getId());
            echo count($followings);
            ?>
        </span>
    </span>
    <?php if (count($followings) > 0) { ?>
        <?php foreach ($followings as $following): ?>
            <?php $following_data = Doctrine::getTable('sfGuardUser')->findOneBy('id', $following->getFollowId()); ?>
            <li class="user-thumb-list-member">
                <a title="<?php echo $following_data->getUsername(); ?>" data-user-id="<?php echo $following->getFollowId() ?>" class="user-profile-link" href="wall?user=<?php echo $following_data->getUsername(); ?>">
                    <?php echo image_tag($following_data->getImage(), 'width=20px'); ?> 
                </a>
            </li>
        <?php endforeach; ?>
    <?php } ?>
</div>
<div class="your-activity new-followers-activity">
    <span class="followers">
        <span class="home-right-component-title">Seguidores</span> <span class="user-stat-link">
            <?php
            $followers = Doctrine::getTable('Wall')->getFollowers($datos->getId());
            echo count($followers);
            ?>
        </span>
    </span>
    <?php if (count($followers) > 0) { ?>
        <?php foreach ($followers as $follower): ?>
            <?php $follower_data = Doctrine::getTable('sfGuardUser')->findOneBy('id', $follower->getUserId()); ?>
            <li class="user-thumb-list-member">
                <a title="<?php echo $follower_data->getUsername(); ?>" data-user-id="<?php echo $follower->getUserId() ?>" class="user-profile-link" href="wall?user=<?php echo $follower_data->getUsername(); ?>">
                    <?php echo image_tag($follower_data->getImage(), 'width=20px'); ?> 
                </a>
            </li>
        <?php endforeach; ?>
    <?php } ?>
</div>
<p class="wtf-links">
    <a href="<?php echo sfConfig::get('app_base_url') ?>search"><span style="color: #FFF; padding: 10px">Encuentra cuentas para seguir</span>
</p><hr class="component-spacer">