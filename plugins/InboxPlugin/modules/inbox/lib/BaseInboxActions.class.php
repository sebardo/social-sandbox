<?php

/**
 * Base actions for the InboxPlugin inbox module.
 * 
 * @package     InboxPlugin
 * @subpackage  base actions
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class BaseInboxActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = $user->getGuardUser();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = new InboxForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {

            $message = $form->save();
            $obj = $form->getObject();
            $obj->setRecordId($obj->getId());
            $obj->save();

            $setting_user = Doctrine::getTable('Setting_has_User')->SettingUser($obj->getDestUserId(), '1');
            if ($setting_user) {
                if ($setting_user->getIsActive() == true) {
                    $this->processMail($obj);
                }
            }



            $this->redirect("inbox/show");
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved
due to some errors.');
        }
    }

    protected function processMail($user) {
        $this->data_sender = Doctrine::getTable('sfGuardUser')->find($user->getUserId());
        $this->data_user = Doctrine::getTable('sfGuardUser')->find($user->getDestUserId());
        $body = $this->getPartial('processMail');
        $asunto = 'New Private Message';

        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $this->data_user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }

    public function executeShow(sfWebRequest $request) {


        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $user_sf = $user->getGuardUser()->getId();
            $q = Doctrine_Query::create()
                    ->from('inbox m')
                    ->where('m.user_id = ?', $user_sf)
                    ->orderby('m.created_at DESC')
                    ->limit(1);
            $this->inbox = $q->fetchOne();

            $this->datos = $this->getUser()->getGuardUser();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeIframeFormMessage(sfWebRequest $request) {
        
    }

    public function executeNew(sfWebRequest $request) {
//        $this->uid = $this->getUser()->getUid() ;
        $this->form = new InboxForm();
        $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
    }

    public function executeLastMessage(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $user_sf = $user->getGuardUser()->getId();

            $i = Doctrine_Query::create()
                    ->from('inbox m')
                    ->where('m.user_id = ?', $user_sf)
                    ->orderby('m.created_at DESC')
                    ->limit(1);
            $this->message = $i->fetchOne();

            $this->datos = $this->getUser()->getGuardUser();

            return $this->renderPartial('inbox/lastMessage');
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeDeleteMessage(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if (!$user->isAuthenticated()) {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($message = Doctrine_Core::getTable('Inbox')->find(array($request->getParameter('id'))), sprintf('Object audio does not exist (%s).', $request->getParameter('id')));
        if ($message->getDestUserId() == $this->getUser()->getGuardUser()->getId()) {
            $message->delete();
            return sfView::NONE;
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeGetUsers(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
// Parametro 'q', contiene lo que fue introducido en el campo por teclado
        $string = $request->getParameter('q');

// Consulta al modelo Estado
        $rows = Doctrine::getTable('sfGuardUser')->getUsersWith($string);

        $users = array();
        foreach ($rows as $row) {
            $result = Doctrine::getTable('sfGuardUser')->find($row->getId());

            $image = $result->getImage();
            $users[$row->getId()] = "<img src='" . $image . "' width='32' class='thumb' >" . $row->getUsername() . " (" . $row->getName() . ")";
        }

        return $this->renderText(json_encode($users));
    }

    public function executeNewMessages(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->messages = $user->getGuardUser()->InboxsDest->getTable()->findByDQL('dest_user_id=? and is_active=?', array($user->getGuardUser()->getId(), 0));
            foreach ($this->messages as $message):
                Doctrine::getTable('Inbox')->activateReply($message->getId());
            endforeach;
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeInboxRightAjax(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {

            $this->messageID = $request->getParameter('messageID');
            $this->datos = $user->getGuardUser();

            $i = Doctrine_Query::create()
                    ->from('Inbox e')
                    ->where('e.id = ?', $this->messageID)
                    ->limit(1);
            $this->message = $i->fetchOne();

            if ($this->message) {
                $i = Doctrine_Query::create()
                        ->from('Inbox e')
                        ->where('e.id = ?', $this->message->getRecordId())
                        ->limit(1);
                $this->first_message = $i->fetchOne();
            }

//activo el mensaje porq ya fue leido
            Doctrine_Query::create()
                    ->update('Inbox e')
                    ->set('e.is_active', '?', true)
                    ->where('e.id = ?', $request->getParameter('messageID'))
                    ->execute();

//form for new entry reply
            $this->form = new PluginInboxFormReply();
            $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
            $this->form->setDefault('reply', true);

            if ($this->first_message) {
                $this->form->setDefault('record_id', $this->first_message->getRecordId());
                if ($this->first_message->getUserId() == $this->getUser()->getGuardUser()->getId()) {
                    $this->dest = $this->first_message->getDestUserId();
                } else {
                    $this->dest = $this->first_message->getUserId();
                }
            }
            $this->form->setDefault('dest_user_id', $this->dest);
//            return $this->renderPartial('inbox/inboxRigth');
            $this->setTemplate('inboxRight');
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeInsertReply(sfWebRequest $request) {
//veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
//creo el objeto y lo cargo
            $reply = new Inbox();
            $reply->setUserId($request->getParameter('id'));
            $reply->setDestUserId($request->getParameter('id_a'));
            $reply->setDescription($request->getParameter('message'));
            $reply->setIsActive(false);
            $reply->setReply(true);
            $reply->setRecordId($request->getParameter('record_id'));
//guardo el objeto
            $reply->save();
//como no kiero que retorne ninguna vista utilizo esto
            return sfView::NONE;
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeLastReply(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $i = Doctrine_Query::create()
                    ->from('inbox m')
                    ->where('m.record_id = ?', $request->getParameter('recordId'))
                    ->orderby('m.created_at DESC')
                    ->limit(1);
            $this->message = $i->fetchOne();

            return $this->renderPartial('inbox/lastReply');
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

}
