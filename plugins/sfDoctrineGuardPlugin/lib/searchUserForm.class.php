<?php

/**
 * PluginsfGuardUser form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class searchUserForm extends sfForm
{
    public function configure()
  {

   $this->setWidgets(array(
      'username' => new sfWidgetFormChoice(array(
                             'choices'          => array(),
                             'renderer_class'   => 'sfWidgetFormJQueryAutocompleter',
                             'renderer_options' => array('url' => sfConfig::get('app_base_url').'pubs/getUsersSearch'),
          )),
    
     
    ));

    }

}