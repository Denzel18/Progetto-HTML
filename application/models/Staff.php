<?php

class Application_Model_Staff extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    //__________AUTO-CAR_____________
    public function getCars() {
        return $this->getResource('Auto')->getCars();
    }

    public function deleteCarById($Id) {
        return $this->getResource('Auto')->deleteCarById($Id);
    }

    public function saveAuto($info) {
        return $this->getResource('Auto')->insertCar($info);
    }

    public function getCarById($Id) {
        return $this->getResource('Auto')->getCarById($Id);
    }
    public function editCar($info, $id) {
        return $this->getResource('Auto')->editCar($info, $id);
    }
    //________Profile______________-
    public function getUserById($Id) {
        return $this->getResource('User')->getUserById($Id);
    }

    public function saveStaff($info) {
        return $this->getResource('User')->insertStaff($info);
    }

    public function editProfile($info, $idStaff) {
        return $this->getResource('User')->editProfile($info, $idStaff);
    }
    
    //_______________STATISTICA_________________
    public function getNBoooking($mese){
        return $this->getResource('Prenotazione')->getNBoooking($mese);
    }
    public function getNBoookingByMonth($mese){
        return $this->getResource('Prenotazione')->getNBoookingByMonth($mese);
    }

}
