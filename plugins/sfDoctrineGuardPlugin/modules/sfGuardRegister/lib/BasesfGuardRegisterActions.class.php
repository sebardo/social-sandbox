<?php

class BasesfGuardRegisterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
 {
        if ($request->getParameter('salt')) {
            $q = Doctrine_Query::create()
                            ->update('sfGuardUser u')
                            ->set('u.is_active', '?', true)
                            ->where('u.salt = ?', $request->getParameter('salt'))
                            ->execute();
             $this->getUser()->setFlash('notice', 'register_ok');
        } else {

            if ($this->getUser()->isAuthenticated()) {
                $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
                $this->redirect('@homepage');
            }

            $this->form = new sfGuardRegisterForm();

            if ($request->isMethod('post')) {
                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {
                    $user = $this->form->save();
                    
                    //$this->getUser()->signIn($user);
                    $this->processMail($user);
                    $this->getUser()->setFlash('notice', 'send_mail');
                    //$this->redirect('@homepage');
                }
//                $this->redirect('@homepage');
            }
        }
    }
  public function processMail($user) {
 
        
        $message = Swift_Message::newInstance()
          ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'sandbox@nordestelabs.com'))
          ->setTo($user->email_address)
          ->setSubject('New Register for '.$user->username)
          ->setBody($this->getPartial('sfGuardRegister/send_register', array('user' => $user)))
          ->setContentType('text/html')
        ;
        $this->getMailer()->send($message);
    }
    
    public function executeGetAllUsersEmail(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        // Parametro 'q', contiene lo que fue introducido en el campo por teclado
        $string = $request->getParameter('q');

        // Consulta al modelo Estado
        $rows = Doctrine::getTable('sfGuardUser')->getEmailWith($string);

        $users = array();
        foreach ($rows as $row) {

            $users[] = $row->getEmailAddress();
        }

        return $this->renderText(json_encode($users));
    }
    public function executeGetAllUserName(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        // Parametro 'q', contiene lo que fue introducido en el campo por teclado
        $string = $request->getParameter('q');

        // Consulta al modelo Estado
        $rows = Doctrine::getTable('sfGuardUser')->getUsersWith($string);

        $users = array();
        foreach ($rows as $row) {

            $users[] = $row->getUsername();
        }

        return $this->renderText(json_encode($users));
    }
}