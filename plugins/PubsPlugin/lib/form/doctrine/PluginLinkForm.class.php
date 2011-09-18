<?php

/**
 * PluginLink form.
 *
 * @package    PubsPlugin
 * @subpackage form
 * @author     Dario Sebastian Sasturain
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginLinkForm extends BaseLinkForm
{
    public function setup() {
        $this->setWidgets(array(
            'dest_user_id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormInputHidden(),
            'url' => new sfWidgetFormInput(),
        ));
        $this->widgetSchema->setNameFormat('link[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setValidators(array(
            'dest_user_id' => new sfValidatorNumber(array('required' => true), array('required' => true, 'invalid' => '')),
            'user_id' => new sfValidatorNumber(array('required' => true), array('required' => true, 'invalid' => '')),
            'url' => new sfValidatorString(array('required' => false), array('required' => true, 'invalid' => '')),
        ));
    }
}
