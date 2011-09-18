<?php
require_once dirname(__FILE__).'/inboxAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/inboxAdminGeneratorHelper.class.php';

/**
 * BaseCommentAdmin actions.
 *
 * @package    vjCommentPlugin
 * @subpackage commentAdmin
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseInboxAdminActions extends autoInboxAdminActions
{

     public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
        
    }

    public function executeIsDelete(sfWebRequest $request) {
        $this->getRoute()->getObject()->delete();
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@inboxAdmin');
    }
    public function executeComments(sfWebRequest $request) {
//        SELECT COUNT(*) AS num_results FROM comment c WHERE c.record_model = 'wall' AND c.user_id = '2'
//        $comment = $this->getRoute()->getObject();
//        $this->form = new commentAdminReplyForm();
//        $this->form->setDefault('record_model', $comment->record_model);
//        $this->form->setDefault('record_id', $comment->record_id);
//        $this->form->setDefault('reply', $comment->id);
//        if ($comment->user_id != null) {
//            $author = $comment->getUser()->username;
//        } else {
//            $author = $comment->author_name;
//        }
//        $this->form->setDefault('reply_author', $author);
//        $this->comment = $this->form->getObject();
//        $this->setTemplate('new');
    }
    protected function getPager() {
        $pager = $this->configuration->getPager('Comment');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function setPage($page) {
        $this->getUser()->setAttribute('inboxAdmin.page', $page, 'admin_module');
    }

    protected function getPage() {
        return $this->getUser()->getAttribute('inboxAdmin.page', 1, 'admin_module');
    }

    protected function addSortQuery($query) {
        if (array(null, null) == ($sort = $this->getSort())) {
            return;
        }

        if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
            $sort[1] = 'asc';
        }

        $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }

    protected function getSort() {
        if (null !== $sort = $this->getUser()->getAttribute('inboxAdmin.sort', null, 'admin_module')) {
            return $sort;
        }

        $this->setSort($this->configuration->getDefaultSort());

        return $this->getUser()->getAttribute('inboxAdmin.sort', null, 'admin_module');
    }

    protected function setSort(array $sort) {
        if (null !== $sort[0] && null === $sort[1]) {
            $sort[1] = 'asc';
        }

        $this->getUser()->setAttribute('inboxAdmin.sort', $sort, 'admin_module');
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Inbox')->hasColumn($column);
    }
//       public function executeList(sfWebRequest $request) {
//
//        $user = $this->getUser();
//        if ($user->isAuthenticated()) {
//            $q = Doctrine_Query::create()
//                            ->from('Wall e')
//                            //->where('e.user_id = ?', $user->getGuardUser()->getId())
//                            //->andWhere('e.featured = ?',true)
//                            ->orderBy('e.id DESC');
//            // ->limit($user->getGuardUser()->getId());
//        } else {
//            $this->redirect('@sf_guard_signin');
//        }
//        //$this->t = Doctrine::getTable('internacionalizacion')->getTraduccion();
//
//        $this->pager = new sfDoctrinePager('Wall', 20);
//        $this->pager->setQuery($q);
//        $this->pager->setPage($this->getRequestParameter('page', 1));
//        $this->pager->init();
//    }
//
protected function executeBatchDelete(sfWebRequest $request)
  {
    $this->changeToDelete($request, true);
    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    $this->redirect('@inboxAdmin');
  }
//
//  protected function executeBatchRestore(sfWebRequest $request)
//  {
//    $this->changeToDelete($request, false);
//    $this->getUser()->setFlash('notice', __('The selected items have been restored successfully.', array(), 'sf_admin'));
//    $this->redirect('@wallAdmin');
//  }
}
?>
