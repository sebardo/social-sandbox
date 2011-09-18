<?php

/**
 * BasePlaylist
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property text $description
 * @property string $image
 * @property boolean $is_active
 * @property integer $plays
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Audio_has_playlist
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getName()               Returns the current record's "name" value
 * @method integer             getUserId()             Returns the current record's "user_id" value
 * @method text                getDescription()        Returns the current record's "description" value
 * @method string              getImage()              Returns the current record's "image" value
 * @method boolean             getIsActive()           Returns the current record's "is_active" value
 * @method integer             getPlays()              Returns the current record's "plays" value
 * @method sfGuardUser         getUser()               Returns the current record's "User" value
 * @method Doctrine_Collection getAudioHasPlaylist()   Returns the current record's "Audio_has_playlist" collection
 * @method Playlist            setId()                 Sets the current record's "id" value
 * @method Playlist            setName()               Sets the current record's "name" value
 * @method Playlist            setUserId()             Sets the current record's "user_id" value
 * @method Playlist            setDescription()        Sets the current record's "description" value
 * @method Playlist            setImage()              Sets the current record's "image" value
 * @method Playlist            setIsActive()           Sets the current record's "is_active" value
 * @method Playlist            setPlays()              Sets the current record's "plays" value
 * @method Playlist            setUser()               Sets the current record's "User" value
 * @method Playlist            setAudioHasPlaylist()   Sets the current record's "Audio_has_playlist" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePlaylist extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('playlist');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('description', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('image', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('plays', 'integer', 11, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 11,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Audio_has_playlist', array(
             'local' => 'id',
             'foreign' => 'pl_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'canUpdate' => false,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}