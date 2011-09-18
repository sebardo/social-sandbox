<?php

/**
 * PluginEvent form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginEventForm extends BaseEventForm {

    public function setup() {
        parent::setup();
        $context = sfContext::getInstance();
        $username=($this->isNew())?$context->getUser()->getUsername():$this->getObject()->getUser()->getUsername();
        unset($this['created_at'], $this['updated_at'], $this['is_active'], $this['slug']);
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['latitude'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['longitude'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['address'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(),array('tabindex'=>1));
        $this->widgetSchema['description'] = new sfWidgetFormTextarea(array(),array('tabindex'=>3));
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                    'file_src' => '/users/' . $username .'/eventImages/thumb/' . $this->getObject()->image,
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => true,
                    'edit_mode' => strlen($this->getObject()->getImage()) > 0,
                    'template' => '%input%<br />%delete%&nbsp;%delete_label%<br />%file%'
                ),array('tabindex'=>13));
//        $this->widgetSchema->setLabels(array(
//          'name'  => 'Event',
//          'date'   => 'Fecha',
//          'hour' => 'Hora',
//          'end_date'   => 'Fecha final',
//          'end_hour' => 'Hora final',
//          'description'   => 'Descripci&oacute;n',
//          'image' => 'Agerga una imagen'
//        ));
        $this->setValidator('image', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_web_dir') . '/users/' . $username .'/eventImages',
                    'required' => false,
                    'validated_file_class' => 'sfResizedFile'
                )));
        $this->setValidator('image_delete', new sfValidatorPass());
    }
    public function doBind(array $values) {
        $values['description']=strip_tags($values['description']);
        $values['name']=strip_tags($values['name']);
        $fecha=$values['date']['month'].'/'.$values['date']['day'].'/'.$values['date']['year'];
        $this->setValidator('date', new sfValidatorDate(array('required'=>true, 'min'=>  strtotime(date('m/d/Y')))));
        $this->setValidator('end_date', new sfValidatorDate(array('required'=>false, 'min'=>  max(strtotime($fecha),strtotime(date('m/d/Y'))))));
        return parent::doBind($values);
    }

}
