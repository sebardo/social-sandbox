<?php
/**
 * audioAdmin module helper.
 *
 * @package    PubsPlugin
 * @subpackage audioAdmin
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 */
class audioAdminGeneratorHelper extends BaseAudioAdminGeneratorHelper
{
  public function linkToIsDelete($object, $params)
  {
    return '<li class="sf_admin_action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), 'audioAdmin/isDelete?id='.$object->getId()).'</li>';
  }

  public function linkToRestore($object, $params)
  {
    return '<li class="sf_admin_action_restore">'.link_to(__($params['label'], array(), 'sf_admin'), 'audioAdmin/restore?id='.$object->getId()).'</li>';
  }

  public function linkToFavlikes($object, $params)
  {
    $fav = Doctrine::getTable('Favlike')->countFavlikes($object->getId());
    return '<li class="sf_admin_action_reply">'.link_to(__($params['label'], array(), 'sf_admin'), 'favlikeAdmin/filter?comment_filters[record_id][text]='.$object->getId(),'post=true').' ('.$fav.')</li>';
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
