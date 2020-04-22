<?php

class Application_Form_Admin_Client_Delete extends App_Form_Abstract {
    
    protected $_dateValidator;
    protected $_userValidator;
    


    public function init() {


        $this->setMethod('post');
        $this->setName('adduser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //Elimina
        $this->addElement('Checkbox', 'Elimina', array(
            'label' => 'Eliminami',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 20))),
            'decorators' => $this->filterDecorators,
        ));
        
        //Invio
        $this->addElement('submit', 'add', array(
            'label' => 'Inserisci cliente',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form'
        ));
    }
}