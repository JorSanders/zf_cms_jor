<?php
/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * bug controller.
 *
 * @by Jor Sanders
 */
class BugController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    /**
     * check if the form submit if valid and redirect the user
     *
     * @return  void  .
     *
     * @by      Jor Sanders
     */
    public function submitAction()
    {
        // action body
        $frmBugReport = new Form_BugReport();
        $frmBugReport->setAction('/bug/submit');
        $frmBugReport->setMethod('post');
        //check for the submitted data
        if ($this->getRequest()->isPost()) {
            //check if valid
            if ($frmBugReport->isValid($_POST)) {
                // if the form is valid then create the new bug
                $bugModel = new Model_Bug();
                $result = $bugModel->createBug(
                    $frmBugReport->getValue('author'), $frmBugReport->getValue('email'), $frmBugReport->getValue('date'), $frmBugReport->getValue('url'), $frmBugReport->getValue('description'), $frmBugReport->getValue('priority'), $frmBugReport->getValue('status')
                );
                // if the createBug method returns a result
                // then the bug was successfully created
                if ($result) {
                    $this->redirect('bug/confirm');
                }
            }
        }
        $this->view->form = $frmBugReport;
    }

    public function confirmAction()
    {
        // action body
    }

    /**
     * apply the filters set by the user.
     *
     * @return  void  .
     *
     * @by      Jor Sanders
     */
    public function listAction()
    {
        // get the filter tools
        $listTools = new Form_BugReportListTools();
        $listTools->setAction('/bug/list');
        $listTools->setMethod('post');
        $this->view->listTools = $listTools;
        // set the sort and filter criteria. you need to update this to use the request,
        // as these values can come in from the form post or a url parameter
        $sort = $this->_request->getParam('sort', null);
        $filterField = $this->_request->getParam('filter_field', null);
        $filterValue = $this->_request->getParam('filter');
        if (!empty($filterField)) {
            $filter[$filterField] = $filterValue;
        } else {
            $filter = null;
        }
        // now you need to manually set these controls values
        $listTools->getElement('sort')->setValue($sort);
        $listTools->getElement('filter_field')->setValue($filterField);
        $listTools->getElement('filter')->setValue($filterValue);
        // fetch the bug paginator adapter
        $bugModels = new Model_Bug();
        $adapter = $bugModels->fetchPaginatorAdapter($filter, $sort);
        $paginator = new Zend_Paginator($adapter);
        // show 10 bugs per page
        $paginator->setItemCountPerPage(10);
        // get the page number that is passed in the request.
        //if none is set then default to page 1.
        $page = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($page);
        // pass the paginator to the view to render
        $this->view->paginator = $paginator;
    }


    public function editAction()
    {
        //create a new instance
        $bugModel = new Model_Bug();
        $bugReport = new Form_BugReport();
        $bugReport->setAction('/bug/edit');
        $bugReport->setMethod('post');
        if ($this->getRequest()->isPost()) {
            if ($bugReport->isValid($_POST)) {
                $bugModel = new Model_Bug();
                // if the form is valid then update the bug
                $result = $bugModel->updateBug($bugReport->getValue('id'), $bugReport->getValue('author'), $bugReport->getValue('email'), $bugReport->getValue('date'), $bugReport->getValue('url'), $bugReport->getValue('description'), $bugReport->getValue('priority'), $bugReport->getValue('status'));
                //TODO set to redirect based on result
                return $this->redirect('bug/list');
            }
        } else {
            $id = $this->_request->getParam('id');
            $bug = $bugModel->find($id)->current();
            $bugReport->populate($bug->toArray());
            //format the date field
            $bugReport->getElement('date')->setValue(date('m-d-Y', $bug->date));
        }
        $this->view->form = $bugReport;
    }

    /**
     * deletes a bug.
     *
     * @return  void  .
     *
     * @by      Jor Sanders
     */
    public function deleteAction()
    {
        $bugModel = new Model_Bug();
        $id = $this->_request->getParam('id');
        $bugModel->deleteBug($id);
        return $this->redirect('bug/list');
    }

}
