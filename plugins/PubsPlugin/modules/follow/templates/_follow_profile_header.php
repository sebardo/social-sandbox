<div class="profile-info clearfix">
    <div class="profile-image-container">
        <a class="profile-picture">
            <?php echo image_tag($datos->getImage(), 'width=130'); ?>
    </div>
    <div class="profile-details">
        <div class="full-name">
            <h2> </h2>
            <h2><?php echo $datos->getName(); ?></h2>
        </div>
        <div class="screen-name-and-location">
            <span class="screen-name screen-name-sastus pill">
                @<?php echo $datos->getUsername(); ?></span>
            <?php echo $datos->getCity(); ?> <?php echo $datos->getCountry(); ?> 
        </div>
        <div class="profile-actions">
            <?php if ($sf_user->getGuardUser()->getId() != $datos->getId()) { //primero veo que sea un muro ajeno?>
                <?php include_component('follow', 'following', array('datos' => $datos)) ?> 
            <?php } else { ?>
                <span class="thats-you">
                    <a href="<?php echo url_for('settings', array('config' => 'basicinfo')); ?>"><?php echo __('Edit your profile', null, 'pubs')?>&nbsp;→</a>
                </span>
            <?php } ?>
        </div>
    </div>
</div>
<?php include_partial('follow/follow_tabs', array('action' => $sf_context->getActionName(), 'datos' => $datos)) ?>
