<?php

/**
 * BaseAlbum_photo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property integer $cover_id
 * @property integer $ord
 * @property string $name
 * @property Favlike $Favlikes
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Photos
 * 
 * @method integer             getId()       Returns the current record's "id" value
 * @method integer             getUserId()   Returns the current record's "user_id" value
 * @method integer             getCoverId()  Returns the current record's "cover_id" value
 * @method integer             getOrd()      Returns the current record's "ord" value
 * @method string              getName()     Returns the current record's "name" value
 * @method Favlike             getFavlikes() Returns the current record's "Favlikes" value
 * @method sfGuardUser         getUser()     Returns the current record's "User" value
 * @method Doctrine_Collection getPhotos()   Returns the current record's "Photos" collection
 * @method Album_photo         setId()       Sets the current record's "id" value
 * @method Album_photo         setUserId()   Sets the current record's "user_id" value
 * @method Album_photo         setCoverId()  Sets the current record's "cover_id" value
 * @method Album_photo         setOrd()      Sets the current record's "ord" value
 * @method Album_photo         setName()     Sets the current record's "name" value
 * @method Album_photo         setFavlikes() Sets the current record's "Favlikes" value
 * @method Album_photo         setUser()     Sets the current record's "User" value
 * @method Album_photo         setPhotos()   Sets the current record's "Photos" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAlbum_photo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('album_photo');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('cover_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('ord', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Favlike as Favlikes', array(
             'local' => 'id',
             'foreign' => 'record_id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasMany('Photo as Photos', array(
             'local' => 'id',
             'foreign' => 'album_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}