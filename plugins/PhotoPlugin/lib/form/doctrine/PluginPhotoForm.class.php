<?php

/**
 * PluginPhoto form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPhotoForm extends BasePhotoForm
{
     public function setup() {
         parent::setup();
        $context = sfContext::getInstance();
        $username=($this->isNew())?$context->getUser()->getUsername():$this->getObject()->getUser()->getUsername();
        unset(
                $this['created_at'], $this['updated_at'], $this['x1'], $this['x2'], $this['y1'], $this['y2'], $this['ord']
        );

        $this->widgetSchema['name'] = new sfWidgetFormInputFileEditable(array(
                    'file_src' => '/users/' . $username . '/photos/' . $this->getObject()->album_id . '/thumb/' . $this->getObject()->name,
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => false,
                    'edit_mode' => strlen($this->getObject()->getName()) > 0,
                    'template' => '%input%<br />%file%',
                ));
        $this->widgetSchema['album_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema->setNameFormat('photo[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

//        $this->setValidator('name_delete', new sfValidatorPass());
    }

    public function doBind(array $values) {
        $context = sfContext::getInstance();
        if($this->isNew()){
            $username=Doctrine::getTable('Album_photo')->find($values['album_id'])->getUser()->getUsername();
        }else{
            $username=$this->getObject()->getUser()->getUsername();
        }
        $this->setValidator('name', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_web_dir') . '/users/' . $username . '/photos/' . $values['album_id'],
                    'required' => $this->isNew()||$this->getObject()->isModified(),
                    'validated_file_class' => 'sfResizedFile'
                )));
        return parent::doBind($values);
    }

}
