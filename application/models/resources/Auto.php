<?php

class Application_Resource_Auto extends Zend_Db_Table_Abstract {

    protected $_name = 'Auto';
    protected $_primary = 'IDMezzo';
    protected $_rowClass = 'Application_Resource_Auto_Item';

    public function init() {
        
    }

    public function getCarById($id) {
        return $this->find($id)->current();
    }

    public function deleteCarById($id) {
        $delete = $this->delete(array('IDMezzo = ?' => $id));
        return $this->fetchAll($delete);
    }

    public function insertCar($info) {
        $this->insert($info);
    }

    public function getMarche() {
        $select = $this->select();
        return $this->fetchAll($select);
    }

    public function editCar($info, $id) {
        $this->update($info, (array('IDMezzo = ' . $id)));
    }
    
    public function getCars($paged = null) {

        $select = $this->select()->order('Prezzo');
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(4)
                    ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }
    
    private function getIDCarBookedBeetween($dataInizio , $dataFine){
        $ids = '';

        $select = $this->select();
        $select->setIntegrityCheck(false);
        
        $select
                ->from(array('Auto' => 'Auto'))
                ->columns(array('ID'=> 'Auto.IDMezzo'))
                ->join(array('Prenotazione' => 'Prenotazione'), 'Prenotazione.IDMezzo = Auto.IDMezzo')
               ->where('Prenotazione.DataInizio > '."'".$dataInizio ."'".' AND Prenotazione.DataFine < '."'".$dataFine . "'");

        $rows = $this->fetchAll($select);
        foreach($rows as $row){
            $ids = $ids.$row['ID'].",";
        }
       return $ids;  
    }
    
    public function getCarsByFilter($paged = null, $prezzoMin = null , $prezzoMax = null,  $posti = null , $dataInizio = null , $dataFine = null) {
        $prezzo = null; 
        $data = null; 
        if ($prezzoMin !== null && $prezzoMax !== null) {
            $prezzo = 'Prezzo >=' . $prezzoMin  . ' AND Prezzo <= ' . $prezzoMax;
        }
        if($dataInizio !== null && $dataFine !== null){
            if ($this->getIDCarBookedBeetWeen($dataInizio, $dataFine) != ""){
                $data = ' AND IDMezzo NOT IN (' . $this->getIDCarBookedBeetWeen($dataInizio, $dataFine) . ')';
            }else {
                $dataFine= null;
                
            }
        }
        if($posti !== null){
            $posti = 'NPosti = '.$posti;
        }
        $where = null; 
        
        if( $posti != null){
            $where .= $posti;
        }
        
        if($dataInizio !== null && $dataFine !== null){
            if (empty($where)){
                $where .= $data;
            }else{
                $where .= ' AND ' .$data;
            }    
        }
        if($prezzoMin !== null && $prezzoMax !== null){
            if (empty($where)) {
                $where .= $prezzo;
            } else {
                $where .= ' AND ' . $prezzo;
            }
        }
        $select=$this->select();
        
        if($where !== null){
            $select = $select->where($where)->order('Prezzo');
        }
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(4)
                    ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
        
    }

}
