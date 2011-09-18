<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class searchActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = $user->getGuardUser();
            $this->users = Doctrine::getTable('sfGuardUser')->getAllUsers();
            $this->form = new searchUsersForm();
            $this->form->setDefault('to', '65');
            $this->form->setDefault('country', '11');
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }
    
    public function executeList(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = $user->getGuardUser();
            $this->users = Doctrine::getTable('sfGuardUser')->getAllUsers($request->getParameter('sex'),$request->getParameter('minAge'),$request->getParameter('maxAge'),$request->getParameter('country'));
            
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeGetUsersSearch(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        // Parametro 'q', contiene lo que fue introducido en el campo por teclado
        $string = $request->getParameter('q');

        // Consulta al modelo Estado
        $rows = Doctrine::getTable('sfGuardUser')->getUsersWith($string);

        $users = array();
        foreach ($rows as $row) {
            $result = Doctrine::getTable('sfGuardUser')->find($row->getId());

            $image = $result->getImage();
            $users[$row->getId()] = "<a href='" . sfConfig::get('app_base_url') . "pubs?user=" . $row->getUsername() . "'><img src='" . $image . "' width='32' class='thumb' >" . $row->getUsername() . " (" . $row->getName() . ")</a>";
        }

        return $this->renderText(json_encode($users));
    }

}
?>

