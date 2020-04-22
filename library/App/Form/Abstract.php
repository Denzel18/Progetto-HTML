<?php

class App_Form_Abstract extends Zend_Form {

    public $elementDecorators = array(
        'ViewHelper', // è quello che genera gli attributi, HtmlTag è un wrapper che mi permette di usare poi il tag td subito dopo 
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')), //openOnly => true, mi permette di creare <td>, quindi solo apertura 
        array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors', 'openOnly' => true, 'placement' => 'append')),
        'Errors',
        array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr')),
    );
    
    
    public $filterDecorators = array(
        'ViewHelper', 
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')), 
        array('Label', array('tag' => 'td')),
    );
    public $filterbuttonDecorators = array(
        'ViewHelper', 
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')), 
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'button_login')),
        array(array('alias2' => 'HtmlTag'), array('tag' => 'tr')),
    );
    public $fileDecorators = array(
        'File',
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'file')),
        array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors', 'openOnly' => true, 'placement' => 'append')),
        'Errors',
        array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr')),
    );

    public $bookingDecorators = array(
        'ViewHelper', // è quello che genera gli attributi, HtmlTag è un wrapper che mi permette di usare poi il tag td subito dopo 
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')), //openOnly => true, mi permette di creare <td>, quindi solo apertura 
        array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors', 'openOnly' => true, 'placement' => 'append')),
        'Errors',
        array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr', 'hidden' => 'hidden')),
    );

}
