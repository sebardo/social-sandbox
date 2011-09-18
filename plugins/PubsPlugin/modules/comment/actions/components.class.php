<?php

/**
 * comment components.
 *
 * @package    PubsPlugin
 * @subpackage comment components
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class commentComponents extends sfComponents {

    public function executeComments(sfWebRequest $request) {
        $this->form = new CommentForm();
        $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
        $this->form->setDefault('record_model', $this->model);
        $this->form->setDefault('record_id', $this->object->getId());
        $this->form->setDefault('dest_user_id', $this->object->getUserId());
        return $this->comments = $this->object->getComments();
    }

}

?>
