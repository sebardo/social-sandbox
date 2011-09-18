<?php

/**
 * audio components.
 *
 * @package    PubsPlugin
 * @subpackage audio components
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class audioComponents extends sfComponents {

    public function executeAudio(sfWebRequest $request) {
        
    }

    public function executeAudio_component(sfWebRequest $request) {
        
    }

    public function executeListenShort(sfWebRequest $request) {
        if (!$request->hasParameter('id')) {
            if ($request->hasParameter('datos')) {
                  $audio = Doctrine::getTable('audio')->findByDql('ORDER BY > created_at DESC LIMIT 1');
                  $id = $audio->getId();
            }
        }
    }

}

?>