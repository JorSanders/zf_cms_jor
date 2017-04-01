<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * bug report tools.
 *
 * @by Jor Sanders
 */
class Form_BugReportListTools extends Zend_Form
{

    /**
     * default action.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function init()
    {
        $options = array(
            '0' => 'Geen',
            'priority' => 'Prioriteit',
            'status' => 'Status',
            'date' => 'Datum',
            'url' => 'URL',
            'author' => 'Auteur'
        );
        $sort = $this->createElement('select', 'sort');
        $sort->setLabel('Records sorteren:');
        $sort->addMultiOptions($options);
        $this->addElement($sort);
        $filterField = $this->createElement('select', 'filter_field');
        $filterField->setLabel('Filter veld:');
        $filterField->addMultiOptions($options);
        $this->addElement($filterField);
        // create new element
        $filter = $this->createElement('text', 'filter');
        // element options
        $filter->setLabel('Filter Value:');
        $filter->setAttrib('size', 40);
        // add the element to the form
        $this->addElement($filter);
        // add element: submit button
        $this->addElement('submit', 'submit', array('label' => 'Filter lijst'));
    }

}

