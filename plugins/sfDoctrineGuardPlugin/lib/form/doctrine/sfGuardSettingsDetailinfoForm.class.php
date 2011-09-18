<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardSettingsDetailinfoForm extends BasesfGuardUserForm
{
    protected static $marital_status = array('Single','In a relationship','Committed','Married','Divorced','Liberal');
    protected static $meeting_sex = array('Man', 'Woman','Whatever');
    protected static $option = array('Yes','No');

    /**
   * @see sfForm
   */
     public function configure() {
        unset(
                $this['username'],
                $this['first_name'],
                $this['last_name'],
                $this['email_address'],
                $this['password'],
                $this['password_again'],
                $this['sex'],
                $this['birthday'],
                $this['aboutme'],
                $this['music'],
                $this['books'],
                $this['films'],
                $this['television'],
                $this['games'],
                
                $this['description'],
                $this['contact'],
                $this['country_id'],
                $this['city_id'],
                $this['cp'],
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
         $this->widgetSchema['marital_status'] = new sfWidgetFormChoice(array(
                'choices' => self::$marital_status,
             ));
         $this->widgetSchema['meeting_sex'] = new sfWidgetFormChoice(array(
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => self::$meeting_sex ,
                ));
         $this->widgetSchema['smoker'] = new sfWidgetFormChoice(array(
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => self::$option ,
                ));
         $this->widgetSchema['drinker'] = new sfWidgetFormChoice(array(
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => self::$option ,
                ));


         
    }
}