<?php

/**
 * PubsPlugin routing.
 *
 * @package    PubsPlugin
 * @author     Sebas-Sastus SEBARDO <dsastu@gmail.com>
 */
class pubsRouting {
    ////////////////////////////////Home///////////////////////////////////
    static public function addRouteForHome(sfEvent $event) {
        $event->getSubject()->prependRoute('home', new sfDoctrineRouteCollection(array(
                    'name' => 'home',
                    'model' => 'Pubs',
                    'module' => 'home',
                    'prefix_path' => 'home',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    ////////////////////////////////Pubs///////////////////////////////////
    static public function addRouteForPubs(sfEvent $event) {
        $event->getSubject()->prependRoute('pubs', new sfDoctrineRouteCollection(array(
                    'name' => 'pubs',
                    'model' => 'Pubs',
                    'module' => 'pubs',
                    'prefix_path' => 'pubs',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    static public function addRouteForAdminPubs(sfEvent $event) {
        $event->getSubject()->prependRoute('pubsAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'pubsAdmin',
                    'model' => 'Pubs',
                    'module' => 'pubsAdmin',
                    'prefix_path' => 'admin-for-pubs',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    ////////////////////////////////Favlikess///////////////////////////////////
    static public function addRouteForFavlikes(sfEvent $event) {
        $event->getSubject()->prependRoute('favlikes', new sfDoctrineRouteCollection(array(
                    'name' => 'favlike',
                    'model' => 'Favlike',
                    'module' => 'favlike',
                    'prefix_path' => 'favlikes',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    static public function addRouteForAdminFavlikes(sfEvent $event) {
        $event->getSubject()->prependRoute('favlikeAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'favlikeAdmin',
                    'model' => 'Favlike',
                    'module' => 'favlikeAdmin',
                    'prefix_path' => 'admin-for-favlike',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    ////////////////////////////////Audio///////////////////////////////////
    static public function addRouteForAudios(sfEvent $event) {
        $event->getSubject()->prependRoute('audio', new sfDoctrineRouteCollection(array(
                    'name' => 'audio',
                    'model' => 'Audio',
                    'module' => 'audio',
                    'prefix_path' => 'audio',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    static public function addRouteForAdminAudios(sfEvent $event) {
        $event->getSubject()->prependRoute('audioAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'audioAdmin',
                    'model' => 'Audio',
                    'module' => 'audioAdmin',
                    'prefix_path' => 'admin-for-audios',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

////////////////////////////////SETTINGS///////////////////////////////////
    static public function addRouteForSettings(sfEvent $event) {
        $event->getSubject()->prependRoute('settings', new sfDoctrineRouteCollection(array(
                    'name' => 'settings',
                    'model' => 'Wall',
                    'module' => 'settings',
                    'prefix_path' => 'settings',
                    'with_wildcard_routes' => true,
                )));
    }

    static public function addRouteForSettingsCheckPass(sfEvent $event) {
        $r = $event->getSubject();
        $r->prependRoute('setting_checkpassword', new sfRoute('/settings/checkpassword', array('module' => 'settings', 'action' => 'checkPassword')));
    }

    ////////////////////////////////FOLLOWS///////////////////////////////////
    static public function addRouteForFollows(sfEvent $event) {
        $event->getSubject()->prependRoute('follow', new sfDoctrineRouteCollection(array(
                    'name' => 'follow',
                    'model' => 'Wall',
                    'module' => 'follow',
                    'prefix_path' => 'followings',
                    'with_wildcard_routes' => true,
                    'requirements' => array('user' => '\d+'),
                )));
    }

    static public function addRouteForAdminFollows(sfEvent $event) {
        $event->getSubject()->prependRoute('followAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'followAdmin',
                    'model' => 'Follow',
                    'module' => 'followAdmin',
                    'prefix_path' => 'admin-for-follows',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    static public function addRouteForNewFollows(sfEvent $event) {
        $r = $event->getSubject();
        $r->prependRoute('newFollows', new sfRoute('/newFollows', array('module' => 'follow', 'action' => 'newFollows'), array('user' => '\d+')));
    }
    
    ////////////////////////////////Comments///////////////////////////////////
    static public function addRouteForAdminComments(sfEvent $event) {
        $event->getSubject()->prependRoute('commentAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'commentAdmin',
                    'model' => 'Comment',
                    'module' => 'commentAdmin',
                    'prefix_path' => 'admin-for-comments',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }
}