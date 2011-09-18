<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */

class sfGuardRegisterHomeForm extends BasesfGuardUserForm
{
  /**
   * @see sfForm
   */
    protected static $radios = array('Masculino', 'Femenino');

    public function configure() {
     unset(
      $this['password_again'],
      $this['profession'],
      $this['music'],
      $this['books'],
      $this['films'],
      $this['television'],
      $this['games'],
      $this['country_id'],
      $this['city_id'],
      $this['cp'],
      $this['description'],
      $this['contacto'],
      $this['last_login'],
      $this['created_at'],
      $this['updated_at'],
      $this['salt'],
      $this['algorithm']
    );

      for ($i = date("Y") - 6; $i >= date("Y") - 100; $i--) {
           $anios[$i] = $i;
        }
      $this->widgetSchema['email_address'] = new sfWidgetFormInput();
      $this->validatorSchema['email_address'] = new sfValidatorEmail(
			array(
                        'required' => true,
	                ));

      $this->widgetSchema['username'] = new sfWidgetFormInput();
      $this->validatorSchema['username']->setOption('required', true);
      $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
      $this->validatorSchema['password']->setOption('required', true);


      $this->widgetSchema['sex'] = new sfWidgetFormChoice(array(
                'expanded' => false,
                'choices' => self::$radios,
             ));
      $this->widgetSchema['birthday'] = new sfWidgetFormDate(array(
                'years' => $anios,
                'can_be_empty' => false
             ));
       $this->validatorSchema['birthday'] = new sfValidatorDate(
			array(
                        'required' => true,
                        'max' => '18 years ago',
	      ));




    }
}