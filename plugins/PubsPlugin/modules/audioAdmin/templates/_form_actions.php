<ul class="sf_admin_actions">
    <?php if ($form->isNew()): ?>
        <?php $conf = $configuration->getValue('new.actions') ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => 'Back to list',)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array('params' => array(), 'class_suffix' => 'save_and_add', 'label' => 'Save and add',)) ?>
    <?php else: ?>
        <?php $conf = $configuration->getValue('edit.actions') ?>
        <?php echo $helper->linkToList(array('params' => array(), 'class_suffix' => 'list', 'label' => $conf['_list']['label'],)) ?>
        <?php echo $helper->linkToIsDelete($form->getObject(), array('params' => array(), 'confirm' => $conf['_delete']['confirm'], 'class_suffix' => 'delete', 'label' => $conf['_delete']['label'],)) ?>
        <?php echo $helper->linkToSaveAndDelete($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => $conf['save_and_delete']['label'],)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => $conf['_save']['label'],)) ?>
    <?php endif; ?>
</ul>
