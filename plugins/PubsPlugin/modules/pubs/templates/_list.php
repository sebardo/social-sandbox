<script type="text/javascript" src="<?php echo sfConfig::get('app_base_url') ?>PubsPlugin/js/jquery.jplayer.min.js"></script>

<?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
    <ul>
        <?php $x = 0; ?>
        <?php foreach ($pubss as $pubs): ?>
            <?php $x++; ?>
            <?php if ($x <= 10) { ?>
                <?php include_partial('pubs/pub', array('pubs' => $pubs, 'datos' => $datos)) ?>
            <?php } ?> 
        <?php endforeach; ?>  
    </ul> 
    <?php if (count($pubss) > 10) { ?>
        <div div-id="morePager-<?php echo time() ?>" user-id="<?php echo $datos->getId() ?>" page="<?php echo (1 + 1) ?>" class="morePager">
            Previous publication  <?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif', "id=loading-list") ?>
        </div>
        <div id="morePager-<?php echo time() ?>"></div>
    <?php } ?> 
<?php } else { ?>
    <?php $follow = Doctrine::getTable('Follow')->getFollowing($sf_user->getGuardUser()->getId(), $datos->getId()) ?>
    <?php if ($follow) { ?>
        <?php if ($follow->getIsActive() == "1") { ?>
            <ul>
                <?php $x = 0; ?>
                <?php foreach ($pubss as $pubs): ?>
                    <?php $x++; ?>
                    <?php if ($x <= 10) { ?>
                        <?php include_partial('pubs/pub', array('pubs' => $pubs, 'datos' => $datos)) ?>
                    <?php } ?> 
                <?php endforeach; ?>
            </ul> 
            <?php if (count($pubss) > 10) { ?>
                <div div-id="morePager-<?php echo time() ?>" user-id="<?php echo $datos->getId() ?>" page="<?php echo (1 + 1) ?>" class="morePager">
                    Previous publication  <?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif', "id=loading-list") ?>
                </div>
                <div id="morePager-<?php echo time() ?>"></div>
            <?php } ?> 
        <?php } else { ?>

            <div class="protected-box">
                <h1 class="logged-out">The Pubs <?php echo $datos->getUsername() ?> are protected.</h1>
                <p>Only confirmed fans have access to publications and the full profile <?php echo $datos->getUsername() ?>. You need to request access before you can continue this account.</p>
            </div>
        <?php }
    } else { ?>
        <div class="protected-box">
            <h1 class="logged-out">The Pubs <?php echo $datos->getUsername() ?> are protected.</h1>
            <p>Only confirmed fans have access to publications and the full profile <?php echo $datos->getUsername() ?>. You need to request access before you can continue this account.</p>
        </div>

    <?php } ?>
<?php } ?> 