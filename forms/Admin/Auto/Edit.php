<?php

class Application_Form_Admin_Auto_Edit extends App_Form_Abstract {

    protected $_adminModel;
    protected $_IntValidator;
    protected $_FloatValidator;


    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->_IntValidator = new Zend_Validate_Int ();
        $this->_FloatValidator = new Zend_Validate_Float (array('locale' => 'en_US'));
        $this->setMethod('post');
        $this->setName('addauto'); //DA CAMBIARE
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');


        $this->addElement('text', 'Targa', array(
            'label' => 'Targa',
            'filters' => array('StringTrim'),
            'required' => true,
            'readonly' => 'readonly',
            'validators' => array(array('StringLength', true, array(7,7))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Colore', array(
            'label' => 'Colore',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Marca', array(
            'label' => 'Marca',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'Modello', array(
            'label' => 'Modello',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Alimentazione', array(
            'label' => 'Alimentazione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 10))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'NPosti', array(
            'label' => 'N Posti',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int Format'=>$this->_IntValidator),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Cilindrata', array(
            'label' => 'Cilindrata',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int Format'=>$this->_IntValidator),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('select', 'Under25', array(
            'label' => 'Under25',
            'multiOptions' => array('1' => 'Si', '0' => 'No'),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Prezzo', array(
            'label' => 'Prezzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Float Format'=>$this->_FloatValidator),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('File', 'Image', array(
            'label' => 'Slider 1',
            'destination' => APPLICATION_PATH . '/../public/images',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 102400),
                array('Extension', true, array('jpg', 'gif','png'))),
                'decorators' => $this->fileDecorators,
        ));

        $this->addElement('File', 'Image2', array(
            'label' => 'Slider 2',
            'destination' => APPLICATION_PATH . '/../public/images',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 102400),
                array('Extension', true, array('jpg', 'gif','png'))),
            'decorators' => $this->fileDecorators,
        ));

        $this->addElement('File', 'Image3', array(
            'label' => 'Catalogo',
            'destination' => APPLICATION_PATH . '/../public/images',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 102400),
                array('Extension', true, array('jpg', 'gif','png'))),
            'decorators' => $this->fileDecorators,
        ));

        $this->addElement('submit', 'add', array(
            'label' => 'Modifica Auto',
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
