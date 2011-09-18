<?php

/**
 * pubs actions.
 *
 * @package    sf_sandbox
 * @subpackage pubs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class nordestelabsActions extends sfActions {

    public function executeContact(sfWebRequest $request) {
        $this->processSendContact($request);
        $this->setTemplate('contact');
    }

    protected function processSendContact(sfWebRequest $request) {
        $this->sender = $request->getParameter('sender');
        $this->msj = $request->getParameter('msj');

        $message = Swift_Message::newInstance()
                ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'sandbox@nordestelabs.com'))
                ->setTo('dsastu@gmail.com')
                ->setSubject('Contact by NordesteLabs ')
                ->setBody($this->getPartial('nordestelabs/mailContact', array('sender' => $this->sender, 'msj' => $this->msj)))
                ->setContentType('text/html')
        ;

        $this->getMailer()->send($message);

    }

}

?>
