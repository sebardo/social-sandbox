<?php

/**
 * Tags_photo form base class.
 *
 * @method Tags_photo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTags_photoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'photo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => false)),
      'x1'       => new sfWidgetFormInputText(),
      'y1'       => new sfWidgetFormInputText(),
      'x2'       => new sfWidgetFormInputText(),
      'y2'       => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'photo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'))),
      'x1'       => new sfValidatorInteger(),
      'y1'       => new sfValidatorInteger(),
      'x2'       => new sfValidatorInteger(),
      'y2'       => new sfValidatorInteger(),
      'name'     => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('tags_photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags_photo';
  }

}
