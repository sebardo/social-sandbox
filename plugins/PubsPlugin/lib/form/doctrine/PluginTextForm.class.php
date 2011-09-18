<?php

/**
 * Text form.
 *
 * @package    PubsPlugin
 * @subpackage form
 * @author     Dario Sebastian Sasturain
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginTextForm extends BaseTextForm {

    public function setup() {
        $this->setWidgets(array(
            'user_id' => new sfWidgetFormInputHidden(),
            'description' => new sfWidgetFormTextarea(),
        ));
        $this->widgetSchema->setNameFormat('text[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setValidators(array(
            'user_id' => new sfValidatorNumber(array('required' => true), array('required' => true, 'invalid' => '')),
            'description' => new sfValidatorString(array('required' => false), array('required' => true, 'invalid' => '')),
        ));
    }

}
