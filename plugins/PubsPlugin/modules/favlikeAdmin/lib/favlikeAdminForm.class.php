<?php

class favlikeAdminForm extends PluginFavlikeForm
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