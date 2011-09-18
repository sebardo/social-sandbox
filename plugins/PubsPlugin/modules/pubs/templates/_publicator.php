<?php use_javascript(sfConfig::get('app_base_url').'PubsPlugin/js/follow.js') ?>
<?php use_stylesheet(sfConfig::get('app_base_url').'PubsPlugin/css/follow.css') ?>
<script>
    $(document).ready(function(){     
        $('a[rel*=facebox]').facebox();
    });
</script>
<div class="top-center-pubs">
    <div class="profile-actions">
        <?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
            <span class="thats-you">
                <?php echo link_to( __('Edit your profile', null, 'pubs') ."&nbsp;→", "settings", array('config' => 'basicinfo')) ?>
            </span>
        <?php } ?>
        <?php if ($sf_user->getGuardUser()->getId() != $datos->getId()) { //primero veo que sea un muro ajeno?>
            <a href="<?php echo sfConfig::get('app_base_url'); ?>inbox/iframeFormMessage?user=<?php echo $datos->getUsername()?>" rel="facebox" class="new-message button">Send Message</a>
            <?php include_component('follow', 'following', array('datos' => $datos)) ?> 
        <?php } ?>
    </div>
    <div class="msj-box-title" style="overflow: hidden;">  
        <?php if ($sf_user->getGuardUser()->getId() == $datos->getId()) { ?>
            <ul class="attachTypes groupList">
                <li > <a class="compartir"><?php echo __('Share', null , 'pubs')?>:</a></li>
                <li class="pub"><a href="<?php echo sfConfig::get('app_base_url'); ?>text/iframeNew?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir publicacion" ></a> </li>           
                <li class="photos"><a href="<?php echo sfConfig::get('app_base_url'); ?>photo/publiPhoto?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir fotografías" ></a></li>
                <li class="link"><a href="<?php echo sfConfig::get('app_base_url'); ?>link/iframeNew?duid=<?php echo $datos->getId() ?>" href="/pubs" rel="facebox" title="Compartir vínculos" ></a></li>
                <li class="music"><a href="<?php echo sfConfig::get('app_base_url'); ?>audio/iframeNew?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir música" ></a></li>
            </ul>
        <?php } else { ?>
            <?php $follow = Doctrine::getTable('Follow')->getFollowing($sf_user->getGuardUser()->getId(), $datos->getId()) ?>
            <?php if ($follow) { ?>
                <?php if ($follow->getIsActive() == "1") { ?>
                    <ul class="attachTypes groupList">
                        <li > <a class="compartir">Share: </a></li>
                        <li class="pub"><a href="<?php echo sfConfig::get('app_base_url'); ?>text/iframeNew?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir publicacion" ></a> </li>           
                        <li class="photos"><a href="<?php echo sfConfig::get('app_base_url'); ?>photo/publiPhoto?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir fotografías" ></a></li>
                        <li class="link"><a href="<?php echo sfConfig::get('app_base_url'); ?>link/iframeNew?duid=<?php echo $datos->getId() ?>" href="/pubs" rel="facebox" title="Compartir vínculos" ></a></li>
                        <li class="music"><a href="<?php echo sfConfig::get('app_base_url'); ?>audio/iframeNew?duid=<?php echo $datos->getId() ?>" rel="facebox" title="Compartir música" ></a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="attachTypes groupList">
                        <li > <a class="compartir">Share: </a></li>
                        <li class="pub"><a title="Compartir publicacion" ></a> </li>           
                        <li class="photos"><a title="Compartir fotografías" ></a></li>
                        <li class="link"><a title="Compartir vínculos" ></a></li>
                        <li class="music"><a title="Compartir música" ></a></li>
                    </ul>
                <?php }
            } else { ?>
                <ul class="attachTypes groupList">
                    <li > <a class="compartir">Share: </a></li>
                    <li class="pub"><a title="Compartir publicacion" ></a> </li>           
                    <li class="photos"><a title="Compartir fotografías" ></a></li>
                    <li class="link"><a title="Compartir vínculos" ></a></li>
                    <li class="music"><a title="Compartir música" ></a></li>
                </ul>
            <?php } ?>
        <?php } ?>
        <span id="loading" style="display: none"><?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif') ?></span>
    </div>
</div>
