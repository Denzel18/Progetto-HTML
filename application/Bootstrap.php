<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected $_logger;
	protected $_view;

    protected function _initLogging()
    {
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/log/logFile.log');        
        $logger = new Zend_Log($writer);

        Zend_Registry::set('log', $logger);

        $this->_logger = $logger;
    	$this->_logger->info('Bootstrap ' . __METHOD__); 
        //INFO = data - ORA - TIPO MSG = INFO - priorità - nome metodo 
        //vediamo due righe perchè poi c'è la redirect alla index 
    }

    protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
    	// Necessario solo se la Document-root di Apache non è la cartella public/
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/style.css'));
        $this->_view->headTitle('Ancona Car');
        $this->_view->headScript()->appendFile($this->_view->baseUrl('/js/functions.js'),'text/javascript', array('conditional' => 'lt IE 7'));
    }
    
    
    //è il meccanismo che ci permette di creare nuove regole per l'autoloader 
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance(); //recupero il loader dalla istanza che ho avuto quando ho fatto l'ini 
		$loader->registerNamespace('App_'); //registro la posizione App_ che andra a ricercarli in seguito classi astratte del nostro modello 
        $this->getResourceLoader() //dove stanno le risorse 
             ->addResourceType('modelResource','models/resources','Resource');  //1° quale parametro voglio rimappare, 2° mappattura attuale , 3° nuova mappattura
    }
    
    protected function _initDbParms()
    {
        $HOST = null; $USER = null ; $PASSWORD = null ; $DB = null;
    	include_once (APPLICATION_PATH . '/include/connectZP.php');
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    			'host'     => $HOST,
    			'username' => $USER,
    			'password' => $PASSWORD,
    			'dbname'   => $DB
				));  
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }
}
