<?php

/**
 * audioAdmin admin form
 *
 * @package    PubsPlugin
 * @subpackage audioAdmin
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 */
class audioAdminForm extends PluginAudioForm
{
  public function configure()
  {
    parent::configure();
    unset( $this['slug']);
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['name'] = new sfWidgetFormTextarea();
    $this->widgetSchema['is_active'] = new sfWidgetFormInput();
  }
}