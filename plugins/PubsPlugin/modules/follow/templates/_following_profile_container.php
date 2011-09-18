<div class="stream-tabs-detail"><?php echo $datos->getName() ?>  <?php echo __('follow ', null, 'follow') ?> <?php echo count($followings); ?> <?php echo __('accounts', null, 'follow') ?></div>

<?php include_partial('follow',array('datos' => $datos, 'follows' => $followings, 'action' => 'following'))?>