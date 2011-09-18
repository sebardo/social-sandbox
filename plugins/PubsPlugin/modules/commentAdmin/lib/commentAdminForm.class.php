<?php

/**
 * commentAdmin admin form
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    4 mars 2010 10:45:36
 */
class commentAdminForm extends PluginCommentForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();

    $this->widgetSchema['user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['dest_user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['record_model'] = new sfWidgetFormInput();
    $this->widgetSchema['record_id'] = new sfWidgetFormInput();  


  }
}