<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($inbox, array(  'label' => $configuration['_edit']['label'],  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
    <?php echo $helper->linkToReplys($inbox, array(  'params' =>   array(  ),  'class_suffix' => 'comments',  'label' => $configuration['replys']['label'])) ?>
    <?php //if(!$wall->is_delete): ?>
      <?php echo $helper->linkToIsDelete($inbox, array(  'params' =>   array(  ),  'class_suffix' => 'delete',  'label' => $configuration['_delete']['label'],)) ?>
    <?php //else: ?>
      <?php //echo $helper->linkToRestore($wall, array(  'params' =>   array(  ),  'class_suffix' => 'restore',  'label' => $configuration['restore']['label'],)) ?>
    <?php //endif ?>
  </ul>
</td>
