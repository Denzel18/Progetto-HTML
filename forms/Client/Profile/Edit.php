<?php
class Application_Form_Client_Profile_Edit extends App_Form_Abstract{
   
    protected $_dateValidator; 
    protected $_userValidator;

    public function init() {
        $this->_dateValidator = new Zend_Validate_Date ('yyyy-MM-dd');
        $this->_userValidator = new Zend_Validate_Db_NoRecordExists('Utente','Username');

        $this->setMethod('post');
        $this->setName('adduser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        //Nome
        $this->addElement('text', 'Nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 20))),
            'decorators' => $this->elementDecorators,
        ));
        //Cognome 
        $this->addElement('text', 'Cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 20))),
            'decorators' => $this->elementDecorators,
        ));
        //Username 
        $this->addElement('text', 'Username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly' => 'readonly',
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->elementDecorators,
        ));
        //Password
        $this->addElement('password', 'Password', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 15))
            ),
            'required' => true,
            'label' => 'Password',
            'decorators' => $this->elementDecorators,
        ));


        //Codice Patente
        $this->addElement('text', 'CodicePatente', array(
            'label' => 'Codice Patente',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(10, 10))),
            'decorators' => $this->elementDecorators,
        ));

        //Luogo di residenza
        $this->addElement('text', 'LuogoResidenza', array(
            'label' => 'Luogo di Residenza',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 20))),
            'decorators' => $this->elementDecorators,
        ));
        
        //Data di Nascita
        $this->addElement('text', 'DataNascita', array(
            'label' => 'Data di Nascita',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Date Format'=>$this->_dateValidator),
            'decorators' => $this->elementDecorators,
        ));
        
        $mestieri = array (
            'Studente'=>'Studente',
            'Libero Professionista' =>'Libero Professionista',
            'Agronomo' => 'Agronomo',
            'Segretaria' => 'Segretaria',
            'Artigiano' => 'Artigiano',
            'Impiegato' => 'Impiegato',
            'Disoccupato' => 'Disoccupato',
            'Altro' => 'Altro');
        //Occupazione   
        $this->addElement('select', 'Occupazione', array(
            'label' => 'Occupazione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(3, 25))),
            'multiOptions' => $mestieri,
            'decorators' => $this->elementDecorators,
        ));
        
        
        //Ruolo
        $this->addElement('text', 'Role', array(
            'label' => 'Ruolo',
            'filters' => array('StringTrim'),
            'required' => true,
            'value' => 'client',
            'readonly' => 'readonly',
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->bookingDecorators,
        ));

        //Invio
        $this->addElement('submit', 'add', array(
            'label' => 'Modifica Profilo',
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
