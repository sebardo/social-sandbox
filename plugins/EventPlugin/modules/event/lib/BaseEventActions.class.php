<?php

/**
 * Base actions for the eventPlugin event module.
 * 
 * @package     eventPlugin
 * @subpackage  event
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseEventActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->events = Doctrine_Core::getTable('Event')->getEvents();
        $this->titulo = sfContext::getInstance()->getI18n()->__('Events', null, 'event');
    }

    public function executeShow(sfWebRequest $request) {
        $this->event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->event && $this->event->getIsActive());
        $this->eventUser = Doctrine_Core::getTable('sfGuardUser')->find(array($this->event->getUserId()));
        
    }

    public function executeNew(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->form = new EventForm();
            $this->form->setDefault('user_id', $user->getGuardUser()->getId());
            $this->form->setDefaults(array('date' => date('m/d/Y'),'hour'=>date('H:i'),'user_id'=> $user->getGuardUser()->getId()));
            $this->locationForm = new EventLocationForm();
        } else {
            $this->redirect('event/index');
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->forward404Unless($request->isMethod(sfRequest::POST));

            $this->form = new EventForm();

            $this->processForm($request, $this->form);
            $this->locationForm = new EventLocationForm();
            $this->setTemplate('new');
        } else {
            $this->redirect('event/index');
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $user = $this->getUser();
        $this->forward404Unless($event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
        if ($user->isAuthenticated() && $user->getGuardUser()->getId() == $event->getUserId()) {
            $this->forward404Unless($event, sprintf('Object event does not exist (%s).', $request->getParameter('id')));
            $this->form = new EventForm($event);
            $this->locationForm = new EventLocationForm();
            $this->locationForm->setDefault('location', array('address' => $event->getAddress(), 'latitude' => $event->getLatitude(), 'longitude' => $event->getLongitude()));
            $this->event = $event;
        } else {
            $this->forward404('You do not have permission for this action');
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $user = $this->getUser();
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
        if ($user->isAuthenticated() && $user->getGuardUser()->getId() == $event->getUserId()) {
            $this->form = new EventForm($event);

            $this->processForm($request, $this->form);
            $this->locationForm = new EventLocationForm();
            $this->locationForm->setDefault('location', array('address' => $event->getAddress(), 'latitude' => $event->getLatitude(), 'longitude' => $event->getLongitude()));
            $this->event = $event;

            $this->setTemplate('edit');
        } else {
            $this->forward404('You do not have permission for this action');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $user = $this->getUser();
        $event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id')));
        if ($user->isAuthenticated() && $user->getGuardUser()->getId() == $event->getUserId()) {
            $event->delete();
            $this->redirect('event/list');
        } else {
            $this->forward404('You do not have permission for this action');
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $event = $form->save();
            $this->redirect('event/show?id=' . $event->getId());
        }
    }

    public function executeList(sfWebRequest $request) {
        if ($request->hasParameter('user')) {
            $requestedUser = $request->getParameter('user');
            if (is_numeric($requestedUser)) {
                $eventUser = Doctrine::getTable('sfGuardUser')->find($requestedUser);
            } else {
                $eventUser = Doctrine::getTable('sfGuardUser')->findOneBy('username', $requestedUser,Doctrine::HYDRATE_RECORD);
            }
            $this->forward404Unless($eventUser);
            $this->eventUser = $eventUser;
            $this->userId=$eventUser->getId();
            $params = array('user_id' => $eventUser->getId()); 
            $this->events = Doctrine_Core::getTable('Event')->getEvents($params);
            $this->setTemplate('index');
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
                $this->isMine = $eventUser->getId() == $user->getGuardUser()->getId();
                $this->titulo = $this->isMine ? 'My events' : 'Events by ' . $eventUser->getName();
            } else {
                $this->isMine = false;
                $this->titulo = 'Events by ' . $eventUser->getName();
            }
        } else {
            $this->redirect('event/index');
        }
    }

    public function executeSearchNear(sfWebRequest $request){
        $this->forward404Unless($request->isMethod('post'));
        $coors['lngMin']=$request->getParameter('lngMin');
        $coors['lngMax']=$request->getParameter('lngMax');
        $coors['latMin']=$request->getParameter('latMin');
        $coors['latMax']=$request->getParameter('latMax');
        $params=$request->getParameter('params',array());
        $this->getResponse()->setContentType('application/json');
        $res=Doctrine::getTable('Event')->searchNear($coors,$params)->exportTo('json');
        return $this->renderText($res);
    }

    public function executeSearchDateRange(sfWebRequest $request){
        $this->forward404Unless($request->isMethod('post'));
        $dates['min']=$request->getParameter('datemin');
        $dates['max']=$request->getParameter('datemax');
        $params=$request->getParameter('params',array());
        $this->getResponse()->setContentType('application/json');
        $res=Doctrine::getTable('Event')->searchDateRange($dates,$params)->exportTo('json');
        return $this->renderText($res);
    }
    
    public function executeGetCalendar(sfWebRequest $request){
        return $this->renderComponent('event', 'calendar');
    }
    
    public function executePrueba(sfWebRequest $request){
        return $this->renderText('<h1>Prueba</h1>');
        $this->setLayout(false);
    }

}
