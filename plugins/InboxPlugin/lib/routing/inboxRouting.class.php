<?php

/**
 * InboxPlugin routing.
 *
 * @package     InboxPlugin
 * @subpackage  routing
 * @author      Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class inboxRouting {

    static public function addRouteForInboxs(sfEvent $event) {
        $event->getSubject()->prependRoute('inbox', new sfDoctrineRouteCollection(array(
                    'name' => 'inbox',
                    'model' => 'inbox',
                    'module' => 'inbox',
                    'prefix_path' => 'inbox',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

    static public function addRouteForAdminInboxs(sfEvent $event) {
        $event->getSubject()->prependRoute('inboxAdmin', new sfDoctrineRouteCollection(array(
                    'name' => 'inboxAdmin',
                    'model' => 'Inbox',
                    'module' => 'inboxAdmin',
                    'prefix_path' => 'admin-for-inboxs',
                    'with_wildcard_routes' => true,
                    'requirements' => array(),
                )));
    }

}