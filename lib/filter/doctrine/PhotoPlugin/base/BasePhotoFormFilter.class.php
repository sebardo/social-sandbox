<?php

/**
 * Photo filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePhotoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'album_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Album'), 'add_empty' => true)),
      'title'      => new sfWidgetFormFilterInput(),
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ord'        => new sfWidgetFormFilterInput(),
      'x1'         => new sfWidgetFormFilterInput(),
      'y1'         => new sfWidgetFormFilterInput(),
      'x2'         => new sfWidgetFormFilterInput(),
      'y2'         => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'album_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Album'), 'column' => 'id')),
      'title'      => new sfValidatorPass(array('required' => false)),
      'name'       => new sfValidatorPass(array('required' => false)),
      'ord'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'x1'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'y1'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'x2'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'y2'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('photo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'album_id'   => 'ForeignKey',
      'title'      => 'Text',
      'name'       => 'Text',
      'ord'        => 'Number',
      'x1'         => 'Number',
      'y1'         => 'Number',
      'x2'         => 'Number',
      'y2'         => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
