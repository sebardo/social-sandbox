<?php
/**
 *
 * PhotoPlugin routing.
 *
 * @package    PhotoPlugin
 * @author     Sebas-Sastus SEBARDO <dsastu@gmail.com>
 */
class PhotoRouting
{
  /**
   * Adds an sfDoctrineRouteCollection collection to manage comments.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForPhotos(sfEvent $event)
  {
    $event->getSubject()->prependRoute('photo', new sfDoctrineRouteCollection(array(
      'name'                => 'photo',
      'model'               => 'Photo',
      'module'              => 'photo',
      'prefix_path'         => 'photo',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
   static public function addRouteForAdminPhotos(sfEvent $event)
  {
    $event->getSubject()->prependRoute('photoAdmin', new sfDoctrineRouteCollection(array(
      'name'                => 'photoAdmin',
      'model'               => 'Photo',
      'module'              => 'photoAdmin',
      'prefix_path'         => 'admin-for-photos',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
  static public function addRouteForAlbums(sfEvent $event)
  {
    $event->getSubject()->prependRoute('album', new sfDoctrineRouteCollection(array(
      'name'                => 'album',
      'model'               => 'Album_photo',
      'module'              => 'album',
      'prefix_path'         => 'album',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
   static public function addRouteForAdminAlbums(sfEvent $event)
  {
    $event->getSubject()->prependRoute('albumAdmin', new sfDoctrineRouteCollection(array(
      'name'                => 'albumAdmin',
      'model'               => 'Album_photo',
      'module'              => 'albumAdmin',
      'prefix_path'         => 'admin-for-albums',
      'with_wildcard_routes' => true,
      'column'               => 'id',
      'requirements'        => array(),
    )));
  }
}