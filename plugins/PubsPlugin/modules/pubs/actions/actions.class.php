<?php

/**
 * pubs actions.
 *
 * @package    sf_sandbox
 * @subpackage pubs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pubsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'), Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeNewAdvices(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->news = $user->getGuardUser()->DestUserPubs->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(), $user->getGuardUser()->getId(), 0));
            $this->newsfav = $user->getGuardUser()->DestUserFavlikes->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(), $user->getGuardUser()->getId(), 0));
            $this->newscom = $user->getGuardUser()->DestUserComments->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(), $user->getGuardUser()->getId(), 0));

            foreach ($this->news as $pubs):
                Doctrine::getTable('pubs')->activatePub($pubs->getId());
            endforeach;
            foreach ($this->newsfav as $fav):
                Doctrine::getTable('favlike')->activate($fav->getId());
            endforeach;
            foreach ($this->newscom as $com):
                Doctrine::getTable('comment')->activate($com->getId());
            endforeach;

            $notis = $this->getUser()->getGuardUser()->DestUserNotifications->getTable()->findByDQL('is_active=?', array(0));
            foreach ($notis as $noti):
                Doctrine::getTable('notification')->activate($noti->getId());
            endforeach;

            $this->notifications = Doctrine_Core::getTable('Notification')
                    ->createQuery('a')
                    ->where('dest_user_id=?', $this->getUser()->getGuardUser()->getId())
                    ->orderBy('created_at DESC')
                    ->limit(5)
                    ->execute();

            return $this->getTemplate('newAdvices');
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PubsForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($pubs = Doctrine_Core::getTable('Pubs')->find(array($request->getParameter('id'))), sprintf('Object pubs does not exist (%s).', $request->getParameter('id')));
        $this->form = new PubsForm($pubs);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($pubs = Doctrine_Core::getTable('Pubs')->find(array($request->getParameter('id'))), sprintf('Object pubs does not exist (%s).', $request->getParameter('id')));
        $this->form = new PubsForm($pubs);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($pubs = Doctrine_Core::getTable('Pubs')->find(array($request->getParameter('id'))), sprintf('Object pubs does not exist (%s).', $request->getParameter('id')));
        $pubs->delete();

        $this->redirect('pubs/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $pubs = $form->save();

            $this->redirect('pubs/edit?id=' . $pubs->getId());
        }
    }

    public function executeShowLastPub(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404Unless($this->pubs = Doctrine_Core::getTable('Pubs')->find(array($request->getParameter('id'))), sprintf('Object text does not exist (%s).', $request->getParameter('id')));
        $this->forward404Unless($this->datos = Doctrine_Core::getTable('sfGuardUser')->find(array($this->pubs->getDestUserId())), sprintf('Object text does not exist (%s).', $this->pubs->getDestUserId()));
    }

    public function executeInsertPub(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //creo el objeto y lo cargo
            $pubs = new Pubs();
            $pubs->setUserId($request->getParameter('user_id'));
            $pubs->setDestUserId($request->getParameter('dest_user_id'));
            $pubs->setRecordModel($request->getParameter('model'));
            $pubs->setRecordId($request->getParameter('record'));

            //guardo el objeto
            $pubs->save();
            $this->pub = $pubs;

            $this->redirect('pubs/showLastPub?id=' . $pubs->getId());
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
    
    public function executeShare(sfWebRequest $request) {
//        $user = $this->getUser();
//        if ($user->isAuthenticated()) {
            $this->url = $request->getParameter('url');
            $this->graph = OpenGraph::fetch($this->url);
//        } else {
//            $this->redirect('unauthorized/index');
//        }
    }

    public function executeSharebyMail(sfWebRequest $request) {
        $this->form = new sharingForm();
        $user = $this->getUser();
        if ($user->isAuthenticated())
            $this->form->setDefault('sender', $this->getUser()->getGuardUser()->getEmailAddress());
            $this->form->setDefault('url', $request->getParameter('url'));
        
    }

    public function executeSendShare(sfWebRequest $request) {
        $this->form = new sharingForm();
        $this->processSendShare($request, $this->form);
        $this->setTemplate('sharebyMail');
    }

   protected function processSendShare(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $obj = $request->getParameter($form->getName());
            $this->processMailShare($obj['sender'], $obj['dest'],$obj['url'], $obj['description']);
           $this->getUser()->setFlash('message', 'Your message has been sent to '. $obj['dest']);
            $this->redirect("pubs/sharebyMail");
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved
due to some errors.');
        }
    }

    protected function processMailShare($email_sender, $dest, $url, $desc) {
        $user = $this->getUser();
        if ($user->isAuthenticated())
            $this->user_sender = $this->getUser()->getGuardUser()->getUsername();
        $this->email_sender = $email_sender;
        $this->email_dest = $dest;
        $this->url = $url;
        $this->description = $desc;
        $body = $this->getPartial('processMailShare');
        $asunto = 'Share by Social SandBox ';
        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $this->email_dest, $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }
    public function executeDeleteConfirm(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->record_model = $request->getParameter('record_model');
            $this->record_id = $request->getParameter('record_id');
            $this->div_id = $request->getParameter('div_id');
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeDeletePub(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $object = Doctrine::getTable($request->getParameter('model'))->find($request->getParameter('id'));
            $object->delete();
            return sfView::NONE;
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeListAjax(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'), Doctrine::HYDRATE_RECORD);
                } else {

                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            if ($request->getParameter('pid')) {
                Doctrine::getTable('Pubs')->activatePub($request->getParameter('pid'));
                $this->pub = Doctrine::getTable('Pubs')->findOneBy('id', $request->getParameter('pid'));
            } else {
                $query = Doctrine::getTable('Pubs')->createQuery('p')
                        ->where('p.dest_user_id = ?', $this->datos->getId())
//                        ->andWhere('p.record_model != ?', 'follow')
//                        ->leftJoin('p.User u')
//                        ->leftJoin('p.DestUser uu')
                        ->orderBy('p.created_at DESC');
                $this->pubss = $query->execute();
            }
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeListAjaxMorePage(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user_id'));
            $query = Doctrine::getTable('Pubs')->createQuery('p')
                    ->where('p.dest_user_id = ?', $this->datos->getId())
                    ->leftJoin('p.User u')
                    ->leftJoin('p.DestUser uu')
                    ->orderBy('p.created_at DESC');

            $max_per_page = '10';

            $this->pager = new sfDoctrinePager('Pubs', $max_per_page);
            $this->pager->setQuery($query);
            $this->pager->setPage($request->getParameter('page'));
            $this->pager->init();
            $this->cpt = $max_per_page * ($page - 1);
            $this->page = $request->getParameter('page') + 1;
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executePublishing(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->pub = new Pubs();
            $this->pub->setUserId($this->getUser()->getGuardUser()->getId());
            $this->pub->setDestUserId($request->getParameter('duid'));
            $this->pub->setRecordModel($request->getParameter('model'));
            $this->pub->setRecordId($request->getParameter('record'));
            $this->pub->save();
        } else {
            $this->redirect('unauthorized/index');
        }
    }
    
    public function executeSharePub(sfWebRequest $request) {
        $this->forward404Unless($pid=$request->getParameter('pid'),'No existe el parametro pid');
        $this->forward404Unless($this->pub = Doctrine::getTable('Pubs')->findOneBy('id', $pid),'No existe publiccion con id= '.$pid);
        $this->datos=$this->pub->getUser();
        $tags = new OGPTags($this->pub);
        $ogptags = $this->getPartial('ogptags', array('tags' => $tags->getTags()));
        slot('ogptags', $ogptags);
        slot('title', $this->pub->getTitle());
    }
    
    public function executeProfile(sfWebRequest $request) {
        $user = $this->getUser();
        
            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'), Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
        
            
    }

}

