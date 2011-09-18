<?php

/**
 * Photo form base class.
 *
 * @method Photo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePhotoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'album_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Album'), 'add_empty' => true)),
      'title'      => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'ord'        => new sfWidgetFormInputText(),
      'x1'         => new sfWidgetFormInputText(),
      'y1'         => new sfWidgetFormInputText(),
      'x2'         => new sfWidgetFormInputText(),
      'y2'         => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'album_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Album'), 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'ord'        => new sfValidatorInteger(array('required' => false)),
      'x1'         => new sfValidatorInteger(array('required' => false)),
      'y1'         => new sfValidatorInteger(array('required' => false)),
      'x2'         => new sfValidatorInteger(array('required' => false)),
      'y2'         => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

}
