<?php

/**
 * Tags_photo filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTags_photoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'x1'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'y1'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'x2'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'y2'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'photo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'x1'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'y1'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'x2'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'y2'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags_photo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags_photo';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'photo_id' => 'ForeignKey',
      'x1'       => 'Number',
      'y1'       => 'Number',
      'x2'       => 'Number',
      'y2'       => 'Number',
      'name'     => 'Text',
    );
  }
}
