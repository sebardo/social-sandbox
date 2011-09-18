<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheets_for_form($locationForm) ?>
<?php use_javascripts_for_form($locationForm) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@eventAdmin') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('eventAdmin/form_fieldset', array('event' => $event, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>
    
    <?php include_partial('eventAdmin/form_actions', array('event' => $event, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
  <form>
        <fieldset>
            <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_image">
                <div>
                    <label>Location</label>
                    <div class="content"><?php echo $locationForm; ?></div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
