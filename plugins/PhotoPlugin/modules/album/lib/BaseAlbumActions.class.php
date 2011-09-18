<?php

/**
 * album actions.
 *
 * @package    sfSocial
 * @subpackage imagen
 * @author     Adrian Baez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BaseAlbumActions extends sfActions {
    public function executeShow(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->album = Doctrine::getTable('Album_photo')->find($request->getParameter('id'));
            $this->forward404Unless($this->album, 'This album not exists');
            $this->user = $this->album->getUser();
            $this->sesUser = $user->getGuardUser();
        } else {
            return $this->redirect('@homepage');
        }
    }
    public function executeOrd(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || !$this->getUser()->isAuthenticated());
        $userId = $request->getParameter('userId');
        if ($userId == $this->getUser()->getGuardUser()->getId()) {
            $temp = explode(',', $request->getParameter('ord'));
            foreach ($temp as $value) {
                $value = explode('=', $value);
                $id = $value[0];
                $ord = $value[1];
                $album = Doctrine::getTable('Album_photo')->find($id);
                $album->set('ord', $ord);
                $album->save();
            }
            return $this->renderText('ok');
        } else {
            return $this->renderText('You do not have permission to do that');
        }
    }
    public function executeEditTitle(sfWebRequest $request) {
        $title =            $request->getParameter('value');
        $albumId =          $request->getParameter('albumId');
        $album =            Doctrine::getTable('Album_photo')->find($albumId);
        $albumProfileName = Album_photo::getProfileAlbumName();

        if ($this->getUser()->isAuthenticated() && $album->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            if ($album->getName() != $albumProfileName && $title != $albumProfileName) {
                $album->name = $title;
                $album->save();
            }
        }
        return $this->renderText($album->getName());
    }
    public function executeDelete(sfWebRequest $request) {
        $albumId = $request->getParameter('albumId', false);
        $this->forward404Unless($albumId);
        $album = Doctrine::getTable('Album_photo')->find($albumId);
        $this->forward404Unless($album->exists());
        if ($this->getUser()->isAuthenticated() && $album->getUserId() == $this->getUser()->getGuardUser()->getId()) {
            return $this->renderText($album->delete());
        }
        return $this->renderText('You do not have permission to do that');
    }
}
