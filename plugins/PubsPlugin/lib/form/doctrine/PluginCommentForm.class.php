<?php

/**
 * Comment form.
 *
 * @package    PubsPlugin
 * @subpackage form
 * @author     Dario Sebastian Sasturain
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCommentForm extends BaseCommentForm
{
  public function setup()
  {  
       
   $this->setWidgets(array(
      'user_id'      => new sfWidgetFormInputHidden(),
      'dest_user_id' => new sfWidgetFormInputHidden(),
      'record_model' => new sfWidgetFormInputHidden(),
      'record_id' => new sfWidgetFormInputHidden(),
      'description'  => new sfWidgetFormTextarea(),

    ));

  }
}
