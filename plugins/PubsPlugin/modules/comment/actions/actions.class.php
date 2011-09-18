<?php

/**
 * comment actions.
 *
 * @package    PubsPlugin
 * @subpackage comment
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions {

    public function executeInsertComment(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->comment = new Comment();
            $this->comment->setUserId($request->getParameter('user_id'));
            $this->comment->setDestUserId($request->getParameter('dest_user_id'));
            $this->comment->setRecordModel($request->getParameter('record_model'));
            $this->comment->setRecordId($request->getParameter('record_id'));

            $pure = new pubsPurifier();
            $pure_text = $pure->purify($request->getParameter('comment'));

            $this->comment->setDescription($pure_text);

            $this->comment->save();
            $this->datos = $this->getUser()->getGuardUser();

            $setting_user = Doctrine::getTable('Setting_has_User')->SettingUser($this->comment->getDestUserId(), '4');
            if ($setting_user) {
                if ($setting_user->getIsActive() == true) {
                    $this->processMail($this->comment);
                }
            }


            $this->renderPartial('comment');
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
        $comment->delete();

        $this->redirect('comment/index');
    }

    protected function processMail($user) {
        $this->data_sender = Doctrine::getTable('sfGuardUser')->find($user->getUserId());
        $this->data_user = Doctrine::getTable('sfGuardUser')->find($user->getDestUserId());
        $body = $this->getPartial('processMail');
        $asunto = 'New Comment';

        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $this->data_user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }

}
