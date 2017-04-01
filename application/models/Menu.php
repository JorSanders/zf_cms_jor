<?php
/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */


require_once 'Zend/Db/Table/Abstract.php';

/**
 * menu model.
 *
 * @by Jor Sanders
 */
class Model_Menu extends Zend_Db_Table_Abstract
{

    protected $_name = 'menus';
    protected $_dependentTables = array('Model_MenuItem');
    protected $_referenceMap = array(
        'Menu' => array(
            'columns' => array('parent_id'),
            'refTableClass' => 'Model_Menu',
            'refColumns' => array('id'),
            'onDelete' => self::CASCADE,
            'onUpdate' => self::RESTRICT
        )
    );

    /**
     * create.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function createMenu($name)
    {
        $row = $this->createRow();
        $row->name = $name;
        return $row->save();
    }

    /**
     * get.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function getMenus()
    {
        $select = $this->select();
        $select->order('name');
        $menus = $this->fetchAll($select);
        if ($menus->count() > 0) {
            return $menus;
        } else {
            return null;
        }
    }

    /**
     * update.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function updateMenu($id, $name)
    {
        $currentMenu = $this->find($id)->current();
        if ($currentMenu) {
            $currentMenu->name = $name;
            return $currentMenu->save();
        } else {
            return false;
        }
    }

    /**
     * delete.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function deleteMenu($menuId)
    {
        $row = $this->find($menuId)->current();
        if ($row) {
            return $row->delete();
        } else {
            throw new Zend_Exception("Error loading menu");
        }
    }

}
