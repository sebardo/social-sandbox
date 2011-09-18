<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($comment, array(  'label' => $configuration['_edit']['label'],  'params' =>   array(  ),  'class_suffix' => 'edit',)) ?>
    <?php echo $helper->linkToIsDelete($comment, array(  'params' =>   array(  ),  'class_suffix' => 'delete',  'label' => $configuration['_delete']['label'],)) ?>
  </ul>
</td>
