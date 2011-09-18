<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'hour'        => new sfWidgetFormTime(),
      'end_date'    => new sfWidgetFormDate(),
      'end_hour'    => new sfWidgetFormTime(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'address'     => new sfWidgetFormInputText(),
      'latitude'    => new sfWidgetFormInputText(),
      'longitude'   => new sfWidgetFormInputText(),
      'image'       => new sfWidgetFormInputText(),
      'slug'        => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorPass(),
      'date'        => new sfValidatorDate(),
      'hour'        => new sfValidatorTime(),
      'end_date'    => new sfValidatorDate(array('required' => false)),
      'end_hour'    => new sfValidatorTime(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'address'     => new sfValidatorString(array('max_length' => 255)),
      'latitude'    => new sfValidatorNumber(),
      'longitude'   => new sfValidatorNumber(),
      'image'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Event', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
