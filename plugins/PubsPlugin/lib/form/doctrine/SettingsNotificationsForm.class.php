<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class SettingsNotificationsForm extends BaseSetting_has_UserForm
{
   
     public function configure() {
        unset(
                $this['created_at'],
                $this['updated_at']
        );
         
    }
}