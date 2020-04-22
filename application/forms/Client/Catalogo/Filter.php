<?php

class Application_Form_Client_Catalogo_Filter extends App_Form_Abstract {

    protected $_publicModel;
    protected $_dataValidator;
    public function init() {
        $this->_dataValidator = new Zend_Validate_Date ('yyyy-MM-dd');
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('catalogo_filters');
        $this->setAction('');

        $posti = array('0'=>'----', '1'=>'1 Posto','2' => '2 Posti', '3'=>'3 Posti' , '4' => '4 Posti' , '5'=>'5 Posti' , '6'=>'6 Posti', '7' => '6+ Posti');
        $this->addElement('select', 'Posti', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(0, 25))
            ),
            'label' => 'Numero Posti',
            'multiOptions' => $posti,
            'decorators' => $this->filterDecorators,
        ));

  
        $fasciaPrezzoMin = array('-1'=>'---','0'=>'0', '50'=>'50€','100' => '100€', '150'=>'150€' );
        $fasciaPrezzoMax = array('-1'=>'---','0'=>'0', '50'=>'50€','100' => '100€', '150'=>'150€' , '200' => '200€' , '250'=>'250€' , '300'=>'300€', '400'=>'400€');
      
        $this->addElement('select', 'PrezzoMin', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(0, 25))
            ),
            'label' => 'Prezzo Min',
            'multiOptions' => $fasciaPrezzoMin,
            'decorators' => $this->filterDecorators,
        ));
        
        $this->addElement('select', 'PrezzoMax', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(0, 25))
            ),
            'label' => 'Prezzo Max',
            'multiOptions' => $fasciaPrezzoMax,
            'decorators' => $this->filterDecorators,
        ));

        $this->addElement('text', 'DataInizio', array(
            'label' => 'Data Ritiro (yyyy-MM-dd)',
            'filters' => array('StringTrim'),
            'value' => '',
            'validators' => array('Date Format'=>$this->_dataValidator),
            'decorators' => $this->filterDecorators,
        ));

   
        $this->addElement('text', 'DataFine', array(
            'label' => 'Data Consegna (yyyy-MM-dd)',
            'filters' => array('StringTrim'),
            'value' => '',
            'validators' => array('Date Format'=>$this->_dataValidator),
            'decorators' => $this->filterDecorators,
        ));
        
        $this->addElement('submit', 'Cerca', array(
            'label' => 'Cerca',
            'decorators' => $this->filterbuttonDecorators,
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class'=>'filter_table')),
            'Form'
        ));
    }
    

}
