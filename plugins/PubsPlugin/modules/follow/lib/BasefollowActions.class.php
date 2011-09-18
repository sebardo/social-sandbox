<?php

/**
 * base follow actions.
 * 
 * @package    PubsPlugin
 * @subpackage base actions
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BasefollowActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {
                $user = $this->getUser();

                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'),  Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $query = Doctrine::getTable('Follow')->createQuery('p')
                    ->where('p.user_id = ?', $this->datos->getId())
                    ->orderBy('p.created_at DESC');
            $this->followings = $query->execute();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeNewFollows(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = $user->getGuardUser();
        } else {
            $this->redirect('@sf_guard_signin');
        }
    }

    public function executeNewFollowing(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $w = Doctrine_Query::create()
                    ->from('Follow f')
                    ->where('f.follow_id = ?', $user->getGuardUser()->getId())
                    ->andWhere('f.is_active = ?', '2')
                    ->orderBy('f.created_at DESC')
                    ->limit(30);

            $this->follows = $w->execute();
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeFollowing(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //reviso si no existe el registro
            $following = Doctrine::getTable('Follow')->getFollowing($request->getParameter('user_id'), $request->getParameter('follow_id'));
            if (!$following) {
                //creo el objeto si no existe
                $following = new Follow();
                $following->setUserId($request->getParameter('user_id'));
                $following->setFollowId($request->getParameter('follow_id'));
                $following->setIsActive('2');
                $following->save();
            } else {
                $following->delete();
            }


            $setting_user = Doctrine::getTable('Setting_has_User')->SettingUser($following->getFollowId(), '2');
            if ($setting_user) {
                if ($setting_user->getIsActive() == true) {
                    $this->processMail($following);
                }
            }
            //como no kiero que retorne ninguna vista utilizo esto
            return sfView::NONE;
        }
    }

    public function processMail($user) {
        $this->data_sender = Doctrine::getTable('sfGuardUser')->find($user->getUserId());
        $this->data_user = Doctrine::getTable('sfGuardUser')->find($user->getFollowId());
        $body = $this->getPartial('processMail');
        $asunto = 'New Follow';

        $message = $this->getMailer()->compose('sandbox@nordestelabs.com', $this->data_user->getEmailAddress(), $asunto);
        $message->setBody($body, 'text/html');
        $this->getMailer()->send($message);
    }

    public function executeActivateFollowing(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //reviso si no existe el registro
            Doctrine_Query::create()
                    ->update('Follow e')
                    ->set('e.is_active', '?', true)
                    ->where('e.id = ?', $request->getParameter('id'))
                    ->andWhere('e.follow_id = ?', $user->getGuardUser()->getId())
                    ->execute();
            
            $follows = Doctrine::getTable('follow')->findBy('id', $request->getParameter('id'));
            $follow = $follows[0];
            $pub = Doctrine::getTable('pubs')->insertPub('follow', $follow->getId(), $follow->getUserId(), $follow->getUserId());
            Doctrine::getTable('notification')->insertNotification($follow->getFollowId(), $follow->getUserId(), 'follow', $follow->getId(), '', $pub->getCreatedAt());
        
            return sfView::NONE;
        }
    }

    public function executeDeleteFollowing(sfWebRequest $request) {
        //veo que el usuario este autenticado
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            //reviso si no existe el registro
            Doctrine_Query::create()
                    ->delete('Follow e')
                    ->where('e.id = ?', $request->getParameter('id'))
                    ->execute();
            //como no kiero que retorne ninguna vista utilizo esto
            return sfView::NONE;
        }
    }

    public function executeList(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {

                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'),  Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $query = Doctrine::getTable('Follow')->createQuery('p')
                    ->where('p.user_id = ?', $this->datos->getId())
                    ->orderBy('p.created_at DESC');
            $this->followings = $query->execute();
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    public function executeListFollowers(sfWebRequest $request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('user')) {

                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'),  Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $query = Doctrine::getTable('Follow')->createQuery('p')
                    ->where('p.follow_id = ?', $this->datos->getId())
                    ->orderBy('p.created_at DESC');
            $this->followers = $query->execute();
        } else {
            $this->redirect('unauthorized/index');
        }
    }

    private function fecha_a_timestamp($fechaCompleta) {
        $fecha = substr($fechaCompleta, 0, 9);
        $hora = substr($fechaCompleta, 10, -1);

        $arr1 = explode("-", $fecha);
        //cargo las variables de date
        $aaaa = $arr1[0];
        $mm = $arr1[1];
        $dd = $arr1[2];

        $arr2 = explode(":", $hora);
        $hh = $arr2[0];
        $mm = $arr2[1];
        $ss = $arr2[2];
        return (mktime($hh, $mm, $ss, $arr1[1], $arr1[2], $arr1[0]));
    }

    public function executeFecha(sfWebRequest $request) {
        $fecha = substr($request->getParameter('fechaCompleta'), 0, 9);
        $hora = substr($request->getParameter('fechaCompleta'), 10, -1);

        $arr1 = explode("-", $fecha);
        //cargo las variables de date
        $aaaa = $arr1[0];
        $mm = $arr1[1];
        $dd = $arr1[2];

        $arr2 = explode(":", $hora);
        $hh = $arr2[0];
        $mm = $arr2[1];
        $ss = $arr2[2];
        return (mktime($hh, $mm, $ss, $arr1[1], $arr1[2], $arr1[0]));
    }

}
