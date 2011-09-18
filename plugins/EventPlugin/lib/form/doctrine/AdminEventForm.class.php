<?php
class AdminEventForm extends BaseEventForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at'], $this['slug']);
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['latitude'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['longitude'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['address'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['description'] = new sfWidgetFormTextarea();
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                    'file_src' => '/uploads/eventImages/thumb/' . $this->getObject()->image,
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => true,
                    'edit_mode' => strlen($this->getObject()->getImage()) > 0,
                    'template' => '%input%<br />%delete%&nbsp;%delete_label%<br />%file%'
                ));
        $this->setValidator('image', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_upload_dir') . '/eventImages',
                    'required' => false,
                    'validated_file_class' => 'sfResizedFile'
                )));
        $this->setValidator('image_delete', new sfValidatorPass());
    }
    public function doBind(array $values) {
        $fecha=$values['date']['month'].'/'.$values['date']['day'].'/'.$values['date']['year'];
        $this->setValidator('date', new sfValidatorDate(array('required'=>false, 'min'=>  strtotime(date('m/d/Y')))));
        $this->setValidator('end_date', new sfValidatorDate(array('required'=>false, 'min'=>  max(strtotime($fecha),strtotime(date('m/d/Y'))))));
        return parent::doBind($values);
    }
}
?>
