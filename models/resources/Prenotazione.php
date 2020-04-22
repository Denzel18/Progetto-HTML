<?php

class Application_Resource_Prenotazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Prenotazione';
    protected $_primary  = 'IDPrenotazione';
    protected $_rowClass = 'Application_Resource_Prenotazione_Item';
    
    public function init()
    {
    }
    
    public function insertBooking($info){
    	$this->insert($info);
    }
    
    public function getBookingById($id){
        return $this->find($id)->current();
    }
    
    public function deleteBookingById($idBooking){
        $delete =  $this->delete(array('IDPrenotazione = ?' => $idBooking));
        return $this->fetchAll($delete);
    }
    
    public function getBooking($IdUser){
        $select = $this->select()->where('IDUtente = ?',$IdUser);
        return $this->fetchAll($select);
    }
    public function getBooking2($IdUser) {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from(array('Prenotazione' => 'Prenotazione'))
                ->join(array('Auto' => 'Auto'), 'Prenotazione.IDMezzo = Auto.IDMezzo')
                ->where('IDUtente = ?', $IdUser);
        return $this->fetchAll($select);
    }

    public function editBooking($info, $id) {
        $this->update($info, (array('IDPrenotazione = ' . $id)));
    }
    public function getNBoooking($mese){
       $select =  $this->select()
               ->from("Prenotazione", array("num"=>"COUNT(*)"))
                ->where("DataPrenotazione between '2019-".$mese."-01' AND '2019-".$mese."-31'");
       $result = $this->fetchAll($select);
       
       foreach($result as $row){
            $id = $row['num'];
        }
        return $id;
    }
    public function getNBoookingByMonth($mese){
       $select =  $this->select()
               ->from("Prenotazione")
                ->where("DataPrenotazione between '2019-".$mese."-01' AND '2019-".$mese."-31'");
       $result = $this->fetchAll($select);
       return $result;
    }
    
}