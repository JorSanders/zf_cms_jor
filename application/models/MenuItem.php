<?php
/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */


require_once 'Zend/Db/Table/Abstract.php';

/**
 * menu item model.
 *
 * @by Jor Sanders
 */
class Model_MenuItem extends Zend_Db_Table_Abstract
{

    protected $_name = 'menu_items';
    protected $_referenceMap = array(
        'Menu' => array(
            'columns' => array('menu_id'),
            'refTableClass' => 'Model_Menu',
            'refColumns' => array('id'),
            'onDelete' => self::CASCADE,
            'onUpdate' => self::RESTRICT
        )
    );

    /**
     * get items of a menu.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function getItemsByMenu($menuId)
    {
        $select = $this->select();
        $select->where("menu_id = ?", $menuId);
        $select->order("position");
        $items = $this->fetchAll($select);
        if ($items->count() > 0) {
            return $items;
        } else {
            return null;
        }
    }

    /**
     * add.
     *
     * @return    id.
     *
     * @by      Jor Sanders
     */
    public function addItem($menuId, $label, $pageId = 0, $link = null)
    {
        $row = $this->createRow();
        $row->menu_id = $menuId;
        $row->label = $label;
        $row->page_id = $pageId;
        $row->link = $link;
        // note that you wil create the _getLastPosition method in listing 7-36
        $row->position = $this->_getLastPosition($menuId) + 1;
        return $row->save();
    }

    /**
     * get the privious position.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    private function _getLastPosition($menuId)
    {
        $select = $this->select();
        $select->where("menu_id = ?", $menuId);
        $select->order('position DESC');
        $row = $this->fetchRow($select);
        if ($row) {
            return $row->position;
        } else {
            return 0;
        }
    }

    //TODO give me less aids with these two move functions

    /**
     * move up.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function moveUp($itemId)
    {
        $row = $this->find($itemId)->current();
        if ($row) {
            $position = $row->position;
            if ($position < 1) {
                // this is already the first item
                return FALSE;
            } else {
                //find the previous item
                $select = $this->select();
                $select->order('position DESC');
                $select->where("position < ?", $position);
                $select->where("menu_id = ?", $row->menu_id);
                $previousItem = $this->fetchRow($select);
                if ($previousItem) {
                    //switch positions with the previous item
                    $previousPosition = $previousItem->position;
                    $previousItem->position = $position;
                    $previousItem->save();
                    $row->position = $previousPosition;
                    $row->save();
                }
            }
        } else {
            throw new Zend_Exception("Error loading menu item");
        }
    }

    /**
     * move down.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function moveDown($itemId)
    {
        $row = $this->find($itemId)->current();
        if ($row) {
            $position = $row->position;
            if ($position == $this->_getLastPosition($row->menu_id)) {
                // this is already the last item
                return FALSE;
            } else {
                //find the next item
                $select = $this->select();
                $select->order('position ASC');
                $select->where("position > ?", $position);
                $select->where("menu_id = ?", $row->menu_id);
                $nextItem = $this->fetchRow($select);
                if ($nextItem) {
                    //switch positions with the next item
                    $nextPosition = $nextItem->position;
                    $nextItem->position = $position;
                    $nextItem->save();
                    $row->position = $nextPosition;
                    $row->save();
                }
            }
        } else {
            throw new Zend_Exception("Error loading menu item");
        }
    }

    /**
     * update.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function updateItem($itemId, $label, $pageId = 0, $link = null)
    {
        $row = $this->find($itemId)->current();
        if ($row) {
            $row->label = $label;
            $row->page_id = $pageId;
            if ($pageId < 1) {
                $row->link = $link;
            } else {
                $row->link = null;
            }
            return $row->save();
        } else {
            throw new Zend_Exception("Error loading menu item");
        }
    }

    /**
     * delete.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function deleteItem($itemId)
    {
        $row = $this->find($itemId)->current();
        if ($row) {
            return $row->delete();
        } else {
            throw new Zend_Exception("Error loading menu item");
        }
    }

}
