<?php

/**
 * Audio_has_playlist form base class.
 *
 * @method Audio_has_playlist getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAudio_has_playlistForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'audio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Audio'), 'add_empty' => false)),
      'pl_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Playlist'), 'add_empty' => false)),
      'orden'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'audio_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Audio'))),
      'pl_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Playlist'))),
      'orden'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('audio_has_playlist[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Audio_has_playlist';
  }

}
