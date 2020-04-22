<?php

class Application_Model_Public extends App_Model_Abstract {
    protected $_logger; 
    public function __construct() {
        $this->_logger = $this->_logger = Zend_Registry::get('log');
    }

    public function getCars($paged = null) {
        return $this->getResource('Auto')->getCars($paged);
    }

    public function getCarsByFilter($paged = null, $prezzoMin = null , $prezzoMax = null, $posti = null){
        $this->_logger->info("L'utente sta ricercando un'auto filtrando il risultato" . __METHOD__);
        return $this->getResource('Auto')->getCarsByFilter($paged, $prezzoMin, $prezzoMax , $posti, null, null,null);
    }

    public function getCarById($Id) {
        return $this->getResource('Auto')->getCarById($Id);
    }

    public function getFaqs() {
        return $this->getResource('Faq')->getFaqs();
    }

    public function getMarche() {
        return $this->getResource('Auto')->getMarche();
    }

    public function saveClient($info) {
        return $this->getResource('User')->insertClient($info);
    }
    public function getUserByName($usrName){
        return $this->getResource('User')->getUserByName($usrName);
    }

}
