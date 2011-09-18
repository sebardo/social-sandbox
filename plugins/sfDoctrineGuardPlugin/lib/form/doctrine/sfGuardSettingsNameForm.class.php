<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardSettingsNameForm extends BasesfGuardUserForm
{
   
     public function configure() {
        unset(
               
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
                $this['profession'],
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
        


         
    }
}