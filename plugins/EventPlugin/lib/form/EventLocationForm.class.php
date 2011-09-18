<?php
class EventLocationForm extends sfForm {

    public function configure() {
        $this->widgetSchema['location'] = new sfWidgetFormGMapAddress(
                array(
                    'formRel.name'=>'event',
                    'label'=>null,
                    'map.width'=>'380px',
                    'map.height'=>'200px',
                    'address.options'=>array('style'=>'width:300px','tabindex'=>2)));
        $this->setValidator('location', new sfValidatorGMapAddress(array('required'=>true)));
    }
}
?>
