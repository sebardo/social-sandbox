<?php

/**
 * Audio form.
 *
 * @package    PubsPlugin
 * @subpackage form
 * @author     Dario Sebastian Sasturain
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginAudioForm extends BaseAudioForm
{
  public function setup()
  {
      $this->setWidgets(array(
      'dest_user_id' => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormInputHidden(),
      'description'  => new sfWidgetFormInput(),

    ));
      
        $this->setWidget('filename', new sfWidgetFormInputFileEditable(array(
        'file_src'    => '/users/'.sfContext::getInstance()->getUser()->getGuardUser()->getUsername().'/audios/'.$this->getObject()->filename,
        'edit_mode' => !$this->isNew(),
        'is_image' => false,
        'with_delete' => true,
        'edit_mode' => strlen($this->getObject()->getFilename()) > 0,
        'delete_label' => 'Filename',
        'template' => '%input%<br />%delete%&nbsp;%delete_label%<br />%file%',
    )));

       $this->widgetSchema->setNameFormat('audio[%s]');

       $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

       $this->setValidators(array(
           'dest_user_id' => new sfValidatorNumber(array('required' => true), array('required' => true, 'invalid' => '')),
           'user_id' => new sfValidatorNumber(array('required' => true), array('required' => true, 'invalid' => '')),
           'description' => new sfValidatorString(array('required' => false), array('required' => true, 'invalid' => '')),
           
        ));
       

	 $this->setValidator('filename', new sfValidatorFile(array(
          'path' => sfConfig::get('sf_web_dir').'/users/'.sfContext::getInstance()->getUser()->getGuardUser()->getUsername().'/audios',
          'required' => false,
          'max_size'   => '20971520000',
          )));
  }
}
