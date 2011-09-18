<?php

/**
 * Audio_has_playlist filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAudio_has_playlistFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'audio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Audio'), 'add_empty' => true)),
      'pl_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Playlist'), 'add_empty' => true)),
      'orden'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'audio_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Audio'), 'column' => 'id')),
      'pl_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Playlist'), 'column' => 'id')),
      'orden'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('audio_has_playlist_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Audio_has_playlist';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'audio_id' => 'ForeignKey',
      'pl_id'    => 'ForeignKey',
      'orden'    => 'Number',
    );
  }
}
