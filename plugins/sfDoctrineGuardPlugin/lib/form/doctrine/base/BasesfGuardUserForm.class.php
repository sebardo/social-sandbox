<?php

/**
 * sfGuardUser form base class.
 *
 * @method sfGuardUser getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'first_name'       => new sfWidgetFormInputText(),
      'last_name'        => new sfWidgetFormInputText(),
      'email_address'    => new sfWidgetFormInputText(),
      'username'         => new sfWidgetFormInputText(),
      'algorithm'        => new sfWidgetFormInputText(),
      'salt'             => new sfWidgetFormInputText(),
      'password'         => new sfWidgetFormInputText(),
      'sex'              => new sfWidgetFormInputText(),
      'birthday'         => new sfWidgetFormDate(),
      'aboutme'          => new sfWidgetFormTextarea(),
      'profession'       => new sfWidgetFormTextarea(),
      'music'            => new sfWidgetFormTextarea(),
      'books'            => new sfWidgetFormTextarea(),
      'films'            => new sfWidgetFormTextarea(),
      'television'       => new sfWidgetFormTextarea(),
      'games'            => new sfWidgetFormTextarea(),
      'marital_status'   => new sfWidgetFormInputText(),
      'meeting_sex'      => new sfWidgetFormInputText(),
      'hometown'         => new sfWidgetFormInputText(),
      'borntown'         => new sfWidgetFormInputText(),
      'smoker'           => new sfWidgetFormInputText(),
      'drinker'          => new sfWidgetFormInputText(),
      'education'        => new sfWidgetFormInputText(),
      'language'         => new sfWidgetFormInputText(),
      'religion'         => new sfWidgetFormInputText(),
      'politic'          => new sfWidgetFormInputText(),
      'country_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'city_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'cp'               => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'contact'          => new sfWidgetFormInputText(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'is_super_admin'   => new sfWidgetFormInputCheckbox(),
      'last_login'       => new sfWidgetFormDateTime(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'groups_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_address'    => new sfValidatorString(array('max_length' => 255)),
      'username'         => new sfValidatorString(array('max_length' => 128)),
      'algorithm'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'             => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'sex'              => new sfValidatorInteger(array('required' => false)),
      'birthday'         => new sfValidatorDate(),
      'aboutme'          => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'profession'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'music'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'books'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'films'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'television'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'games'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'marital_status'   => new sfValidatorInteger(array('required' => false)),
      'meeting_sex'      => new sfValidatorInteger(array('required' => false)),
      'hometown'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'borntown'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'smoker'           => new sfValidatorInteger(array('required' => false)),
      'drinker'          => new sfValidatorInteger(array('required' => false)),
      'education'        => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'language'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'religion'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'politic'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'country_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'city_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
      'cp'               => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'contact'          => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'   => new sfValidatorBoolean(array('required' => false)),
      'last_login'       => new sfValidatorDateTime(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'groups_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['groups_list']))
    {
      $this->setDefault('groups_list', $this->object->Groups->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['permissions_list']))
    {
      $this->setDefault('permissions_list', $this->object->Permissions->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveGroupsList($con);
    $this->savePermissionsList($con);

    parent::doSave($con);
  }

  public function saveGroupsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['groups_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Groups->getPrimaryKeys();
    $values = $this->getValue('groups_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Groups', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Groups', array_values($link));
    }
  }

  public function savePermissionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['permissions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Permissions->getPrimaryKeys();
    $values = $this->getValue('permissions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Permissions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Permissions', array_values($link));
    }
  }

}
