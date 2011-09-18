<?php

/**
 * base follow components.
 * 
 * @package    PubsPlugin
 * @subpackage base components
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BasefollowComponents extends sfComponents {

    public function executeBoxCount() {
        
    }

    public function executeFollowing(sfWebRequest $request) {
        
    }

    public function executeFollowHomeComponent(sfWebRequest $request) {
        
    }

    public function executeNewFollowing(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $w = Doctrine_Query::create()
                    ->from('Follow f')
                    ->where('f.follow_id = ?', $user->getGuardUser()->getId())
                    ->andWhere('f.is_active = ?', '2')
                    ->orderBy('f.created_at DESC')
                    ->limit(30);

            return $this->follows = $w->execute();
        }
    }
    
    public function executeFollowPub(){
        
    }

}
