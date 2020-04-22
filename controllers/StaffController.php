<?php

class StaffController extends Zend_Controller_Action {

    protected $_staffModel;
    protected $_form;
    protected $_formEditProfile;
    protected $_formAddCar;
    protected $_carEditForm;

    public function init() {
        $this->_helper->layout->setLayout('staff');
        $this->_staffModel = new Application_Model_Staff();
        $this->_authService = new Application_Service_Auth();
        $this->view->profileEditForm = $this->getProfileEditForm();
        $this->view->formAddCar = $this->getAutoForm();
        $this->view->formEditCar = $this->getCarEditForm();
    }

    public function indexAction() {
        
    }

    
    //______________EDIT PROFILE___________________
    public function editprofileAction() {
        
    }
    public function getProfileEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idStaff = $this->_getParam('Id', null);
        $staff = null;
        $staffArray = array();
        if (!is_null($idStaff)) {
            $staff = $this->_staffModel->getUserById($idStaff);
            $staffArray = array(
                'Nome' => $staff['Nome'],
                'Cognome' => $staff['Cognome'],
                'Username' => $staff['Username'],
                'Password' => $staff['Password'],                
                'CodicePatente' => $staff['CodicePatente'],
                'LuogoResidenza' => $staff['LuogoResidenza'],
                'DataNascita' => $staff['DataNascita'],
                'Occupazione'=>$staff['Occupazione']);
        }
        $this->_profileEditForm = new Application_Form_Staff_Profile_Edit();
        $this->_profileEditForm->populate($staffArray);
        $this->_profileEditForm->setAction($urlHelper->url(array(
                    'controller' => 'staff',
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
        $this->_staffModel->editProfile($values, $id);
        $this->_helper->redirector('index');
    }
    //___________NEW CAR_________________
    public function newautoAction() {
        
    }
    public function addcarAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_formAuto;
        if (!$form->isValid($_POST)) {
            return $this->render('newauto');
        }
        $values = $form->getValues();
        $this->_staffModel->saveAuto($values);
        $this->_helper->redirector('showcars');
    }
    public function getAutoForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_formAuto = new Application_Form_Staff_Auto_Add();

        $this->_formAuto->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'addcar'),
                        'default'));

        return $this->_formAuto;
    }
    //___________EDIT CAR_________________
    public function editcarAction() {
        
    }
    public function getCarEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idCar = $this->_getParam('carId', null);
        $car = null;
        $CarArray = array();
        if (!is_null($idCar)) {
            $car = $this->_staffModel->getCarById($idCar);
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
                'Image3' => $car['Image3']
            );
        }
        $this->_carEditForm = new Application_Form_Staff_Auto_Edit();
        $this->_carEditForm->populate($CarArray);
        $this->_carEditForm->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'saveeditcar'),
                        'default'));
        return $this->_carEditForm;
    }
    public function showcarsAction() {
        //Vado a prendere il contenuto dal model  
        $auto = $this->_staffModel->getCars();
        //assegno il contenuto da mandare al view script
        $this->view->assign(array(
            'Car' => $auto)
        );
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
        $this->_staffModel->editCar($values, $id);
        $this->_helper->redirector('showcars');
    }
    
    //__________DELETE CAR____________________
    public function deletecarAction() {
        //pesco dal URL l'idCar
        $idCar = $this->_getParam('carId', null);
        //Vado a prendere il contenuto dal model  

        if (!is_null($idCar)) {
            $idCar = $this->_staffModel->deleteCarById($idCar);

            $auto = $this->_staffModel->getCars();
            $this->view->assign(array('Auto' => $auto));
            $this->_helper->redirector('showcars', 'staff');
        } else {
            $this->_helper->redirector('showcars', 'staff');
        }
    }

    //DETAILS rented car 
    public function statisticaAction(){
        $numeroPrenotazioni= array();
        $prenotazioneMensile = null;
        $prenotazioni = array();
        $i = 1;
        $x = 0;
        $j = 0;
        for($i = 1 ; $i < 13 ; $i++){
            $j = 0; 
            $x = $this->_staffModel->getNBoooking($i);
            $prenotazioneMensile = $this->_staffModel->getNBoookingByMonth($i);
            foreach($prenotazioneMensile as $p){
                $auto = $this->_staffModel->getCarById($p->IDMezzo);
                $utente = $this->_staffModel->getUserById($p->IDUtente);
                $stringAuto = "TARGA : ".$auto->Targa." MARCA : ".$auto->Marca." MODELLO : ".$auto->Modello;
                $stringUtente = " --- CLIENTE : ".$utente->Nome." ".$utente->Cognome;
                $prenotazioni[] = $stringAuto." ".$stringUtente;
            }
            $numeroPrenotazioni[$i]=  $x ;
            $bookings[$i] = $prenotazioni;
            $prenotazioni = null; 
         
        }
        $this->view->assign(array('Prenotazioni' => $numeroPrenotazioni , 'Bookings' => $bookings));
    }

    //LOGOUT
    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

    public function visualizzaAction() {
        $idCar = $this->_getParam('carId', null);
        if (!is_null($idCar)) {
            $car = $this->_staffModel->getCarById($idCar);
            $this->view->assign(array('Car' => $car));
        } else {
            $this->_helper->redirector('catalogo', 'staff');
        }
    }
}
