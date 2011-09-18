<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($follow, array('label' => $configuration['_edit']['label'], 'params' => array(), 'class_suffix' => 'edit',)) ?>
        <?php echo $helper->linkToFavlikes($follow, array('params' => array(), 'class_suffix' => 'favlikes', 'label' => $configuration['favlikes']['label'])) ?>
        <?php echo $helper->linkToIsDelete($follow, array('params' => array(), 'class_suffix' => 'delete', 'label' => $configuration['_delete']['label'],)) ?>
    </ul>
</td>
