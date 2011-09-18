<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage text
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class textActions extends sfActions {

    public function executeIframeNew(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->duid = $request->getParameter('duid');
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeNew(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->form = new TextForm();
            $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new TextForm();

        $text = $request->getParameter('text');
        $pure = new pubsPurifier();
        $pure_text = $pure->purify($text['description']);
        $text['description'] = $pure_text;
        $request->setParameter('text', $text);

        $this->duid = $request->getParameter('dest_user_id');

        $this->processForm($request, $this->form, $this->duid);

        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $duid) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {


            $text = $form->save();
            $this->redirect('pubs/publishing?model=text&duid=' . $duid . '&record=' . $text->getId());
        }
    }

}
