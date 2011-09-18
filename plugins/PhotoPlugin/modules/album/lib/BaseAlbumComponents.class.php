<?php

class BaseAlbumComponents extends sfComponents {

    public function executeList() {
        $this->user=(isset($this->user))?$this->user:$this->getUser()->getGuardUser();
        $params=array();
        $page=(isset($this->page))? $this->page : 1;
        $this->sesionUserId = $this->getUser()->getGuardUser()->getId();
        $params['user_id']=$this->user->getId();
//        $isMyGalery=$this->sesionUserId==$params['user_id'];
//        $this->title = $isMyGalery?'My albums':'Albums by '.$this->user->getName();
        $this->form = new Album_photoForm();
        $this->form->setDefault('user_id', $params['user_id']);
        $this->amountAlbums=  Doctrine::getTable('Album_photo')->amountAlbums($params);
        $this->albums = new sfDoctrinePager('Album_photo', 6);
        $this->albums->setQuery(Album_photoTable::listAlbumsQuery($params));
        $this->albums->setPage($page);
        $this->albums->init();
    }

    public function executePubContent() {
        $this->album = $this->pub;
        $this->photos = $this->album->getLastPhoto(3);
    }
}