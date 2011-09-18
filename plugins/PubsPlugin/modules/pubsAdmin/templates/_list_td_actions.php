<td>
    <ul class="sf_admin_td_actions">
        <?php echo $helper->linkToEdit($pubs, array('label' => $configuration['_edit']['label'], 'params' => array(), 'class_suffix' => 'edit',)) ?>
        <?php echo $helper->linkToComments($pubs, array('params' => array(), 'class_suffix' => 'comments', 'label' => $configuration['comments']['label'])) ?>
        <?php echo $helper->linkToFavlikes($pubs, array('params' => array(), 'class_suffix' => 'favlikes', 'label' => $configuration['favlikes']['label'])) ?>
        <?php echo $helper->linkToIsDelete($pubs, array('params' => array(), 'class_suffix' => 'delete', 'label' => $configuration['_delete']['label'],)) ?>

    </ul>
</td>
