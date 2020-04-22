<?php

class Application_Form_Admin_Faq_Add extends App_Form_Abstract {

    public function init() {
        $this->setMethod('post');
        $this->setName('addfaq');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        //Domanda
        $this->addElement('textarea', 'Domanda', array(
            'label' => 'Domanda',
            'cols' => '50',
            'rows' => '10',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 2500))),
            'decorators' => $this->elementDecorators,
        ));
        //Risposta
        $this->addElement('textarea', 'Risposta', array(
            'label' => 'Risposta',
            'cols' => '50',
            'rows' => '10',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 2500))),
            'decorators' => $this->elementDecorators,
        ));
        //Invio
        $this->addElement('submit', 'add', array(
            'label' => 'Inserisci FAQ',
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
