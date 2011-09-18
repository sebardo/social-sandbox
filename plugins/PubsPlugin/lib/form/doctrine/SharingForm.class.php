<?php

/**
 * PluginInbox form.
 *
 * 
 * @package     InboxPlugin
 * @subpackage  form
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class sharingForm extends sfForm
{
    public function setup()
  {

   $this->setWidgets(array( 
      'url'          => new sfWidgetFormInputHidden(),
      'sender'       => new sfWidgetFormInputText(),
      'dest'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),

    ));

    $this->setValidators(array(
      'sender'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dest'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'  => new sfValidatorString(),
      'url'          => new sfValidatorString(),
    ));
    
     $this->widgetSchema->setNameFormat('share[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);   
   }
}
