<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardSettingsBasicinfoForm extends BasesfGuardUserForm
{
  /**
   * @see sfForm
   */
    protected static $radios = array('Man', 'Woman');

    public function configure() {
         for ($i = date("Y") - 6; $i >= date("Y") - 100; $i--) {
           $anios[$i] = $i;
        }
        unset(
                $this['username'],
                $this['first_name'],
                $this['last_name'],
                $this['email_address'],
                $this['password'],
                $this['password_again'],
                $this['aboutme'],
                $this['profession'],
                $this['music'],
                $this['books'],
                $this['films'],
                $this['television'],
                $this['games'],
                $this['marital_status'],
                $this['meeting_sex'],
                $this['hometown'],
                $this['borntown'],
                $this['smoker'],
                $this['drinker'],
                $this['education'],
                $this['language'],
                $this['religion'],
                $this['politic'],
                $this['description'],
                $this['contacto'],
                $this['last_login'],
                $this['created_at'],
                $this['updated_at'],
                $this['salt'],
                $this['algorithm'],
                $this['is_active'],
                $this['is_super_admin'] ,
                $this['groups_list'],
                $this['permissions_list']
        );
         $this->widgetSchema['sex'] = new sfWidgetFormChoice(array(
                'expanded' => true,
                'multiple' => false,
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