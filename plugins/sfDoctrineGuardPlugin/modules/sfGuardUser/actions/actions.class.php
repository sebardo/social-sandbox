<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardUserActions extends autoSfGuardUserActions
{
     public function executeListActivate(sfWebRequest $request) {
        $user = $this->getRoute()->getObject();
       //echo var_dump($user->getIsActive());
       if ($user->getIsActive() == true) {
            $user->setIsActive(false);
        } else {
            $user->setIsActive(true);
            $this->processMail($user);
            
        }
        $user->save();
        //$job->extend(true);

       // $this->getUser()->setFlash('notice', 'The selected jobs have been extended successfully.');

        $this->redirect('@sf_guard_user');
    }
    public function processMail($user) {
        $body = '<div style="padding:1em;color:#555555;font-family:Arial,helvetica,sans-serif;">';
        $body .= '<h2>Hola ' . $user->getUsername() . '</h2>';
        $body .= '<strong>Su cuenta se ha creado y activado exitosamente. </strong><br>';

        $body .= 'Por favor haga click en el siguiente enlace para <a href="'.sfConfig::get('app_base_url') . '"><strong>INGRESAR A LA RED SOCIAL.</strong></a>.<br/><br/></div>';

        $asunto = 'Nuevo Registro de Usuario';

        $message = $this->getMailer()->compose('dsastu@gmail.com', $user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }
}
