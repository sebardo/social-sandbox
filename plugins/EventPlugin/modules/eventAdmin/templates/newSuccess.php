<?php use_helper('I18N', 'Date') ?>
<?php include_partial('eventAdmin/assets') ?>
<?php use_javascript(sfConfig::get('app_gmaps_js'))?>

<div id="sf_admin_container">
  <h1><?php echo __('New EventAdmin', array(), 'messages') ?></h1>

  <?php include_partial('eventAdmin/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('eventAdmin/form_header', array('event' => $event, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('eventAdmin/form', array('event' => $event, 'form' => $form, 'locationForm' => $locationForm, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('eventAdmin/form_footer', array('event' => $event, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
