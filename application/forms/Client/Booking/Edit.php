<?php

class Application_Form_Client_Booking_Edit extends App_Form_Abstract {

    protected $_clientModel;
    protected $_dataValidator;
    protected $_IntValidator;
    
    
    

    public function init() {
        
        $this->_dataValidator = new Zend_Validate_Date ('yyyy-MM-dd');
        $this->_IntValidator = new Zend_Validate_Int ();
        $this->_clientModel = new Application_Model_Client();
        $this->setMethod('post');
        $this->setName('addbooking');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        
        $this->addElement('text', 'IDMezzo', array(
            'label' => 'ID Automobile',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly' => 'readonly',
            'validators' => array('Int Format'=>$this->_IntValidator),
            'decorators' => $this->bookingDecorators,
        ));
         
        $this->addElement('text', 'IDUtente', array(
            'label' => 'ID Utente',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly' => 'readonly',
            'validators' => array('Int Format'=>$this->_IntValidator),
            'decorators' => $this->bookingDecorators
        ));


      $this->addElement('text', 'DataInizio', array(
            'label' => 'Ritiro',
            'readonly' => 'readonly',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Date Format'=>$this->_dataValidator),
            'decorators' => $this->elementDecorators,
        ));

   
        $this->addElement('text', 'DataFine', array(
            'label' => 'Consegna',
            'filters' => array('StringTrim'),
            'required' => true,
            'value' => '',
            'validators' => array('Date Format'=>$this->_dataValidator),
            'decorators' => $this->elementDecorators,
        ));

        
        $this->addElement('text', 'DataPrenotazione', array(
            'label' => 'Data Prenotazione',
            'readonly' => 'readonly',
            'filters' => array('StringTrim'),
            'required' => true,
            'value' => '',
            'validators' => array('Date Format'=>$this->_dataValidator),
            'decorators' => $this->elementDecorators,
        ));



        //Invio
        $this->addElement('submit', 'add', array(
            'label' => 'Modifica prenotazione',
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
