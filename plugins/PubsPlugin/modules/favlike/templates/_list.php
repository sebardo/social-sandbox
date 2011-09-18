<script type="text/javascript" src="<?php echo sfConfig::get('app_base_url') ?>/PubsPlugin/js/jquery.jplayer.min.js"></script>
<?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
    <?php foreach ($favlikes as $favlike): ?>
        <div class="favlike-item">
            <?php include_partial('favlike/pub', array('pubs' => $favlike, 'datos' => $datos)) ?>
        </div>           
    <?php endforeach; ?>
<?php } else { ?>
    <?php $follow = Doctrine::getTable('Follow')->getFollowing($sf_user->getGuardUser()->getId(), $datos->getId()) ?>
    <?php if ($follow) { ?>
        <?php if ($follow->getIsActive() == "1") { ?>
            <?php echo count($favlikes) ?>
            <?php foreach ($favlikes as $favlike): ?>
                <div class="favlike-item">
                    <?php include_partial('favlike/pub', array('pubs' => $favlike, 'datos' => $datos)) ?>
                </div>           
            <?php endforeach; ?>
        <?php }else { ?> 
            <div class="protected-box">
                <h1 class="logged-out">The Favlikes <?php echo $datos->getUsername() ?> are protected.</h1>
                <p>Only confirmed fans have access to the full profile <?php echo $datos->getUsername() ?>. You need to request access before you can continue this account.</p>
            </div>
        <?php } ?>
    <?php } else { ?> 
        <div class="protected-box">
            <h1 class="logged-out">The Favlikes <?php echo $datos->getUsername() ?> are protected.</h1>
            <p>Only confirmed fans have access to the full profile <?php echo $datos->getUsername() ?>. You need to request access before you can continue this account.</p>
        </div>
    <?php } ?>
<?php } ?>