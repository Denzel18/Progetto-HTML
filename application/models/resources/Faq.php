<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Faq';
    protected $_primary  = 'IDFaq';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init()
    {
    }
     
    // Estrae i dati della categoria $id
    public function getFaqById($id){
        return $this->find($id)->current();
    }
    // Estrae tutte le categorie Top
    public function getFaqs(){
        $select = $this->select()->order('IDFaq');
        return $this->fetchAll($select);
    }
    
    //non ho la certezza che si faccia così, ho solo visto in giro che si fa così
    public function deleteFaqById($idFaq){
        $id = $idFaq;
        $delete =  $this->delete(array('IDFaq = ?' => $id));
        return $this->fetchAll($delete);
    }
    public function insertFaq($info){
        $this->insert($info);
    }
    public function editFaq($info,$idFaq){
       $id = $idFaq;
       $this->update($info,(array('IDFaq = '.$id)));
    }
}
