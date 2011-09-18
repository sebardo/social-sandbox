<?php

require_once dirname(__FILE__) . '/audioAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/audioAdminGeneratorHelper.class.php';

/**
 * BaseAudioAdmin actions.
 *
 * @package    PubsPlugin
 * @subpackage audioAdmin
 * @author     Dario Sebastian Sasturain <dsastu@gmail.com>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseAudioAdminActions extends autoAudioAdminActions {

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
        $this->redirect('@audioAdmin');
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('Comment');
        $pager->setQuery($this->buildQuery());
        $pager->setPage($this->getPage());
        $pager->init();

        return $pager;
    }

    protected function setPage($page) {
        $this->getUser()->setAttribute('audioAdmin.page', $page, 'admin_module');
    }

    protected function getPage() {
        return $this->getUser()->getAttribute('audioAdmin.page', 1, 'admin_module');
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
        if (null !== $sort = $this->getUser()->getAttribute('audioAdmin.sort', null, 'admin_module')) {
            return $sort;
        }

        $this->setSort($this->configuration->getDefaultSort());

        return $this->getUser()->getAttribute('audioAdmin.sort', null, 'admin_module');
    }

    protected function setSort(array $sort) {
        if (null !== $sort[0] && null === $sort[1]) {
            $sort[1] = 'asc';
        }

        $this->getUser()->setAttribute('audioAdmin.sort', $sort, 'admin_module');
    }

    protected function isValidSortColumn($column) {
        return Doctrine_Core::getTable('Audio')->hasColumn($column);
    }

    protected function executeBatchDelete(sfWebRequest $request) {
        $this->changeToDelete($request, true);
        $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        $this->redirect('@audioAdmin');
    }

}

?>
