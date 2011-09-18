<?php

/**
 * favlike actions.
 *
 * @package    PubsPlugin
 * @subpackage favlike
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class favlikeActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'),  Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $this->favlikes = Doctrine_Core::getTable('Favlike')
                    ->createQuery('a')
                    ->where('a.user_id = ?', $this->datos->getId())
                    ->leftJoin('a.User u')
                    ->leftJoin('a.DestUser uu')
                    ->orderBy('a.created_at DESC')
                    ->execute();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeFavlike(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
                //reviso si no existe el registro
                $favlike = Doctrine::getTable('Favlike')->getIsFavlike($request->getParameter('user_id'), $request->getParameter('dest_user_id'), $request->getParameter('record_model'), $request->getParameter('record_id'));
                if ($favlike) {
                    $act = true;
                } else {
                    $favlike = new Favlike();
                    $act = false;
                }
                $favlike->setUserId($request->getParameter('user_id'));
                $favlike->setDestUserId($request->getParameter('dest_user_id'));
                $favlike->setRecordModel($request->getParameter('record_model'));
                $favlike->setRecordId($request->getParameter('record_id'));

                if ($act == true)
                    $favlike->delete();
                else
                    $favlike->save();

                $setting_user = Doctrine::getTable('Setting_has_User')->SettingUser($favlike->getDestUserId(), '4');
                if ($setting_user) {
                    if ($setting_user->getIsActive() == true) {
                        $this->processMail($favlike->User, $favlike->DestUser);
                    }
                }
                $this->favlikes = Doctrine::getTable('favlike')->findByDql('record_model=? AND record_id=?', array($request->getParameter('record_model'), $request->getParameter('record_id')));
            }
        } else {
//            $this->redirect('unauthorized/index');
        }
    }

    public function processMail($user, $dest_user) {
        $this->data_sender = Doctrine::getTable('sfGuardUser')->find($user->getId());
        $this->data_user = Doctrine::getTable('sfGuardUser')->find($dest_user->getId());
        $body = $this->getPartial('processMail');
        $asunto = 'New Favlike';

        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $this->data_user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new FavlikeForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new FavlikeForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($favlike = Doctrine_Core::getTable('Favlike')->find(array($request->getParameter('id'))), sprintf('Object favlike does not exist (%s).', $request->getParameter('id')));
        $this->form = new FavlikeForm($favlike);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($favlike = Doctrine_Core::getTable('Favlike')->find(array($request->getParameter('id'))), sprintf('Object favlike does not exist (%s).', $request->getParameter('id')));
        $this->form = new FavlikeForm($favlike);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($favlike = Doctrine_Core::getTable('Favlike')->find(array($request->getParameter('id'))), sprintf('Object favlike does not exist (%s).', $request->getParameter('id')));
        $favlike->delete();

        $this->redirect('favlike/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $favlike = $form->save();

            $this->redirect('favlike/edit?id=' . $favlike->getId());
        }
    }

    public function executeList(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $guard = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'));
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'),  Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $this->favlikes = Doctrine_Core::getTable('Favlike')
                    ->createQuery('a')
                    ->where('a.user_id = ?', $this->datos->getId())
                    ->leftJoin('a.User u')
                    ->leftJoin('a.DestUser uu')
                    ->orderBy('a.created_at DESC')
                    ->execute();
        }else {
            $this->redirect('unauthorized/index');
        }
    }

}
