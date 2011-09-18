<?php

/**
 * home actions.
 *
 * @package    PubsPlugin
 * @subpackage home
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locationActions extends sfActions {

    public function executeInsertLocation(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $loc = Doctrine::getTable('Location')->insertLocation($user->getGuardUser()->getId(),$request->getParameter('location'));    
            $pub = Doctrine::getTable('Pubs')->insertPub('location',$loc->getId(),$user->getGuardUser()->getId(),$user->getGuardUser()->getId());    
        

            return $this->renderText($pub->getId());

        } else {
            $this->redirect('unauthorized/index');
        }
    }
    
    public function executeEditCountry(sfWebRequest $request) {
        $country = $request->getParameter('value');
        $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
        if ($this->getUser()->isAuthenticated() && $this->datos->getId() == $this->getUser()->getGuardUser()->getId()) {
            $this->datos->setCountry($country);
            $this->datos->save();
        }
        return $this->renderText($this->datos->getCountry());
    }

    public function executeEditCity(sfWebRequest $request) {
        $name = $request->getParameter('value');
        $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
        if ($this->getUser()->isAuthenticated() && $this->datos->getId() == $this->getUser()->getGuardUser()->getId()) {
            $this->datos->setCity($name);
            $this->datos->save();
        }
        return $this->renderText($this->datos->getCity());
    }
    public function executeEditCp(sfWebRequest $request) {
        $name = $request->getParameter('value');
        $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('id'));
        if ($this->getUser()->isAuthenticated() && $this->datos->getId() == $this->getUser()->getGuardUser()->getId()) {
            $this->datos->setCp($name);
            $this->datos->save();
        }
        return $this->renderText($this->datos->getCp());
    }

}
