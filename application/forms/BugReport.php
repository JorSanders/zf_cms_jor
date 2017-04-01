<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * bug form.
 *
 * @by Jor Sanders
 */
class Form_BugReport extends Zend_Form
{

    public function init()
    {
        //id
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);

        //author
        $author = $this->createElement('text', 'author');
        $author->setLabel('Vul je naam in:');
        $author->setRequired(TRUE);
        $author->setAttrib('size', 30);
        $this->addElement($author);

        //email
        $email = $this->createElement('text', 'email');
        $email->setLabel('Vul je e-mail in:');
        $email->setRequired(TRUE);
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addFilters(array(
            new Zend_Filter_StringTrim(),
            new Zend_Filter_StringToLower()
        ));
        $email->setAttrib('size', 40);
        $this->addElement($email);

        //date
        $date = $this->createElement('text', 'date');
        $date->setLabel('Bug datum gevoden::');
        $date->setRequired(TRUE);
        $date->addValidator(new Zend_Validate_Date('MM-DD-YYYY'));
        $date->setAttrib('size', 20);
        $this->addElement($date);

        //url
        $url = $this->createElement('text', 'url');
        $url->setLabel('URL naar de bug:');
        $url->setRequired(TRUE);
        $url->setAttrib('size', 50);
        $this->addElement($url);

        //description
        $description = $this->createElement('textarea', 'description');
        $description->setLabel('Bug bescrhijving:');
        $description->setRequired(TRUE);
        $description->setAttrib('cols', 50);
        $description->setAttrib('rows', 4);
        $this->addElement($description);

        //priority
        $priority = $this->createElement('select', 'priority');
        $priority->setLabel('Bug prioriteit:');
        $priority->setRequired(TRUE);
        $priority->addMultiOptions(array(
            'low' => 'Low',
            'med' => 'Medium',
            'high' => 'High',
            'CTDM' => 'Crisp to da maximum'
        ));
        $this->addElement($priority);

        //status
        $status = $this->createElement('select', 'status');
        $status->setLabel('Huidige bug status:');
        $status->setRequired(TRUE);
        $status->addMultiOption('new', 'New');
        $status->addMultiOption('in_progress', 'In Progress');
        $status->addMultiOption('resolved', 'Resolved');
        $this->addElement($status);

        //submit
        //TODO add submit the normal way
        $this->addElement('submit', 'submit', array('label' => 'Submit'));
    }

}
