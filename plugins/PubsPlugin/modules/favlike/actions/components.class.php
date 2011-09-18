<?php

/**
 * favlike components.
 *
 * @package    PubsPlugin
 * @subpackage favlike
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class favlikeComponents extends sfComponents {

    public function executeFavlikes(sfWebRequest $request) {
        $this->favlikes =$this->object->getFavlikes();
        return $this->favlikes;
    }

}

?>
