<?php

/**
 * Base Components for the InboxPlugin inbox module.
 * 
 * @package     InboxPlugin
 * @subpackage  base components
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class BaseinboxComponents extends sfComponents
{
  public function executeList(sfWebRequest $request)
  {
       
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
                $i = Doctrine_Query::create()
                   ->from('Inbox i')
   	           ->where('i.dest_user_id = ?',$user->getGuardUser()->getId())
//  	           ->andWhere('i.reply = ?',false)                       
	           ->orderBy('i.id DESC');
                $this->datos = $user->getGuardUser();
            } else {
                $this->redirect('@sf_guard_signin');
            }
            $this->inbox = new sfDoctrinePager('Inbox', 20);
            $this->inbox->setQuery($i);
            $this->inbox->setPage($this->getRequestParameter('page', 1));
            $this->inbox->init();
  }
  
 
  public function executeInboxRight(sfWebRequest $request)
  {
    $user = $this->getUser();
        if (!$user->isAuthenticated()) {
                $this->redirect('@sf_guard_signin');
        }
  }
  public function executeNewReply(sfWebRequest $request){
            $this->form = new InboxForm();
            $this->form->setDefault('user_id',$user_sf);
            $this->form->setDefault('dest_user_id',$request->getParameter('id_dest'));
            $this->form->setDefault('reply',true);
            $this->form->setDefault('record_id',$request->getParameter('messageID'));
  }
  public function executeBoxCount(sfWebRequest $request)
  {

  }
  public function executeList_one(sfWebRequest $request)
  {
      $user = $this->getUser();
            if ($user->isAuthenticated()) {
                $i = Doctrine_Query::create()
                    ->from('Inbox e')
                    ->where('e.id = ?', $this->messageID)
                    ->limit(1);
                $this->message = $i->fetchOne();
                
                $i = Doctrine_Query::create()
                    ->from('Inbox e')
                    ->where('e.id = ?', $this->message->getRecordId())
                    ->limit(1);
                $this->first_message = $i->fetchOne();
                
                //activo el mensaje porq ya fue leido
                Doctrine_Query::create()
                        ->update('Inbox e')
                        ->set('e.is_active', '?', true)
                        ->where('e.id = ?', $this->messageID)
                        ->execute();
               
                $this->user = Doctrine::getTable('sfGuardUser')->find($this->message->getUserId());
               
            }else {
                $this->redirect('@sf_guard_signin');
            }
  }
  public function executeMessagesInactives(sfWebRequest $request)
  {
       
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
                $i = Doctrine_Query::create()
                   ->from('Inbox i')
   	           ->where('i.dest_user_id = ?',$user->getGuardUser()->getId())
	           ->andWhere('i.is_active = ?',false)
	           ->orderBy('i.id DESC')
                   ->limit(30);
                $this->messages = $i->execute();
                
            }
            
  }
   public function executeListReplys(sfWebRequest $request)
  {
            
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
               
                 $i = Doctrine_Query::create()
                   ->from('Inbox i')
//  	           ->where('i.reply = ?',true)
                   ->where('i.record_id = ?', $this->record_id)
	           ->orderBy('i.created_at ASC');
                 $this->inbox = $i->execute();
                 
                 $this->datos = $user->getGuardUser();
            } else {
                $this->redirect('@sf_guard_signin');
            }
           
  }
  
}
