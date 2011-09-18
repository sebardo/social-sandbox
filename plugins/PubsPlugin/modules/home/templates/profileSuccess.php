<?php use_helper('Date') ?>
<?php
slot('ogptags', $ogptags);
slot('title', ($datos->getName() != '' ? $datos->getName() : $datos->getUsername()) . " - Social Sandbox");
?>
<div id="pubsContainer">
    <div class="main-content">
        <div class="pubs-header">
            <div class="pubs-left">
                <?php echo image_tag($datos->getImage(), 'width=150'); ?>
                <?php include_partial('left', array('datos' => $datos)); ?>
            </div>
            <div class="pubs-center">

                <?php include_component("pubs", "component_data_profile", array('datos' => $datos)); ?>
                <br/><br/><br/><br/>
                <div class="profile-body">
                    <div><?php echo __('Name', null, 'setting') ?>: <?php echo $datos->getFirstName() ?> <?php echo $datos->getLastName() ?></div>
                    <div><?php echo __('Country', null, 'setting') ?>:<?php echo $datos->getCountry() ?></div>
                    <div><?php echo __('City', null, 'setting') ?>:<?php echo $datos->getCity() ?></div>
                    <div><?php echo __('Sex', null, 'setting') ?>:
                        <?php if ($datos->getSex() =='0')
                            echo __('Woman', null, 'setting');
                        else 
                            echo __('Man', null, 'setting');?>
                    </div>
                    <div><?php echo __('Marital status', null, 'setting') ?>:<?php echo $datos->getMaritalStatus() ?></div>
                    <div><?php echo __('Date of birth', null, 'setting') ?>:<?php echo $datos->getBirthday() ?></div>
                    <div>Interest:<?php echo $datos->getMeetingSex() ?></div>


                </div>
            </div>
        </div>

    </div>
    <div class="pubs-right">
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
