<?php

/*
 * Implementa il patern singleton, 
 * come funziona ? chi la invoca usa il parametro name di un model resource, se c'è lo restituisce altrimenti lo crea 
 * 
 * ci permette di creare una singola istanza di ogni Category 
 */

abstract class App_Model_Abstract
{	
	protected $_resources = array();
	
	public function getResource($name) 
	{
		if (!isset($this->_resources[$name])) {
                    $class = implode('_', array(
                    $this->_getNamespace(),
                    'Resource',
                    $name));                    
                    $this->_resources[$name] = new $class();  //meccanismo di autoloader, stesso meccanismo che usiamo quando definiamo un controller
                }
	    return $this->_resources[$name];
	}

	private function _getNamespace()
        {
            $ns = explode('_', get_class($this));
            return $ns[0];
        }

}


/*
 * Come si fa ad istruire zend ad avere altre route, basta modificare il file bootstrap 
 */