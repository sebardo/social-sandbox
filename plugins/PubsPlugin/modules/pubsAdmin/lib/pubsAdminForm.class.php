<?php
/**
 * pubsAdmin admin form
 *
 * @package    PubsPlugin
 * @subpackage pubsAdmin
 * @author     Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class pubsAdminForm extends PluginPubsForm
{
  public function configure()
  {
    parent::configure();
    unset( $this['featured'], $this['slug']);
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['user_dest_id'] = new sfWidgetFormInput();
    $this->widgetSchema['record_model'] = new sfWidgetFormInput();
    $this->widgetSchema['record_id'] = new sfWidgetFormInput();
    $this->widgetSchema['is_active'] = new sfWidgetFormInput();

  }
}