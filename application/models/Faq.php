<?php

class Application_Model_Faq extends App_Model_Abstract{ 

	protected $_Faqs; 

	public function __construct(){
		$this->_logger = Zend_Registry::get('log');  	
	}

        	public function getFaqs(){
            return $this->getResource('Faq')->getFaqs();
	}
        
        public function getFaqById($Id){
            return $this->getResource('Faq')->getFaqById($Id);
        }
        
}

