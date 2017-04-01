<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * bug model.
 *
 * @by Jor Sanders
 */
class Model_Bug extends Zend_Db_Table_Abstract
{

    protected $_name = 'bugs';

    /**
     * create.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function createBug($name, $email, $date, $url, $description, $priority, $status)
    {
        // create a new row in the bugs table
        $row = $this->createRow();
        // set the row data
        $row->author = $name;
        $row->email = $email;
        $dateObject = new Zend_Date($date);
        $row->date = $dateObject->get(Zend_Date::TIMESTAMP);
        $row->url = $url;
        $row->description = $description;
        $row->priority = $priority;
        $row->status = $status;
        // save the new row
        $id = $row->save();
        return $id;
    }

    /**
     * get paginator.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function fetchPaginatorAdapter($filters = array(), $sortField = null)
    {
        $select = $this->select();
        // add any filters which are set
        if (count($filters) > 0) {
            foreach ($filters as $field => $filter) {
                $select->where($field . ' = ?', $filter);
            }
        }
        // add the sort field is it is set
        if (null != $sortField) {
            $select->order($sortField);
        }
        // create a new instance of the paginator adapter and return it
        $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
        return $adapter;
    }

    /**
     * update.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function updateBug($id, $name, $email, $date, $url, $description, $priority, $status)
    {
        // find the row that matches the id
        $row = $this->find($id)->current();
        if ($row) {
            // set the row data
            $row->author = $name;
            $row->email = $email;
            $d = new Zend_Date($date);
            $row->date = $d->get(Zend_Date::TIMESTAMP);
            $row->url = $url;
            $row->description = $description;
            $row->priority = $priority;
            $row->status = $status;
            // save the updated row
            $row->save();
            return true;
        } else {
            throw new Zend_Exception("Update function failed; could not find row!");
        }
    }

    public function deleteBug($id)
    {
// find the row that matches the id
        $row = $this->find($id)->current();
        if ($row) {
            $row->delete();
            return true;
        } else {
            throw new Zend_Exception("Delete function failed; could not find row!");
        }
    }

}

?>