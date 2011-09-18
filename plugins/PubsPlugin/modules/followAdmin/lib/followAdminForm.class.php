<?php

/**
 * BaseFollowAdmin form.
 *
 * @package    PubsPlugin
 * @subpackage form
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 */
class followAdminForm extends PluginFollowForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['follow_id'] = new sfWidgetFormInput();
    $this->widgetSchema['is_active'] = new sfWidgetFormInput();

  

//    $this->validatorSchema['edition_reason']
//      ->setOption('required', true)
//      ->setMessage('required', $this->required);
  }
}