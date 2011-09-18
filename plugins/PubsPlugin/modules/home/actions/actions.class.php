<?php

/**
 * home actions.
 *
 * @package    PubsPlugin
 * @subpackage home
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if (!$request->getParameter('sf_culture')) {
                if ($this->getUser()->isFirstRequest()) {
                    $culture = $request->getPreferredCulture(array('en', 'es', 'fr', 'it', 'de', 'ca'));
                    $this->getUser()->setCulture($culture);
                    $this->getUser()->isFirstRequest(false);
                } else {
                    $culture = $this->getUser()->getCulture();
                }

                $this->redirect('localized_homepage');
            }

            if (!$request->getParameter('user')) {
                $this->datos = $user->getGuardUser();
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'), Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
        } else {
            if (!$request->getParameter('user')) {
                $this->redirect('@sf_guard_signin');
            } else {
                if (!is_numeric($request->getParameter('user'))) {
                    $this->datos = Doctrine::getTable('sfGuardUser')->findOneBy('username', $request->getParameter('user'), Doctrine::HYDRATE_RECORD);
                } else {
                    $this->datos = Doctrine::getTable('sfGuardUser')->find($request->getParameter('user'));
                }
            }
            $tags = new OGPTags($this->datos);
            $this->ogptags = $this->getPartial('pubs/ogptags', array('tags' => $tags->getTags()));
            $this->setTemplate('profile');
        }
    }

    public function executeListAjaxHome(sfWebRequest $request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            $this->datos = $user->getGuardUser();

            $this->followings = $this->datos->getFollowing()->getTable()->findByDQL('user_id=? and is_active=?', array($this->datos->getId(), true));
            if (count($this->followings) > 0) {
                $query = Doctrine::getTable('Pubs')->createQuery('p');

                $x = 0;
                foreach ($this->followings as $following):
                    if ($x == 0) {
                        $x++;
                        $query->where('p.user_id = ?', $following->getFollowId());
                    } else {
                        $query->orWhere('p.user_id = ?', $following->getFollowId());
                    }
                endforeach;

                $query->orderBy('p.created_at DESC');
                $this->pubss = $query->execute();
            }
        } else {
            $this->redirect('unauthorized/index');
        }
    }

}
