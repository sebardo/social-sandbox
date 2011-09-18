<?php

require_once dirname(__FILE__) . '/pubsAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/pubsAdminGeneratorHelper.class.php';

/**
 * BasePubsAdmin actions.
 *
 * @package    PubsPlugin
 * @subpackage pubsAdmin
 * @author     Dario Sebastian Sasturain SEBARDO <dsastu@gmail.com>
 */
class BasePubsAdminActions extends autoPubsAdminActions {

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
        $this->redirect('@pubsAdmin');
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('Comment');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function setPage($page) {
        $this->getUser()->setAttribute('pubsAdmin.page', $page, 'admin_module');
    }

    protected function getPage() {
        return $this->getUser()->getAttribute('pubsAdmin.page', 1, 'admin_module');
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
        if (null !== $sort = $this->getUser()->getAttribute('pubsAdmin.sort', null, 'admin_module')) {
            return $sort;
        }

        $this->setSort($this->configuration->getDefaultSort());

        return $this->getUser()->getAttribute('pubsAdmin.sort', null, 'admin_module');
    }

    protected function setSort(array $sort) {
        if (null !== $sort[0] && null === $sort[1]) {
            $sort[1] = 'asc';
        }

        $this->getUser()->setAttribute('pubsAdmin.sort', $sort, 'admin_module');
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Pubs')->hasColumn($column);
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $this->changeToDelete($request, true);
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@pubsAdmin');
    }

}

?>
