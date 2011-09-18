<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BasesettingsActions extends sfActions
{
     public function executeIndex(sfWebRequest $request) {
            $user = $this->getUser();
            if ($user->isAuthenticated()) {
                $this->datos = $user->getGuardUser();
                $this->forward404Unless($this->user = Doctrine::getTable('sfGuardUser')->find($this->datos->getId()), sprintf('Object fan does not exist (%s).', $this->datos->getId()));
                switch($request->getParameter('config')){
                    case 'basicinfo':
                        $this->form = new sfGuardSettingsBasicinfoForm($this->user);
                    break;
                    case 'aboutme':
                        $this->form = new sfGuardSettingsAboutmeForm($this->user);  
                    break;
                    case 'interests':
                        $this->form = new sfGuardSettingsInterestsForm($this->user);
                    break;
                    case 'detailinfo':
                        $this->form = new sfGuardSettingsDetailinfoForm($this->user);
                    break;
                    case 'name':
                        $this->form = new sfGuardSettingsNameForm($this->user);
                    break;
                    case 'changepassword':
                        $this->form = new sfGuardChangeUserPasswordForm($this->user);

//                        $this->w_provincias->setAttribute('onchange', jq_remote_function(array(
//                                'update' => 'filter_localidades',
//                                'url' => 'especialistas/searchlocalidades',
//                                'with' => "'provincia_id='+$('#provincia_id').val()",
//                            )));
                    break;
                    case 'notifications':
                        $this->form = new SettingsNotificationsForm();
                    break;
                }

            } else {
                $this->redirect('@sf_guard_signin');
            }

    }
     public function executeCreate(sfWebRequest $request)
    {
        $user = $this->getUser();
        $this->datos = $user->getGuardUser();
        $this->forward404Unless($u = Doctrine::getTable('sfGuardUser')->find($this->datos->getId()), sprintf('Object fan does not exist (%s).', $this->datos->getId()));
        switch($request->getParameter('config')){
                    case 'basicinfo':
                        $this->form = new sfGuardSettingsBasicinfoForm($u);
                    break;
                    case 'aboutme':
                        $this->form = new sfGuardSettingsAboutmeForm($u);
                    break;
                    case 'interests':
                        $this->form = new sfGuardSettingsInterestsForm($u);
                    break;
                    case 'detailinfo':
                        $this->form = new sfGuardSettingsDetailinfoForm($u);
                    break;
                    case 'name':
                        $this->form = new sfGuardSettingsNameForm($u);
                    break;
                    case 'changepassword':
                        $this->form = new sfGuardChangeUserPasswordForm($u);
                    break;
                
                }
        //si envio o no envio el form
        if ($request->isMethod('post')){
            $this->form->bind($request->getParameter($this->form->getName()));
                     if ($this->form->isValid()) {
                        $this->form->save();
                    }
        }
         $this->setTemplate('index');
    }
    public function executeCheckPassword(sfWebRequest $request){
         $this->getResponse()->setContentType('application/json');
         $user = $this->getUser();
         $this->datos = $user->getGuardUser();
         return $this->renderText(json_encode($this->datos->checkPassword($request->getParameter('pass'))));
    }
    public function executeSettingUser(sfWebRequest $request) {

  
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //reviso si no existe el registro
            $setting = Doctrine::getTable('Setting_has_User')->SettingUser($request->getParameter('user_id'), $request->getParameter('setting_id'));
            if (!$setting) {
            
                //creo el objeto si no existe
                $setting = new Setting_has_User($setting);
                //configuracion si el usuario quiere q soliciten el following
                
            }
            if ($setting) {
                if ($setting->getIsActive() == "1") {
                    $act = 0;
                } else {
                    $act = 1;
                }
            } else {
                //creo el objeto si no existe
                $setting = new Setting_has_User();
                //configuracion si el usuario quiere q soliciten el following
                $act = 1;
            }
            //creo el objeto y lo cargo
            $setting->setUserId($request->getParameter('user_id'));
            $setting->setSettingId($request->getParameter('setting_id'));
            $setting->setIsActive($act);

            //guardo el objeto
            $setting->save();
            //como no kiero que retorne ninguna vista utilizo esto
            return sfView::NONE;
        }
    }
     public function processMail($user) {
        $body = '<div style="padding:1em;color:#555555;font-family:Arial,helvetica,sans-serif;">';
        $body .= '<h2>Hola ' . $user->getUsername() . '</h2>';
        $body .= '<strong>Su cuenta se ha creado exitosamente. </strong><br>';
        
//        $body .= '<strong>En breve la administracion activara su cuenta y recibira un mensaje para poder acceder y disfrutar de la RED SOCIAL. Muchas Gracias.</strong><br>';
        
        $body .= 'Por favor haga click en el siguiente enlace para activar su cuenta <a href="'.sfConfig::get('app_base_url') . 'guard/register?salt=' . $user->getSalt() . '"><strong>REALIZAR ACTIVACION DE CUENTA.</strong></a>.<br/><br/></div>';

        $asunto = 'Nuevo Registro de Usuario';

        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }
}
?>
