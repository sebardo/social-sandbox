<?php

/**
 * Notification form base class.
 *
 * @method Notification getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'dest_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DestUser'), 'add_empty' => false)),
      'record_model'  => new sfWidgetFormInputText(),
      'record_id'     => new sfWidgetFormInputText(),
      'related_model' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormInputText(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'dest_user_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DestUser'))),
      'record_model'  => new sfValidatorString(array('max_length' => 255)),
      'record_id'     => new sfValidatorInteger(),
      'related_model' => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notification';
  }

}
