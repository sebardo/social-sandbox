<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_activate">
      <?php echo link_to(__('Activate', array(), 'messages'), 'sfGuardUser/ListActivate?id='.$sf_guard_user->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($sf_guard_user, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($sf_guard_user, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
