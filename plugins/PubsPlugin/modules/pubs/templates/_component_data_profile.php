<script type="text/javascript">
    $(document).ready(function(){
        $('a[rel*=delete]').facebox();
    });
</script>
<h2>
      <?php echo image_tag($datos->getImage('24','24','thumb'), "width=24")?>
     <?php echo __('About', null, 'pubs') ?> <?php echo $datos->getUsername()?>
</h2>
<?php if($sf_context->getModuleName() == 'home'){ ?>
<div class="share-profile">
    <a rel="delete" href="<?php echo sfConfig::get('app_base_url') ?>pubs/share?url=<?php echo sfConfig::get('app_base_url') .'?user='. $datos->getUsername()?>">
        <span>
            <i class="share"></i>
            <?php echo __('Share', null, 'pubs') ?>
        </span>
    </a>
</div>
 <?php } ?>               
<div class="data-profile">
    <li>
        <a href="<?php echo sfConfig::get('app_base_url') ?>pubs" class="user-stats-count">
                <?php echo Doctrine::getTable('Pubs')->getPubs($datos->getId())?><span class="user-stats-stat"><?php echo __('Pubs', null, 'pubs') ?></span>
        </a>
    </li>
    <li><a href="<?php echo sfConfig::get('app_base_url') ?>followings" class="user-stats-count">
            <?php echo count($datos->getFollowing())?>
            
            <span class="user-stats-stat"><?php echo __('Followings', null, 'follow') ?></span></a></li>
    <li><a href="<?php echo sfConfig::get('app_base_url') ?>followers" class="user-stats-count"><?php echo count($datos->getFollower())?><span class="user-stats-stat"><?php echo __('Followers', null, 'follow') ?></span></a></li>
    <?php if (in_array('favlike', sfConfig::get('sf_enabled_modules', array()))) { ?>
    <li><a href="<?php echo sfConfig::get('app_base_url') ?>favlike" class="user-stats-count"><?php echo Doctrine::getTable('Favlike')->getFavlikes($datos->getId())?><span class="user-stats-stat"><?php echo __('Favlikes', null, 'pubs') ?></span></a></li>
    <?php } ?>
    <?php if (in_array('comment', sfConfig::get('sf_enabled_modules', array()))) { ?>
    <li><a href="#" class="user-stats-count"><?php echo Doctrine::getTable('Comment')->getComments($datos->getId())?><span class="user-stats-stat"><?php echo __('Comments', null, 'pubs') ?></span></a></li>
    <?php } ?>
</div>
