<?php use_helper('I18N', 'Date') ?>
<?php include_partial('followAdmin/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __($configuration->getValue('list.title'), array(), 'messages') ?></h1>

  <?php include_partial('followAdmin/flashes') ?>

  <div id="sf_admin_header">
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('followAdmin/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('followAdmin_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('followAdmin/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'configuration' => $configuration)) ?>
    <ul class="sf_admin_actions">
      <?php  include_partial('followAdmin/list_batch_actions', array('helper' => $helper)) ?>
      <?php  include_partial('followAdmin/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('followAdmin/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
