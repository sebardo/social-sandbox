<?php

/**
 * notification actions.
 *
 * @package    PubsPlugin
 * @subpackage notification
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class notificationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->notifications = Doctrine_Core::getTable('Notification')
      ->createQuery('a')
      ->where('dest_user_id=?', $this->getUser()->getGuardUser()->getId())
      ->orderBy('created_at DESC')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new NotificationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NotificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($notification = Doctrine_Core::getTable('Notification')->find(array($request->getParameter('id'))), sprintf('Object notification does not exist (%s).', $request->getParameter('id')));
    $this->form = new NotificationForm($notification);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($notification = Doctrine_Core::getTable('Notification')->find(array($request->getParameter('id'))), sprintf('Object notification does not exist (%s).', $request->getParameter('id')));
    $this->form = new NotificationForm($notification);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($notification = Doctrine_Core::getTable('Notification')->find(array($request->getParameter('id'))), sprintf('Object notification does not exist (%s).', $request->getParameter('id')));
    $notification->delete();

    $this->redirect('notification/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notification = $form->save();

      $this->redirect('notification/edit?id='.$notification->getId());
    }
  }
}
