<?php

class Application_Resource_Messaggio extends Zend_Db_Table_Abstract {

    protected $_name = 'Messaggio';
    protected $_primary = 'IDMessaggio';
    protected $_rowClass = 'Application_Resource_Messaggio_Item';

    public function init() {
        
    }
    public function getMessageRead() {
        $select = $this->select()->where('Visualizzato = 0');
        return $this->fetchAll($select);
    }
    public function getMessageNoRead() {
        $select = $this->select()->where('Visualizzato = 1');
        return $this->fetchAll($select);
    }
    public function getMessageById($id){
        return $this->find($id)->current();
    }
    public function setMessageResponse($msg){
        $this->insert($msg);
    }
    public function setMessagebyIdRead($id){
        $info = array('Visualizzato' => 0);
        $this->update($info, (array('IDMessaggio = ' . $id)));
    }
    public function getMessageByUserId($id){
        $select = $this->select()->where('IDMittente = '.$id.' || '.'IDDestinatario = '.$id)->order('IDMessaggio');
        return $this->fetchAll($select);
    }
    public function invio ($values){
        $this->insert($values);
    }
}
