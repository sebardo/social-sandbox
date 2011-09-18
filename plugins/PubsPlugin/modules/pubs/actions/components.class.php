<?php

class pubsComponents extends sfComponents {

    public function executeLogged_menubar_container() {
        $this->form = new searchUserForm();
        
        $user = $this->getUser();
        $this->news = $user->getGuardUser()->DestUserPubs->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(),$user->getGuardUser()->getId(), 0));
        $this->newsfav = $user->getGuardUser()->DestUserFavlikes->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(),$user->getGuardUser()->getId(), 0));
        $this->newscom = $user->getGuardUser()->DestUserComments->getTable()->findByDQL('dest_user_id=? and user_id!=? and is_active=?', array($user->getGuardUser()->getId(),$user->getGuardUser()->getId(), 0));
        
        foreach ($this->news as $pubs):
            if($pubs->getRecordModel() == 'text' || $pubs->getRecordModel() == 'link')
                Doctrine::getTable('notification')->insertNotification($pubs->getUserId(),$pubs->getDestUserId(), $pubs->getRecordModel(), $pubs->getId(),'pubs',$pubs->getCreatedAt());
            else
                Doctrine::getTable('notification')->insertNotification($pubs->getUserId(),$pubs->getDestUserId(), $pubs->getRecordModel(), $pubs->getRecordId(),$pubs->getRecordModel(),$pubs->getCreatedAt());
        endforeach;
        foreach ($this->newsfav as $fav):
                Doctrine::getTable('notification')->insertNotification($fav->getUserId(),$fav->getDestUserId(), 'favlike', $fav->getRecordId(), $fav->getRecordModel(),$fav->getCreatedAt());
            
        endforeach;
        foreach ($this->newscom as $com):
                Doctrine::getTable('notification')->insertNotification($com->getUserId(),$com->getDestUserId(), 'comment', $com->getRecordId(),$com->getRecordModel(),$com->getCreatedAt());
        endforeach;
        
        
    }
    
    public function executeLogout_menubar_container() {
        $this->form = new sfGuardFormSignin();
    }
    
    public function executeBoxCount() {
        
    }

    public function executeComponent_data_profile() {
        
    }
    
    public function executeComponent_data_profile_mail() {
        
    }

}

?>