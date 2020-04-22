<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

    public function __construct(){
        $this->_logger = Zend_Registry::get('log');
    }
    
    //___________USER________________
    public function getUserByName($usrName){
        return $this->getResource('User')->getUserByName($usrName);
    }
    public function getUserById($id){
        return $this->getResource('User')->getUserById($id);
    }
    public function editProfile($info,$id){
        return $this->getResource('User')->editProfile($info,$id);
    }
    
    //__________STAFF_____________
    public function getStaffs(){
        return $this->getResource('User')->getStaff();
    }
    public function deleteStaffById($Id){
        return $this->getResource('User')->deleteStaffById($Id);
    }
    public function saveStaff($info){
    	return $this->getResource('User')->insertStaff($info);
    }
    public function editStaff($info,$id){
        return $this->getResource('User')->editStaff($info,$id);
    }
    public function getStaffById($Id){
        return $this->getResource('User')->getStaffById($Id);
    }
    
    //__________CLIENTS_____________
    
    public function getClients(){
        return $this->getResource('User')->getClient();
    }
    public function deleteClientById($Id){
        return $this->getResource('User')->deleteClientById($Id);
    }
    public function saveClient($info){
       return $this->getResource('User')->insertClient($info); 
    }
    public function editClient($info,$id){
        return $this->getResource('User')->editClient($info,$id);
    }
    public function getClientById($Id){
        return $this->getResource('User')->getClientById($Id);
    }
    //__________AUTO-CAR_____________
    public function getCars(){
	return $this->getResource('Auto')->getCars();
    }
    public function deleteCarById($Id){
        return $this->getResource('Auto')->deleteCarById($Id);
    }
    public function saveAuto($info){
        return $this-> getResource('Auto')->insertCar($info);
    }
    public function getCarById($Id) {
        return $this->getResource('Auto')->getCarById($Id);
    }
    public function editCar($info, $id) {
        return $this->getResource('Auto')->editCar($info, $id);
    }
    
    //__________FAQ_____________
    public function getFaqs(){
	return $this->getResource('Faq')->getFaqs();
    }
    public function deleteFaqById($Id){
        return $this->getResource('Faq')->deleteFaqById($Id);
    }
    public function saveFaq($info){
        return $this->getResource('Faq')->insertFaq($info);
    }
    public function editFaq($info,$idFaq){
        return $this->getResource('Faq')->editFaq($info,$idFaq);
    }
    public function getFaqById($Id){
        return $this->getResource('Faq')->getFaqById($Id);
    }
    
    //__________MSG________________
    public function getMessageRead(){
        return $this->getResource('Messaggio')->getMessageRead();
        
    }
    public function getMessageNoRead(){
        return $this->getResource('Messaggio')->getMessageNoRead();  
    }
    public function getMessageById($id){
        return $this->getResource('Messaggio')->getMessageById($id);
    }
    public function setMessageResponse($msg){
        return $this->getResource('Messaggio')->setMessageResponse($msg);
    }
    public function setMessagebyIdRead($id){
        return $this->getResource('Messaggio')->setMessagebyIdRead($id);
    }
    
    //______________STATISTICA______________________
    public function getNBoooking($mese){
        return $this->getResource('Prenotazione')->getNBoooking($mese);
    }
}