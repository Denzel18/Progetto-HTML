<?php

class Application_Resource_User extends Zend_Db_Table_Abstract {

    protected $_name = 'Utente';
    protected $_primary = 'IDUtente';
    protected $_rowClass = 'Application_Resource_User_Item';

    public function init() {
        
    }

    //____________USER _________
    public function getUserByName($usrName) {
        return $this->fetchRow($this->select()->where('Username = ?', $usrName));
    }
    public function getUserById($id) {
        return $this->find($id)->current();
    }
    public function editProfile($info,$id){
        $this->update($info, (array('IDUtente = ' . $id)));
    }

    //___________STAFF_________________
    public function getStaff() {
        $campo = 'staff';
        $select = $this->select()->where('Role = ?', $campo);
        return $this->fetchAll($select);
    }
    public function deleteStaffById($idStaff) {
        $id = $idStaff;
        $delete = $this->delete(array('IDUtente = ?' => $id));
        return $this->fetchAll($delete);
    }

    public function insertStaff($info) {
        $this->insert($info);
    }

    public function getStaffById($id) {
        return $this->find($id)->current();
    }

    public function editStaff($info, $id) {
        $this->update($info, (array('IDUtente = ' . $id)));
    }

    //___________CLIENT_________________
    public function getClient() {
        $campo = 'client';
        $select = $this->select()->where('Role = ?', $campo);
        return $this->fetchAll($select);
    }

    public function insertClient($info) {
        $this->insert($info);
    }

    public function deleteClientById($idClient) {
        $id = $idClient;
        $delete = $this->delete(array('IDUtente = ?' => $id));
        return $this->fetchAll($delete);
    }

    public function getClientById($id) {
        return $this->find($id)->current();
    }

    public function editClient($info, $id) {
        $this->update($info, (array('IDUtente = ' . $id)));
    }

}
