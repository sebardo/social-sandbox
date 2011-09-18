<?php

require_once dirname(__FILE__) . '/commentAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/commentAdminGeneratorHelper.class.php';

/**
 * BaseCommentAdmin actions.
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseCommentAdminActions extends autoCommentAdminActions {

    public function preExecute() {
        parent::preExecute();
        $this->getContext()->getConfiguration()->loadHelpers('I18N');
    }

    public function executeIsDelete(sfWebRequest $request) {
        $this->getRoute()->getObject()->delete();
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@commentAdmin');
    }

    public function executeNew(sfWebRequest $request) {
        $this->getUser()->setFlash('error', __('You can\'t add new comment. You can only reply to another comment.'));
        $this->redirect('@commentAdmin');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->comment = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->comment);
    }

    public function executeCreate(sfWebRequest $request) {
        $this->form = new commentAdminReplyForm();
        $this->comment = $this->form->getObject();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    public function executeRestore(sfWebRequest $request) {
        $this->getRoute()->getObject()->setIsDelete(false)->setEditionReason(null)->save();
        $this->getUser()->setFlash('notice', __('The item was restored successfully.', array(), 'sf_admin'));
        $this->redirect('@commentAdmin');
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $this->changeToDelete($request, true);
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@commentAdmin');
    }

    protected function executeBatchRestore(sfWebRequest $request) {
        $this->changeToDelete($request, false);
        $this->getUser()->setFlash('notice', __('The selected items have been restored successfully.', array(), 'sf_admin'));
        $this->redirect('@commentAdmin');
    }

    private function changeToDelete(sfWebRequest $request, $delete = true) {
        $ids = $request->getParameter('ids');

        $records = Doctrine_Query::create()
                ->from('Comment')
                ->whereIn('id', $ids)
                ->execute();

        foreach ($records as $record) {
            $record->setIsDelete($delete);
            if ($delete === false) {
                $record->setEditionReason(null);
            }
            $record->save();
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $comment = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ? 's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $comment)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@commentAdmin_new');
            } else if ($request->hasParameter('save_and_restore')) {
                $this->redirect('commentAdmin/restore?id=' . $comment->getId());
            } else if ($request->hasParameter('save_and_delete')) {
                $this->redirect('commentAdmin/isDelete?id=' . $comment->getId());
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'commentAdmin', 'sf_subject' => $comment));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

}

?>
