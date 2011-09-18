<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'       => new sfWidgetFormFilterInput(),
      'last_name'        => new sfWidgetFormFilterInput(),
      'email_address'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'             => new sfWidgetFormFilterInput(),
      'password'         => new sfWidgetFormFilterInput(),
      'sex'              => new sfWidgetFormFilterInput(),
      'birthday'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'aboutme'          => new sfWidgetFormFilterInput(),
      'profession'       => new sfWidgetFormFilterInput(),
      'music'            => new sfWidgetFormFilterInput(),
      'books'            => new sfWidgetFormFilterInput(),
      'films'            => new sfWidgetFormFilterInput(),
      'television'       => new sfWidgetFormFilterInput(),
      'games'            => new sfWidgetFormFilterInput(),
      'marital_status'   => new sfWidgetFormFilterInput(),
      'meeting_sex'      => new sfWidgetFormFilterInput(),
      'hometown'         => new sfWidgetFormFilterInput(),
      'borntown'         => new sfWidgetFormFilterInput(),
      'smoker'           => new sfWidgetFormFilterInput(),
      'drinker'          => new sfWidgetFormFilterInput(),
      'education'        => new sfWidgetFormFilterInput(),
      'language'         => new sfWidgetFormFilterInput(),
      'religion'         => new sfWidgetFormFilterInput(),
      'politic'          => new sfWidgetFormFilterInput(),
      'country'          => new sfWidgetFormFilterInput(),
      'city'             => new sfWidgetFormFilterInput(),
      'cp'               => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'contact'          => new sfWidgetFormFilterInput(),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'groups_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
    ));

    $this->setValidators(array(
      'first_name'       => new sfValidatorPass(array('required' => false)),
      'last_name'        => new sfValidatorPass(array('required' => false)),
      'email_address'    => new sfValidatorPass(array('required' => false)),
      'username'         => new sfValidatorPass(array('required' => false)),
      'algorithm'        => new sfValidatorPass(array('required' => false)),
      'salt'             => new sfValidatorPass(array('required' => false)),
      'password'         => new sfValidatorPass(array('required' => false)),
      'sex'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'birthday'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'aboutme'          => new sfValidatorPass(array('required' => false)),
      'profession'       => new sfValidatorPass(array('required' => false)),
      'music'            => new sfValidatorPass(array('required' => false)),
      'books'            => new sfValidatorPass(array('required' => false)),
      'films'            => new sfValidatorPass(array('required' => false)),
      'television'       => new sfValidatorPass(array('required' => false)),
      'games'            => new sfValidatorPass(array('required' => false)),
      'marital_status'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'meeting_sex'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hometown'         => new sfValidatorPass(array('required' => false)),
      'borntown'         => new sfValidatorPass(array('required' => false)),
      'smoker'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'drinker'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'education'        => new sfValidatorPass(array('required' => false)),
      'language'         => new sfValidatorPass(array('required' => false)),
      'religion'         => new sfValidatorPass(array('required' => false)),
      'politic'          => new sfValidatorPass(array('required' => false)),
      'country'          => new sfValidatorPass(array('required' => false)),
      'city'             => new sfValidatorPass(array('required' => false)),
      'cp'               => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'contact'          => new sfValidatorPass(array('required' => false)),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'groups_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserGroup sfGuardUserGroup')
      ->andWhereIn('sfGuardUserGroup.group_id', $values)
    ;
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserPermission sfGuardUserPermission')
      ->andWhereIn('sfGuardUserPermission.permission_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'first_name'       => 'Text',
      'last_name'        => 'Text',
      'email_address'    => 'Text',
      'username'         => 'Text',
      'algorithm'        => 'Text',
      'salt'             => 'Text',
      'password'         => 'Text',
      'sex'              => 'Number',
      'birthday'         => 'Date',
      'aboutme'          => 'Text',
      'profession'       => 'Text',
      'music'            => 'Text',
      'books'            => 'Text',
      'films'            => 'Text',
      'television'       => 'Text',
      'games'            => 'Text',
      'marital_status'   => 'Number',
      'meeting_sex'      => 'Number',
      'hometown'         => 'Text',
      'borntown'         => 'Text',
      'smoker'           => 'Number',
      'drinker'          => 'Number',
      'education'        => 'Text',
      'language'         => 'Text',
      'religion'         => 'Text',
      'politic'          => 'Text',
      'country'          => 'Text',
      'city'             => 'Text',
      'cp'               => 'Text',
      'description'      => 'Text',
      'contact'          => 'Text',
      'is_active'        => 'Boolean',
      'is_super_admin'   => 'Boolean',
      'last_login'       => 'Date',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'groups_list'      => 'ManyKey',
      'permissions_list' => 'ManyKey',
    );
  }
}
