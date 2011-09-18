<?php

/**
 * InboxPlugin configuration.
 * 
 * @package     InboxPlugin
 * @subpackage  config
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class InboxPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (in_array('inboxAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('inboxRouting', 'addRouteForAdminInboxs'));
    }
     if (in_array('inbox', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('inboxRouting', 'addRouteForInboxs'));
    }
    
  }
}
