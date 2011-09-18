<?php

/**
 * audio actions.
 *
 * @package    PubsPlugin
 * @subpackage audio
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class audioActions extends sfActions {

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
            $this->audios = Doctrine_Core::getTable('Audio')
                    ->createQuery('a')
                    ->where('a.user_id=?', $this->getUser()->getGuardUser()->getId())
                    ->orderBy('a.id DESC')
                    ->execute();
            $q_pl = Doctrine_Query::create()
                    ->from('Playlist e')
                    ->where('e.user_id = ?', $user->getGuardUser()->getId())
                    ->andWhere('e.is_active = ?', true)
                    ->orderBy('e.id DESC');
            $this->playlists = $q_pl->execute();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

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
            $this->form = new AudioForm();
            $this->form->setDefault('dest_user_id', $request->getParameter('duid'));
            $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AudioForm();
        $audio = $request->getParameter('audio');
        $this->duid = $audio['dest_user_id'];
        $this->audio = $audio['audio'];

        $this->processForm($request, $this->form, $this->duid, $this->audio);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($audio = Doctrine_Core::getTable('Audio')->find(array($request->getParameter('id'))), sprintf('Object audio does not exist (%s).', $request->getParameter('id')));
        $this->form = new AudioForm($audio);
        $this->form->setDefault('dest_user_id', $request->getParameter('duid'));
        $this->duid = $request->getParameter('duid');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($audio = Doctrine_Core::getTable('Audio')->find(array($request->getParameter('id'))), sprintf('Object audio does not exist (%s).', $request->getParameter('id')));
        $this->form = new AudioForm($audio);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($audio = Doctrine_Core::getTable('Audio')->find(array($request->getParameter('id'))), sprintf('Object audio does not exist (%s).', $request->getParameter('id')));
        $audio->delete();

        $this->redirect('audio/new?duid=' . $request->getParameter('duid') . '&delete=1');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $duid, $audio) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $audio = $form->save();
            $obj = $form->getObject();
            if ($obj->getDescription() == '') {
                $obj->setDescription('Song_' . $obj->getId());
                $obj->save();
            }
            $this->redirect('audio/edit?id=' . $audio->getId() . '&duid=' . $duid . '&audio=' . $audio);
        }
    }

    public function executePlays(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $audio = Doctrine::getTable('Audio')->find($id);
        if ($this->getUser()->isAuthenticated() && $audio->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $plays = $audio->getPlays() + 1;
            $audio->setPlays($plays);
            $audio->save();
        }
        return $this->renderText($audio->getPlays());
    }

    public function executeNewPL(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //creo el objeto y lo cargo
            $pl = new Playlist();
            $pl->setUserId($user->getGuardUser()->getId());
            $pl->setDescription($request->getParameter('obj'));
            $pl->setIsActive('1');
            //guardo el objeto
            $pl->save();
            $id = $pl->getId();
            $pl->setName('My playlist_' . $id);
            $pl->save();
            return sfView::NONE;
        }
    }

    public function executeListPlays(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $pl = Doctrine::getTable('Playlist')->find($id);
        if ($this->getUser()->isAuthenticated() && $pl->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $plays = $pl->getPlays() + 1;
            $pl->setPlays($plays);
            $pl->save();
        }
        return $this->renderText($pl->getPlays());
    }

    public function executeEditName(sfWebRequest $request) {
        $titulo = $request->getParameter('value');
        $id = $request->getParameter('id');
        $audio = Doctrine::getTable('Audio')->find($id);
        if ($this->getUser()->isAuthenticated() && $audio->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $audio->setName($titulo);
            $audio->save();
        }
        return $this->renderText($audio->getName());
    }

    public function executeEditListName(sfWebRequest $request) {
        $name = $request->getParameter('value');
        $id = $request->getParameter('id');
        $pl = Doctrine::getTable('Playlist')->find($id);
        if ($this->getUser()->isAuthenticated() && $pl->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            $pl->setName($name);
            $pl->save();
        }
        return $this->renderText($pl->getName());
    }

    public function executeShowLast(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404Unless($pub = Doctrine_Core::getTable('Pubs')->find(array($request->getParameter('id'))), sprintf('Object text does not exist (%s).', $request->getParameter('id')));
        $obj = $pub->getObject();
        $this->audio = $obj[0];
    }

}
