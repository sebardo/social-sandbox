<script src="<?php echo sfConfig::get('app_gmaps_js')?>" type="text/javascript"></script> 
<?php use_helper('Date') ?>
<?php
slot('ogptags', $ogptags);
slot('title', ($datos->getName() != '' ? $datos->getName() : $datos->getUsername()) . " - Social Sandbox");
?>
<script>
    $(document).ready(function($) {
        var user= '<?php echo $sf_request->getParameter('user') ?>';
        var pubID= '<?php echo $sf_request->getParameter('pid') ?>';
        $.get(base_url+"pubs/listAjax?user="+user+"&pid="+pubID, function(info){
            $('#loading-list').hide();
            $('.pubs-list').show('slow').html(info);
        });
    });  
</script>
<div id="pubsContainer">
    <div class="main-content">
        <div class="pubs-header">
            <div class="pubs-left">
                <?php if ($sf_user->getGuardUser()->getUsername() != $datos->getUsername()) { ?>
                    <?php echo image_tag($datos->getImage(), 'width=150'); ?>
                <?php } else { ?>
                    <?php if (in_array('photo', sfConfig::get('sf_enabled_modules', array()))) { ?>
                        <?php include_partial('photo/profilePhoto'); ?>
                    <?php } else { ?>
                        <?php echo image_tag($datos->getImage(), 'width=150'); ?>
                    <?php } ?>
                <?php } ?>
                <?php include_partial('left', array('datos' => $datos)); ?>
            </div>
            <div class="pubs-center">
                <h1> <?php echo $datos->getUsername() ?>  <span id="loading"><?php echo image_tag('/PubsPlugin/images/loading.gif') ?></span></h1>
                
                <div class="share-profile">
                    <a rel="delete" href="<?php echo sfConfig::get('app_base_url') ?>pubs/share?url=<?php echo sfConfig::get('app_base_url') . '?user=' . $datos->getUsername() ?>">
                        <span>
                            <i class="share"></i>
                            <?php echo __('Share', null, 'pubs') ?>
                        </span>
                    </a>
                </div>
                
                <?php include_partial('publicator', array('datos' => $datos)); ?>
                <div class="pubs-list">
                    <span id="loading-list"><?php echo image_tag(sfConfig::get('app_base_url').'PubsPlugin/images/loading.gif') ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="pubs-right">
        <div class="box-container" style="clear: both">
        <?php if (in_array('event', sfConfig::get('sf_enabled_modules', array()))) { ?>
          <div class="header">
              
            <h1><?php if($sf_user->getguardUser()->getId() == $datos->getId()) 
                echo __('My ', null, 'pubs'); 
            else 
                echo $sf_request->getParameter('user')?> <?php echo __('Calendar', null, 'pubs')?> <button onclick="goURL('/event/new')" class="add-buttom"><i class="add"></i></button></h1>
          </div>
          <div id="calendarContainer" >
            <?php include_component('event', 'calendar', array('userId' => $datos->getId())); // este componente debe estar siempre incluido en un contenedor ?>
          </div>
        <?php } ?>
        </div>
         <div class="box-container" style="clear: both">

            <?php if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) { ?>
                <div class="header">
                    <h1><?php echo $sf_request->getParameter('user') ?> Follows </h1>
                </div>
                <div style="overflow: hidden;float: auto">
                    <?php include_component('follow', 'followHomeComponent', array('datos' => $datos)) ?>
                </div>
            <?php } ?>
        </div>
        
    </div>
</div>
