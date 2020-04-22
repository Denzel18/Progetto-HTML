<?php

class AdminController extends Zend_Controller_Action {

    protected $_adminModel;
    protected $_form;
    protected $_formAuto;
    protected $_carEditForm;
    protected $_faqForm;
    protected $_faqEditForm;
    protected $_formclient;
    protected $_staffEditForm;
    protected $_clientEditForm;
    protected $_profileEditForm;
    protected $_ResponseForm;
    protected $_IDFaq;

    public function init() {
        $this->_helper->layout->setLayout('admin');

        $this->_authService = new Application_Service_Auth();

        $this->_faqModel = new Application_Model_Faq();
        $this->_adminModel = new Application_Model_Admin();

        $this->view->autoForm = $this->getAutoForm();
        $this->view->formEditCar = $this->getCarEditForm();

        $this->view->staffForm = $this->getStaffForm();
        $this->view->staffEditForm = $this->getStaffEditForm();

        $this->view->faqForm = $this->getFaqForm();
        $this->view->faqEditForm = $this->getFaqEditForm();

        $this->view->clientForm = $this->getClientForm();
        $this->view->clientEditForm = $this->getClientEditForm();

        $this->view->userdEditForm = $this->getProfileEditForm();
        
        $this->view->ResponseForm = $this->getResponseMessageForm();
        
        
    }

    public function indexAction() {
        
    }

    //------------------STAFF-------------------
    public function showstaffAction() {
        //Vado a prendere il contenuto dal model  
        $staff = $this->_adminModel->getStaffs();
        //assegno il contenuto da mandare al view script 
        $this->view->assign(array(
            'Staff' => $staff)
        );
    }

    public function deletestaffAction() {
        //pesco dal URL l'idCar
        $idStaff = $this->_getParam('staffId', null);
        //Vado a prendere il contenuto dal model  

        if (!is_null($idStaff)) {
            $idStaff = $this->_adminModel->deleteStaffById($idStaff);

            $staff = $this->_adminModel->getStaffs();
            $this->view->assign(array('Staff' => $staff));
            $this->_helper->redirector('showstaff', 'admin');
        } else {
            $this->_helper->redirector('showstaff', 'admin');
        }
    }

    public function newstaffAction() {
        
    }

    public function addstaffAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST)) {
            return $this->render('newstaff');
        }
        $values = $form->getValues();
        $this->_adminModel->saveStaff($values);
        //$this->_helper->redirector('showstaff','admin');
        $this->_helper->redirector('showstaff');
    }

    public function getStaffForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_form = new Application_Form_Admin_Staff_Add();

        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addstaff'),
                        'default'));

        return $this->_form;
    }

    public function editstaffAction() {
        
    }

    public function getStaffEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idUser = $this->_getParam('staffId', null);
        $user = null;
        $userArray = array();
        if (!is_null($idUser)) {
            $user = $this->_adminModel->getStaffById($idUser);
            $userArray = array(
                'Nome' => $user['Nome'],
                'Cognome' => $user['Cognome'],
                'Username' => $user['Username'],
                'Password' => $user['Password'],
                'CodicePatente' => $user['CodicePatente'],
                'LuogoResidenza' => $user['LuogoResidenza'],
                'DataNascita' => $user['DataNascita'],
                'Occupazione'=>$user['Occupazione']
            );

        }
        $this->_staffEditForm = new Application_Form_Admin_Staff_Edit();
        $this->_staffEditForm->populate($userArray);
        $this->_staffEditForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'saveeditstaff'),
                        'default'));
        return $this->_staffEditForm;
    }

    public function saveeditstaffAction() {
        $id = $this->_getParam('staffId', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_staffEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editstaff');
        }
        $values = $form->getValues();
        $this->_adminModel->editstaff($values, $id);
        $this->_helper->redirector('showstaff');
    }

    //----------- END STAFF ------------------
    //---------------CLIENT---------------------
    public function showclientAction() {
        //Vado a prendere il contenuto dal model  
        $staff = $this->_adminModel->getClients();
        $eliminaForm = $this->getDeleteClientForm();
        //assegno il contenuto da mandare al view script 
        $this->view->assign(array(
            'Clienti' => $staff,
            'Elimina' => $eliminaForm)
        );
    }

    public function getDeleteClientForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_form = new Application_Form_Admin_Client_Delete();

        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'aaaa'),
                        'default'));

        return $this->_form;
    }
    public function deleteclientAction() {
        //pesco dal URL l'idCar
        $idClient = $this->_getParam('clientId', null);
        //Vado a prendere il contenuto dal model  

        if (!is_null($idClient)) {
            $idClient = $this->_adminModel->deleteClientById($idClient);

            $clienti = $this->_adminModel->getClients();
            $this->view->assign(array('Clienti' => $clienti));
            $this->_helper->redirector('showclient', 'admin');
        } else {
            $this->_helper->redirector('showclient', 'admin');
        }
    }

    public function newclientAction() {
        
    }

    public function addclientAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_formclient;
        if (!$form->isValid($_POST)) {
            return $this->render('newclient');
        }
        $values = $form->getValues();
        $this->_adminModel->saveClient($values);
        $this->_helper->redirector('showclient', admin);
    }

    public function getClientForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_formclient = new Application_Form_Admin_Client_Add();

        $this->_formclient->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addclient'),
                        'default'));

        return $this->_formclient;
    }

    public function editclientAction() {
        
    }

    public function getClientEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idUser = $this->_getParam('clientId', null);
        $user = null;
        $userArray = array();
        if (!is_null($idUser)) {
            $user = $this->_adminModel->getClientById($idUser);
            $userArray = array(
                'Nome' => $user['Nome'],
                'Cognome' => $user['Cognome'],
                'Username' => $user['Username'],
                'Password' => $user['Password'],
                'CodicePatente' => $user['CodicePatente'],
                'LuogoResidenza' => $user['LuogoResidenza'],
                'DataNascita' => $user['DataNascita'],
                'Occupazione'=>$user['Occupazione']
            );
        }
        $this->_staffEditForm = new Application_Form_Admin_Client_Edit();
        $this->_staffEditForm->populate($userArray);
        $this->_staffEditForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'saveeditclient'),
                        'default'));
        return $this->_staffEditForm;
    }

    public function saveeditclientAction() {
        $id = $this->_getParam('clientId', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_staffEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editclient');
        }
        $values = $form->getValues();
        $this->_adminModel->editclient($values, $id);
        $this->_helper->redirector('showclient');
    }

    //--------------END CLIENT -----------------
    //
    //
    //
    //-------------CAR---------------------

    public function newautoAction() {
        
    }

    public function showcarsAction() {
        //Vado a prendere il contenuto dal model  
        $auto = $this->_adminModel->getCars();
        //assegno il contenuto da mandare al view script
        $this->view->assign(array(
            'Car' => $auto)
        );
    }

    public function deletecarAction() {
        //pesco dal URL l'idCar
        $idCar = $this->_getParam('carId', null);
        //Vado a prendere il contenuto dal model  

        if (!is_null($idCar)) {
            $idCar = $this->_adminModel->deleteCarById($idCar);

            $auto = $this->_adminModel->getCars();
            $this->view->assign(array('Auto' => $auto));
            $this->_helper->redirector('showcars', 'admin');
        } else {
            $this->_helper->redirector('showcars', 'admin');
        }
    }

    public function addautoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_formAuto;
        if (!$form->isValid($_POST)) {
            return $this->render('newauto');
        }
        $values = $form->getValues();
        $this->_adminModel->saveAuto($values);
        $this->_helper->redirector('showcars');
    }

    public function getAutoForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_formAuto = new Application_Form_Admin_Auto_Add();

        $this->_formAuto->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addauto'),
                        'default'));

        return $this->_formAuto;
    }

    public function editcarAction() {
        
    }

    public function getCarEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idCar = $this->_getParam('carId', null);
        $car = null;
        $CarArray = array();
        if (!is_null($idCar)) {
            $car = $this->_adminModel->getCarById($idCar);
            $CarArray = array('Targa' => $car['Targa'],
                'Colore' => $car['Colore'],
                'Marca' => $car['Marca'],
                'Modello' => $car['Modello'],
                'Alimentazione' => $car['Alimentazione'],
                'NPosti' => $car['NPosti'],
                'Cilindrata' => $car['Cilindrata'],
                'Under25' => $car['Under25'],
                'Prezzo' => $car['Prezzo'],
                'Image' => $car['Image'],
                'Image2' => $car['Image2'],
                'Image3' => $car['Image3']
            );
        }
        $this->_carEditForm = new Application_Form_Admin_Auto_Edit();
        $this->_carEditForm->populate($CarArray);
        $this->_carEditForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'saveeditcar'),
                        'default'));
        return $this->_carEditForm;
    }


    public function saveeditcarAction() {
        $id = $this->_getParam('carId', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_carEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editcar');
        }
        $values = $form->getValues();
        $this->_adminModel->editCar($values, $id);
        $this->_helper->redirector('showcars');
    }

    //--------------END CAR -----------------
    //
    //
    //-------------FAQ--------------------- 
    public function showfaqAction() {
        //Vado a prendere il contenuto dal model  
        $faq = $this->_adminModel->getFaqs();
        //assegno il contenuto da mandare al view script
        $this->view->assign(array(
            'Faq' => $faq)
        );
    }

    public function deletefaqAction() {
        //pesco dal URL l'idCar
        $idFaq = $this->_getParam('faqId', null);
        //Vado a prendere il contenuto dal model  

        if (!is_null($idFaq)) {
            $idFaq = $this->_adminModel->deleteFaqById($idFaq);
            $faq = $this->_adminModel->getFaqs();
            $this->view->assign(array('Faq' => $faq));
            $this->_helper->redirector('showfaq', 'admin');
        }
        $this->_helper->redirector('showfaq', 'admin');
    }

    public function newfaqAction() {
        
    }

    public function addfaqAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_faqForm;
        if (!$form->isValid($_POST)) {
            return $this->render('newfaq');
        }
        $values = $form->getValues();
        print_r($values);
        $this->_adminModel->saveFaq($values);
        $this->_helper->redirector('showfaq');
    }

    public function getFaqForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_faqForm = new Application_Form_Admin_Faq_Add();

        $this->_faqForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addfaq'),
                        'default'));

        return $this->_faqForm;
    }

    public function editfaqAction() {
        
    }

    public function getFaqEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idFaq = $this->_getParam('faqId', null);
        $faq = null;
        $faqArray = array();
        if (!is_null($idFaq)) {
            $faq = $this->_adminModel->getFaqById($idFaq);
            $faqArray = array('Domanda' => $faq['Domanda'], 'Risposta' => $faq['Risposta']);
        }
        $this->_faqEditForm = new Application_Form_Admin_Faq_Edit();
        $this->_faqEditForm->populate($faqArray);
        $this->_faqEditForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'saveeditfaq'),
                        'default'));
        return $this->_faqEditForm;
    }

    public function saveeditfaqAction() {
        $id = $this->_getParam('faqId', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_faqEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editfaq');
        }
        $values = $form->getValues();
        $this->_adminModel->editFaq($values, $id);
        $this->_helper->redirector('showfaq');
    }

    //--------------END FAQ -----------------
    //---------- PROFILO ---------------

    public function editprofileAction() {
        
    }

    public function getProfileEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $id = $this->_getParam('Id', null);
        $user = null;
        $userArray = array();
        if (!is_null($id)) {
            $user = $this->_adminModel->getUserById($id);
            $userArray = array(
                'Nome' => $user['Nome'],
                'Cognome' => $user['Cognome'],
                'Username' => $user['Username'],
                'Password' => $user['Password'],
                'CodicePatente' => $user['CodicePatente'],
                'LuogoResidenza' => $user['LuogoResidenza'],
                'DataNascita' => $user['DataNascita'],
                'Occupazione'=>$user['Occupazione']
            );
        }
        $this->_profileEditForm = new Application_Form_Admin_User_Edit();
        $this->_profileEditForm->populate($userArray);
        $this->_profileEditForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'saveeditprofile'),
                        'default'));
        return $this->_profileEditForm;
    }

    public function saveeditprofileAction() {
        $id = $this->_getParam('Id', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_profileEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editprofile');
        }
        $values = $form->getValues();
        $this->_adminModel->editProfile($values, $id);
        $this->_helper->redirector('index');
    }

    //---------- ENDPROFILO --------------

    //show message
    public function messaggiAction() {

        $msgNonLetti = $this->_adminModel->getMessageNoRead();
        $msgLetti = $this->_adminModel->getMessageRead();
        $this->view->assign(array(
            'MessaggiNonLetti' => $msgNonLetti,'MessaggiLetti' => $msgLetti)
        );
    }
    
    public function rispondiAction(){
        
    }


    public function messageresponseAction(){
        $id = $this->_getParam('Id', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_ResponseForm;
        if (!$form->isValid($_POST)) {
            return $this->_helper->redirector('index');
        }
        $values = $form->getValues();
        $this->_adminModel->setMessageResponse($values);
        $this->_helper->redirector('messaggi');
        
    }

    public function getResponseMessageForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $id = $this->_getParam('IdMsg', null);
        $msg = null; 
        $msgArray = array(); 
        if (!is_null($id)) {
            $msg = $this->_adminModel->getMessagebyId($id);
            $messaggio = $this->_adminModel->setMessagebyIdRead($id);
            $msgArray = array(
                'Domanda' => $msg['Messaggio'],
                'IDDestinatario' =>$msg['IDMittente'],
                'IDMittente'=>$msg['IDDestinatario'],
                'Data'=>$msg['Data'],
                'Visualizzato' => 0 
            );
        }
        $this->_ResponseForm = new Application_Form_Admin_Messagge_Response();
        $this->_ResponseForm->populate($msgArray);
        $this->_ResponseForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'messageresponse'),
                        'default'));
        return $this->_ResponseForm;
    }

    public function statisticaAction(){
        $numeroPrenotazioni= array();
        $i = 1;
        $x = 1;
        
        for($i = 1 ; $i < 13 ; $i++){
            $x = $this->_adminModel->getNBoooking($i);
            $numeroPrenotazioni[$i]=  $x ;
        }
       

        
        $this->view->assign(array('Prenotazioni' => $numeroPrenotazioni));
        
        
    }
    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }
    
    public function visualizzaAction() {
        $idCar = $this->_getParam('carId', null);
        if (!is_null($idCar)) {
            $car = $this->_adminModel->getCarById($idCar);
            $this->view->assign(array('Car' => $car));
        } else {
            $this->_helper->redirector('catalogo', 'admin');
        }
    }

    public function eliminazionemultiplaAction(){
        $id = $this->_getParam('ID', null);
        $ids= array();
        if (!is_null($id)) {
            
            $ids = explode(",", $id);
            print_r($ids);
          
            foreach($ids as $x){
                $this->_adminModel->deleteClientById($x);
            }
            $this->_helper->redirector('showclient', 'admin');
        }
    }
}
