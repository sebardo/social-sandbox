<?php foreach ($follows as $follow): ?>
    <div class="follower">
        <?php if($action == 'follower') { ?>
        <?php $datos_follow = Doctrine::getTable('sfGuardUser')->find($follow->getUserId()); ?>
        <?php } elseif($action == 'following'){ ?>
        <?php $datos_follow = Doctrine::getTable('sfGuardUser')->find($follow->getFollowId()); ?>
        <?php }?>
        <?php echo image_tag($datos_follow->getImage(), 'width=50px'); ?>
        <div class="user-content-rest">
            <span class="user-name">
                <a title="<?php echo $datos_follow->getUsername(); ?>" href="<?php echo sfConfig::get('app_base_url'); ?>pubs?user=<?php echo $datos_follow->getUsername(); ?>" data-user-id="<?php echo $datos_follow->getId(); ?>" class="user-profile-link"><strong><?php echo $datos_follow->getUsername(); ?></strong></a>
                <span class="full-name"><?php echo $datos_follow->getName(); ?></span>
            </span>
        </div>   
        <?php include_component('follow', 'following', array('datos' => $datos_follow)) ?>        
    </div>
<?php endforeach; ?>
