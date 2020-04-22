<?php

class Application_Model_Client extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

   
    public function getCars($paged = null) {
        return $this->getResource('Auto')->getCars($paged);
    }
    public function getCarsBook() {
        return $this->getResource('Auto')->getCarsBooked();
    }
    public function getCarsByFilter($paged = null, $prezzoMin = null , $prezzoMax = null, $posti = null, $dataInizio = null,$dataFine = null ){
        return $this->getResource('Auto')->getCarsByFilter($paged, $prezzoMin, $prezzoMax , $posti, $dataInizio , $dataFine);
    }

    public function getCarById($Id) {

        return $this->getResource('Auto')->getCarById($Id);
    }

    public function getFaqs() {

        return $this->getResource('Faq')->getFaqs();
    }

    public function saveBooking($info) {
        return $this->getResource('Prenotazione')->insertBooking($info);
    }

    public function deleteBookingById($Id) {
        return $this->getResource('Prenotazione')->deleteBookingById($Id);
    }

    public function getBookingById($id) {
        return $this->getResource('Prenotazione')->getBookingById($id);
    }

    public function getBooking($info) {
        return $this->getResource('Prenotazione')->getBooking($info);
    }
    public function getBooking2($info) {
        return $this->getResource('Prenotazione')->getBooking2($info);
    }

    public function editBooking($info, $id) {
        return $this->getResource('Prenotazione')->editBooking($info, $id);
    }

    public function editProfile($info, $idClient) {
        return $this->getResource('User')->editProfile($info, $idClient);
    }

//__________MSG________________
    public function getMessageRead() {
        return $this->getResource('Messaggio')->getMessageRead();
    }

    public function getMessageNoRead() {
        return $this->getResource('Messaggio')->getMessageNoRead();
    }

    public function getMessageById($id) {
        return $this->getResource('Messaggio')->getMessageById($id);
    }

    public function getUserById($idClient) {
        return $this->getResource('User')->getUserById($idClient);
    }
    public function getMessageByUserId($id){
        return $this->getResource('Messaggio')->getMessageByUserId($id);
    }
    public function invio($values){
        return $this->getResource('Messaggio')->invio($values);
    }
    

}
