<?php

/**
 * BasesfGuardRequestForgotPasswordForm for requesting a forgot password email
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardRequestForgotPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRequestForgotPasswordForm extends BasesfGuardRequestForgotPasswordForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
       $this->setWidgets(array(
            'email_address' => new sfWidgetFormInput(),
        ));
        $this->widgetSchema->setNameFormat('recuperar[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->setValidators(array(
            'email_address' => new sfValidatorEmail(array('required' => true), array('invalid' => 'Email not valid', 'required' => 'Requerido')),
        ));
  }
}