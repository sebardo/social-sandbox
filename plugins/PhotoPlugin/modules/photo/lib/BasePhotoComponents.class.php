<?php

class BasePhotoComponents extends sfComponents {

    public function executeList() {
        $params = array();
        $context = sfContext::getInstance();
        $this->sesionUserId = $this->getUser()->getGuardUser()->getId();
        if (isset($this->album)) {
            $params['album_id'] = $this->album->getId();
        } else {
            $params['user_id'] = $this->user->getId();
            $album = Doctrine::getTable('Album_photo')->getLastAlbum($params);
            $album = $album[0];
            $params['album_id'] = $album->getId();
            $this->album = $album;
        }
        $this->amountPhotos = Doctrine::getTable('Photo')->amountPhotos($params);
        $this->photos = Doctrine::getTable('Photo')->listPhotos($params);
        $this->isGalery = ($context->getModuleName() == 'photo') && ($context->getActionName() == 'index');
        $this->isMine = ($this->user->getId() == $this->sesionUserId);//echo var_dump($this->isMine);die();
        if ($this->isMine){
            $this->form = new PhotoForm();
            $this->form->setDefault('album_id', $params['album_id']);
        }
    }

    public function executeShow() {
    }

    public function executePubContent() {
        $this->photo = $this->obj;
    }
}