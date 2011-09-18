<?php

/**
 * commentAdmin admin form
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    4 mars 2010 10:45:36
 */
class inboxAdminForm extends PluginInboxForm
{
  public function configure()
  {
    parent::configure();
    unset( $this['featured']);
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInput();
    $this->widgetSchema['user_dest_id'] = new sfWidgetFormInput();
    $this->widgetSchema['title'] = new sfWidgetFormInput();
    $this->widgetSchema['description'] = new sfWidgetFormTextarea();
    $this->widgetSchema['is_active'] = new sfWidgetFormInput();

  

//    $this->validatorSchema['edition_reason']
//      ->setOption('required', true)
//      ->setMessage('required', $this->required);
  }
}