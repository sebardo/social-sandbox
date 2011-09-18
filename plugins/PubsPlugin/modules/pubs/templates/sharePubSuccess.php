
<div id="sharePub">


    <?php if ($pub->getRecordModel() == 'audio'): ?>
        <script type="text/javascript" src="<?php echo sfConfig::get('app_base_url') ?>/PubsPlugin/js/jquery.jplayer.min.js"></script>
    <?php endif; ?>
    <?php if ($pub->getRecordModel() == 'location'): ?>
        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAddW2_j-icZZyAl1A2ya7rhQ_yJ6-Q1ba5t2DBAyxmHaY7bhWkxTyef5l6z2etMEPLTt-c_oT7Gk4dw" type="text/javascript"></script> 
    <?php endif; ?>
    <div id="pubsContainer" style="float: left;width: 550px;">
        <?php include_partial('pubs/pub', array('pubs' => $pub, 'datos' => $datos)) ?>

    </div>

    <?php if (!$sf_user->isAuthenticated()) { ?>
        <?php echo get_component('sfGuardAuth', 'signin_form') ?>
        <div class="register_form">
            <div class="mainTitle">Sing Up</div>
            <?php echo get_component('sfGuardRegister', 'form') ?>
        </div>
    <?php } ?>

</div>