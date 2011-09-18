<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/facebox.js') ?>
<?php use_stylesheet(sfConfig::get('app_base_url') . 'PubsPlugin/css/facebox.css') ?>
<?php use_javascript(sfConfig::get('app_base_url') . 'PubsPlugin/js/follow.js') ?>
<div id="pubsContainer">
    <div id="follow_left" class="follow_left">
        <div class="profile-header">
            <?php include_partial('follow_profile_header', array('datos' => $datos)) ?>
        </div>
        <div class="follower_container pubs-list">
            <?php $action = $sf_context->getActionName() ?>
            <?php include_partial('following_profile_container', array('datos' => $datos, 'followings' => $followings)) ?>
        </div>
    </div>
    <div id="follow_right" class="follow_right">
        <div class="component">
            <?php include_component("pubs", "component_data_profile", array('datos' => $datos)); ?>
        </div>
        <div class="component">
            <?php include_component('follow', 'followHomeComponent', array('datos' => $datos)) ?>
            <p class="wtf-links">
                <span> <?php echo __('Find accounts to follow:', null, 'follow') ?> </span>
                <a href="<?php echo sfConfig::get('app_base_url') ?>search"><?php echo __('Browse accounts', null, 'follow') ?></a> · <a href="/#!/who_to_follow/import"><?php echo __('Find Friends', null, 'follow') ?></a>
            </p>
        </div>
    </div>
</div>