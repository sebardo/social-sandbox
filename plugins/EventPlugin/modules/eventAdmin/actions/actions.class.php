<?php

require_once dirname(__FILE__) . '/../lib/eventAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/eventAdminGeneratorHelper.class.php';

/**
 * eventAdmin actions.
 *
 * @package    sf_sandbox
 * @subpackage eventAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventAdminActions extends autoEventAdminActions {

    public function executeNew(sfWebRequest $request) {
        $user = $this->getUser();
        $this->form = new AdminEventForm();
        $this->form->setDefaults(array('date' => date('m/d/Y'), 'user_id' => $user->getGuardUser()->getId()));
        $this->locationForm = new EventLocationForm();
        $this->event = $this->form->getObject();
    }

    public function executeEdit(sfWebRequest $request) {
        $user = $this->getUser();
        $event = Doctrine_Core::getTable('Event')->find(array($request->getParameter('id')));
        $this->forward404Unless($event, sprintf('Object event does not exist (%s).', $request->getParameter('id')));
        $this->form = new AdminEventForm($event);
        $this->locationForm = new EventLocationForm();
        $this->locationForm->setDefault('location', array('address' => $event->getAddress(), 'latitude' => $event->getLatitude(), 'longitude' => $event->getLongitude()));
        $this->event = $event;
    }

}
