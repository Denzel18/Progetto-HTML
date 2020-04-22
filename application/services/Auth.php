<?php

class Application_Service_Auth
{
    protected $_publicModel;
    protected $_auth;

    //istanzia solo il modello perchè per autentica ho bisogno del db 
    public function __construct()
    {
        $this->_publicModel = new Application_Model_Public();
    }
    
    public function authenticate($credentials)
    {
        //definisco l'adapter, la nostra funzione che comunica con il db 
        $adapter = $this->getAuthAdapter($credentials);
        $auth    = $this->getAuth();
        $result  = $auth->authenticate($adapter);

        if (!$result->isValid()) {
            return false;
        }
        $user = $this->_publicModel->getUserByName($credentials['Username']);
        $auth->getStorage()->write($user);
        return true;
    }
    
    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }
   
    public function getIdentity()
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity()) {
            return $auth->getIdentity();
        }
        return false;
    }
    
    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }
    
    private function getAuthAdapter($values)
    {
        //gli passo 4 parametri : il PDO , il nome della tabella, (USERNAME, PASSWORD )sono usati per il match 
        //Zend_Db_Table_Abstract::getDefaultAdapter() istruzione per prendere il PDO  è un metodo statico, 
        //quindi non uso l'oggeto ma direttamente la classe 
	$authAdapter = new Zend_Auth_Adapter_DbTable(
		Zend_Db_Table_Abstract::getDefaultAdapter(),'Utente','Username','Password'
	);
        
        //cosa associare alla identita e cosa associare alla colonna password 
	$authAdapter->setIdentity($values['Username']);
	$authAdapter->setCredential($values['Password']);
        
        return $authAdapter;
    }
}
