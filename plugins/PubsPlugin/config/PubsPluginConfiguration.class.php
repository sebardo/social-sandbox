<?php

/**
 * PubsPlugin configuration.
 * 
 * @package     PubsPlugin
 * @subpackage  config
 * @author      Dario Sebastian Sasturain
 */
class PubsPluginConfiguration extends sfPluginConfiguration {

    static protected $HTMLPurifierLoaded = false;

    /**
     * @see sfPluginConfiguration
     */
    public function initialize() {
        if (in_array('home', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForHome'));
        }
        if (in_array('pubs', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForPubs'));
        }
        if (in_array('pubsAdmin', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAdminPubs'));
        }
        if (in_array('commentAdmin', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAdminComments'));
        }
        if (in_array('favlike', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForFavlikes'));
        }
        if (in_array('favlikeAdmin', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAdminFavlikes'));
        }
        
        if (in_array('audio', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAudios'));
        }
        if (in_array('audioAdmin', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAdminAudios'));
        }
        if (in_array('settings', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForSettings'));
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForSettingsCheckPass'));
        }
        if (in_array('follow', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForFollows'));
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForNewFollows'));
        }
        if (in_array('followAdmin', sfConfig::get('sf_enabled_modules', array()))) {
            $this->dispatcher->connect('routing.load_configuration', array('pubsRouting', 'addRouteForAdminFollows'));
        }
        self::registerHTMLPurifier();
    }

    static public function registerHTMLPurifier() {
        if (self::$HTMLPurifierLoaded) {
            return;
        }

        require_once(sfConfig::get('sf_plugins_dir') . '/PubsPlugin/lib/tools/htmlpurifier/library/HTMLPurifier/Bootstrap.php');

        spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));

        self::$HTMLPurifierLoaded = true;
    }

}
