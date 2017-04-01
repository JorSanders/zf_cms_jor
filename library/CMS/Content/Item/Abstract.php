<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * content item abstract.
 *
 * @by Jor Sanders
 */
abstract class CMS_Content_Item_Abstract
{

    public $id;
    public $name;
    public $parent_id = 0;
    protected $_namespace = 'page';
    protected $_pageModel;

    const NO_SETTER = 'setter method does not exist';

    /**
     * load the page object.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function __construct($pageId = null)
    {
        $this->_pageModel = new Model_Page();
        if (null != $pageId) {
            $this->loadPageObject(intval($pageId));
        }
    }

    /**
     * get inner row.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    protected function _getInnerRow($id = null)
    {
        if ($id == null) {
            $id = $this->id;
        }
        return $this->_pageModel->find($id)->current();
    }

    /**
     * get properties.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    protected function _getProperties()
    {
        $propertyArray = array();
        $class = new Zend_Reflection_Class($this);
        $properties = $class->getProperties();
        foreach ($properties as $property) {
            if ($property->isPublic()) {
                $propertyArray[] = $property->getName();
            }
        }
        return $propertyArray;
    }

    /**
     * call the setter .
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    protected function _callSetterMethod($property, $data)
    {
        //create the method name
        $method = Zend_Filter::filterStatic($property, 'Word_UnderscoreToCamelCase');
        $methodName = '_set' . $method;
        if (method_exists($this, $methodName)) {
            return $this->$methodName($data);
        } else {
            return self::NO_SETTER;
        }
    }

    /**
     * load page object.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function loadPageObject($id)
    {
        $this->id = $id;
        $row = $this->_getInnerRow();
        if ($row) {
            if ($row->namespace != $this->_namespace) {
                throw new Zend_Exception('Unable to cast page type:' .
                    $row->namespace . ' to type:' . $this->_namespace);
            }
            $this->name = $row->name;
            $this->parent_id = $row->parent_id;
            $contentNode = new Model_ContentNode();
            $nodes = $row->findDependentRowset($contentNode);
            if ($nodes) {
                $properties = $this->_getProperties();
                foreach ($nodes as $node) {
                    $key = $node['node'];
                    if (in_array($key, $properties)) {
                        // try to call the setter method
                        $value = $this->_callSetterMethod($key, $nodes);
                        if ($value === self::NO_SETTER) {
                            $value = $node['content'];
                        }
                        $this->$key = $value;
                    }
                }
            }
        } else {
            throw new Zend_Exception("Unable to load content item");
        }
    }

    /**
     * get the properties as array.
     *
     * @return  array  .
     *
     * @by      Jor Sanders
     */
    public function toArray()
    {
        $properties = $this->_getProperties();
        foreach ($properties as $property) {
            $array[$property] = $this->$property;
        }
        return $array;
    }

    /**
     * save.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function save()
    {
        if (isset($this->id)) {
            $this->_update();
        } else {
            $this->_insert();
        }
    }

    /**
     * insert.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    protected function _insert()
    {
        $pageId = $this->_pageModel->createPage(
            $this->name, $this->_namespace, $this->parent_id);
        $this->id = $pageId;
        $this->_update();
    }

    /**
     * update.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    protected function _update()
    {
        $data = $this->toArray();
        $this->_pageModel->updatePage($this->id, $data);
    }

    /**
     * delete.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function delete()
    {
        if (isset($this->id)) {
            $this->_pageModel->deletePage($this->id);
        } else {
            throw new Zend_Exception('Unable to delete item; the item is empty!');
        }
    }

}
