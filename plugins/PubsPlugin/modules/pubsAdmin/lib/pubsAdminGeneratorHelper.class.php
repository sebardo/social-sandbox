<?php

/**
 * pubsAdmin module helper.
 *
 * @package    PubsPlugin
 * @subpackage pubsAdmin
 * @author     Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class pubsAdminGeneratorHelper extends BasePubsAdminGeneratorHelper
{
  public function linkToIsDelete($object, $params)
  {
    return '<li class="sf_admin_action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), 'pubsAdmin/isDelete?id='.$object->getId()).'</li>';
  }

  public function linkToRestore($object, $params)
  {
    return '<li class="sf_admin_action_restore">'.link_to(__($params['label'], array(), 'sf_admin'), 'pubsAdmin/restore?id='.$object->getId()).'</li>';
  }

  public function linkToComments($object, $params)
  {
    $comments = Doctrine::getTable('comment')->countComments($object->getRecordId(),$object->getRecordModel());
    return '<li class="sf_admin_action_reply">'.link_to(__($params['label'], array(), 'sf_admin'), 'commentAdmin/filter?comment_filters[record_id][text]='.$object->getRecordId().'&comment_filters[record_model][text]='.$object->getRecordModel(),'post=true').' ('.$comments.')</li>';
  }
  
  public function linkToFavlikes($object, $params)
  {
    $comments = Doctrine::getTable('favlike')->countFavlikes($object->getRecordId(),$object->getRecordModel());
    return '<li class="sf_admin_action_reply">'.link_to(__($params['label'], array(), 'sf_admin'), 'favlikeAdmin/filter?favlike_filters[record_id][text]='.$object->getRecordId().'&favlike_filters[record_model][text]='.$object->getRecordModel(),'post=true').' ('.$comments.')</li>';
  }
  
  public function linkToSaveAndDelete($object, $params)
  {
    return '<li class="sf_admin_action_save_and_delete"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="save_and_delete" /></li>';
  }

  public function linkToSaveAndRestore($object, $params)
  {
    return '<li class="sf_admin_action_save_and_restore"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="save_and_restore" /></li>';
  }
}
