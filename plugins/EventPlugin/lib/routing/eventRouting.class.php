<?php
/**
 *
 * EventPlugin routing.
 *
 * @package    EventPlugin
 * @author     Sebas-Sastus SEBARDO <dsastu@gmail.com>
 */
class EventRouting
{
  /**
   * Adds an sfDoctrineRouteCollection collection to manage comments.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForEvents(sfEvent $event)
  {
    $event->getSubject()->prependRoute('event', new sfDoctrineRouteCollection(array(
      'name'                => 'event',
      'model'               => 'Event',
      'module'              => 'event',
      'prefix_path'         => 'event',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
   static public function addRouteForAdminEvents(sfEvent $event)
  {
    $event->getSubject()->prependRoute('eventAdmin', new sfDoctrineRouteCollection(array(
      'name'                => 'eventAdmin',
      'model'               => 'Event',
      'module'              => 'eventAdmin',
      'prefix_path'         => 'admin-for-events',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
}