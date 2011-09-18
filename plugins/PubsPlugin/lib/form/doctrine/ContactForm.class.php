<?php

/**
 * PluginInbox form.
 *
 * 
 * @package     InboxPlugin
 * @subpackage  form
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class contactForm extends sfForm
{
    public function setup()
  {

   $this->setWidgets(array( 
    
      'sender'       => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),

    ));

    $this->setValidators(array(
      'sender'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'  => new sfValidatorString(),
    ));
    
     $this->widgetSchema->setNameFormat('contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);   
   }
}
