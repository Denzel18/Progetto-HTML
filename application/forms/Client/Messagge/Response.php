<?php

class Application_Form_Client_Messagge_Response extends App_Form_Abstract {

    protected $_adminModel;
    protected $_validatorDate; 
    protected $_IntValidator; 
    public function init() {
        $data = date('Y-m-d');
        $this->_IntValidator = new Zend_Validate_Int ();
        $this->setMethod('post');
        $this->setName('responseMessagge');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');


        $this->addElement('text', 'Data', array(
            'label' => 'Data',
            'filters' => array('StringTrim'),
            'required' => true,
            'value' => $data, 
            'readonly' => 'readonly',
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('text', 'IDDestinatario', array(
            'label' => 'ID Destinatario',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly'=>'readonly',
            'validators' => array('Date Format' => $this->_IntValidator),
            'decorators' => $this->bookingDecorators,
        ));

        $this->addElement('text', 'IDMittente', array(
            'label' => 'ID Mittente',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly'=>'readonly',
            'validators' => array('Date Format' => $this->_IntValidator),
            'decorators' => $this->bookingDecorators,
        ));
        
        $this->addElement('text', 'Visualizzato', array(
            'label' => 'Visualizzato',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly'=>'readonly',
            'validators' => array('Date Format' => $this->_IntValidator),
            'decorators' => $this->bookingDecorators,
        ));
        
        $this->addElement('textarea', 'Messaggio', array(
            'label' => 'Risposta',
            'filters' => array('StringTrim'),
            'required' => true,
            'rows' => '5',
            'cols' => '50',
            'validators' => array(array('StringLength', true, array(1, 500))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('submit', 'add', array(
            'label' => 'Rispondi',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

}
