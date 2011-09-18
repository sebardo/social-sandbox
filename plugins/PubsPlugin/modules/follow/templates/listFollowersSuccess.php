<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/follow.js') ?>
<?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
    <?php include_partial('follow', array('datos' => $datos, 'follows' => $followers, 'action' => 'follower')) ?>
<?php } else { ?>
    <?php $follow = Doctrine::getTable('Follow')->getFollowing($sf_user->getGuardUser()->getId(), $datos->getId()) ?>
    <?php if ($follow) { ?>
        <?php if ($follow->getIsActive() == "1") { ?>
            <?php include_partial('follow', array('datos' => $datos, 'follows' => $followers, 'action' => 'follower')) ?>
        <?php } else { ?> 
            <div class="protected-box">
                <h1 class="logged-out"> <?php echo __('The Fallows', null, 'follow') ?>  <?php echo $datos->getUsername() ?>  <?php echo __('are protected.', null, 'follow') ?> </h1>
                <p> <?php echo __('Only confirmed fans have access to the full profile', null, 'follow') ?>  <?php echo $datos->getUsername() ?>. <?php echo __('You need to request access before you can continue this account.', null, 'follow') ?>  </p>
            </div>
        <?php } ?>
    <?php } else { ?> 
        <div class="protected-box">
            <h1 class="logged-out"> <?php echo __('The Fallows', null, 'follow') ?>  <?php echo $datos->getUsername() ?>  <?php echo __('are protected.', null, 'follow') ?> </h1>
            <p> <?php echo __('Only confirmed fans have access to the full profile', null, 'follow') ?>  <?php echo $datos->getUsername() ?>. <?php echo __('You need to request access before you can continue this account.', null, 'follow') ?>  </p>
        </div>
    <?php } ?>  
<?php } ?>