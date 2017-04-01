<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * content node model.
 *
 * @by Jor Sanders
 */
class Model_ContentNode extends Zend_Db_Table_Abstract
{

    /**
     * The default table name
     */
    protected $_name = 'content_nodes';

    protected $_referenceMap = array(
        'Page' => array(
            'columns' => array('page_id'),
            'refTableClass' => 'Model_Page',
            'refColumns' => array('id'),
            'onDelete' => self::CASCADE,
            'onUpdate' => self::RESTRICT
        )
    );

    /**
     * set node.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function setNode($pageId, $node, $value)
    {
        // fetch the row if it exists
        $select = $this->select();
        $select->where("page_id = ?", $pageId);
        $select->where("node = ?", $node);
        $row = $this->fetchRow($select);
        //if it does not then create it
        if (!$row) {
            $row = $this->createRow();
            $row->page_id = $pageId;
            $row->node = $node;
        }
        //set the content
        $row->content = $value;
        $row->save();
    }

}

?>