<?php

/**
 * PhotoPlugin configuration.
 * 
 * @package     PhotoPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class PhotoPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (in_array('photo', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('PhotoRouting', 'addRouteForPhotos'));
    }

    if (in_array('photoAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('PhotoRouting', 'addRouteForAdminPhotos'));
    }
    
    if (in_array('album', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('PhotoRouting', 'addRouteForAlbums'));
    }

    if (in_array('albumAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('PhotoRouting', 'addRouteForAdminAlbums'));
    }
    
    
  }
}
