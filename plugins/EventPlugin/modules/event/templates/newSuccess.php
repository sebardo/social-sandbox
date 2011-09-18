<?php use_javascript(sfConfig::get('app_gmaps_js')) ?>
<div id="eventsContainer">
    <?php include_partial('event/links'); ?>
     <div class="messages-header header">
       <h1><?php echo __('New Event', null, 'event') ?></h1>
    </div>
    

    <?php include_partial('form', array('form' => $form, 'locationForm' => $locationForm)) ?>
</div>