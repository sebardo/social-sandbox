<?php use_javascript(sfConfig::get('app_base_url').'PubsPlugin/js/facebox.js') ?>
<?php use_stylesheet(sfConfig::get('app_base_url').'PubsPlugin/css/facebox.css') ?>
<div id="pubsContainer">
    <div id="follow_left" class="follow_left">
        <div class="profile-header">
            <?php include_partial('follow_profile_header', array('datos' => $datos)) ?>
        </div>
        <div class="follower_container">
            <div id="new-following">
                <?php include_component('follow', 'newFollowing') ?>
            </div>
        </div>
    </div>
    <div id="follow_right" class="follow_right">
        <div class="component">
            <?php include_component("pubs", "component_data_profile", array('datos' => $datos)); ?>
        </div>
        <div class="component">
            <?php include_component('follow', 'followHomeComponent', array('datos' => $datos)) ?>
        </div>
    </div>
</div>