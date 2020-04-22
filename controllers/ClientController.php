<?php

class ClientController extends Zend_Controller_Action {

    protected $_clientModel;
    protected $_filterForm;
    protected $_bookingForm;
    protected $_profileEditForm;
    protected $_ResponseForm;
    protected $_bookingEditForm;
    protected $_sidebarmenu;

    public function init() {
        $this->_helper->layout->setLayout('client');
        $this->_clientModel = new Application_Model_Client();
        $this->_authService = new Application_Service_Auth();
        $this->view->filterForm = $this->getFilterForm();
        $this->view->profileEditForm = $this->getProfileEditForm();
        $this->view->ResponseForm = $this->getMessageForm();
        $this->view->bookingForm = $this->getBookingForm();
        $this->view->bookingEditForm = $this->getBookingEditForm();
        $this->view->profileEditForm = $this->getProfileEditForm();
    }

    public function indexAction() {
        
    }

    public function azzerafiltriAction() {
        if (isset($_SESSION['Posti'])) {
            unset($_SESSION['Posti']);
        }
        if (isset($_SESSION['PrezzoMin'])) {
            unset($_SESSION['PrezzoMin']);
        }
        if (isset($_SESSION['PrezzoMax'])) {
            unset($_SESSION['PrezzoMax']);
        }
        if (isset($_SESSION['DataInizio'])) {
            unset($_SESSION['DataInizio']);
        }
        if (isset($_SESSION['DataFine'])) {
            unset($_SESSION['DataFine']);
        }
        return $this->_helper->redirector('catalogo', 'client');
    }

    private function azzera() {
        if (isset($_SESSION['Posti'])) {
            unset($_SESSION['Posti']);
        }
        if (isset($_SESSION['PrezzoMin'])) {
            unset($_SESSION['PrezzoMin']);
        }
        if (isset($_SESSION['PrezzoMax'])) {
            unset($_SESSION['PrezzoMax']);
        }
        if (isset($_SESSION['DataInizio'])) {
            unset($_SESSION['DataInizio']);
        }
        if (isset($_SESSION['DataFine'])) {
            unset($_SESSION['DataFine']);
        }
    }

    public function catalogoAction() {
        $request = $this->getRequest();
        $paged = $this->_getParam('page', 1);
        $filtri = $this->_getParam('deep', false);
        $posti = null;
        $prezzoMinimo = null;
        $prezzoMassimo = null;

        if ($filtri === 'true') {
            if (isset($_SESSION['Posti']) || (isset($_SESSION['PrezzoMin']) && isset($_SESSION['PrezzoMax'])) || (isset($_SESSION['DataInizio']) && isset($_SESSION['DataFine']))) {
                if ($this->getRequest()->isPost()) {
                    if ($this->getRequest()->getParam('Posti') === '0') {
                        $posti = null;
                    } else {
                        $posti = $this->getRequest()->getParam('Posti');
                    }
                    if ($this->getRequest()->getParam('PrezzoMin') === '-1') {
                        $prezzoMinimo = null;
                    } else {
                        $prezzoMinimo = $this->getRequest()->getParam('PrezzoMin');
                    }
                    if ($this->getRequest()->getParam('PrezzoMax') === '-1') {
                        $prezzoMassimo = null;
                    } else {
                        $prezzoMassimo = $this->getRequest()->getParam('PrezzoMax');
                    }
                    if ($this->getRequest()->getParam('DataInizio') === '') {
                        $dataInizio = null;
                    } else {
                        $dataInizio = trim($this->getRequest()->getParam('DataInizio'));
                    }
                    if ($this->getRequest()->getParam('DataFine') === '') {
                        $dataFine = null;
                    } else {
                        $dataFine = trim($this->getRequest()->getParam('DataFine'));
                    }

                    if (isset($_SESSION['Posti'])) {
                        $posti === $_SESSION['Posti'] ? $_SESSION['Posti'] = $posti : $_SESSION['Posti'] = $this->getRequest()->getParam('Posti');
                    }
                    if (isset($_SESSION['PrezzoMin'])) {
                        $prezzoMinimo === $_SESSION['PrezzoMin'] ? $_SESSION['PrezzoMin'] = $prezzoMinimo : $_SESSION['PrezzoMin'] = $this->getRequest()->getParam('PrezzoMin');
                    }
                    if (isset($_SESSION['PrezzoMax'])) {
                        $prezzoMassimo === $_SESSION['PrezzoMax'] ? $_SESSION['PrezzoMax'] = $prezzoMassimo : $_SESSION['PrezzoMax'] = $this->getRequest()->getParam('PrezzoMax');
                    }
                    if (isset($_SESSION['DataInizio'])) {
                        $prezzoMinimo === $_SESSION['DataInizio'] ? $_SESSION['DataInizio'] = $prezzoMinimo : $_SESSION['DataInizio'] = $this->getRequest()->getParam('DataInizio');
                    }
                    if (isset($_SESSION['DataFine'])) {
                        $prezzoMassimo === $_SESSION['DataFine'] ? $_SESSION['DataFine'] = $prezzoMassimo : $_SESSION['DataFine'] = $this->getRequest()->getParam('DataFine');
                    }
                }
            } else {

                if (!$this->getRequest()->isPost()) {
                    $this->_helper->redirector('catalogo');
                }
                $form = $this->_filterForm;
                if (!$form->isValid($request->getPost())) {
                    print_r($form->getMessages());
                    print_r($form->getErrors());
                    print_r($form->getErrorMessages());
                } else {
                    //$this->azzera();
                    if ($this->getRequest()->getParam('Posti') === '0') {
                        $posti = null;
                    } else {
                        $posti = $this->getRequest()->getParam('Posti');
                    }
                    if ($this->getRequest()->getParam('PrezzoMin') === '-1') {
                        $prezzoMinimo = null;
                    } else {
                        $prezzoMinimo = $this->getRequest()->getParam('PrezzoMin');
                    }
                    if ($this->getRequest()->getParam('PrezzoMax') === '-1') {
                        $prezzoMassimo = null;
                    } else {
                        $prezzoMassimo = $this->getRequest()->getParam('PrezzoMax');
                    }
                    if ($this->getRequest()->getParam('DataInizio') === '') {
                        $dataInizio = null;
                    } else {
                        $dataInizio = $this->getRequest()->getParam('DataInizio');
                    }
                    if ($this->getRequest()->getParam('DataFine') === '') {
                        $dataFine = null;
                    } else {
                        $dataFine = $this->getRequest()->getParam('DataFine');
                    }
                }
                $posti === null ? $_SESSION['Posti'] = null : $_SESSION['Posti'] = $posti;
                $prezzoMassimo === null ? $_SESSION['PrezzoMax'] = null : $_SESSION['PrezzoMax'] = $prezzoMassimo;
                $prezzoMinimo === null ? $_SESSION['PrezzoMin'] = null : $_SESSION['PrezzoMin'] = $prezzoMinimo;
                $dataInizio === null ? $_SESSION['DataInizio'] = null : $_SESSION['DataInizio'] = $dataInizio;
                $dataFine === null ? $_SESSION['DataFine'] = null : $_SESSION['DataFine'] = $dataFine;
            }

            if (!isset($_SESSION['Posti']) && !isset($_SESSION['PrezzoMin']) && !isset($_SESSION['PrezzoMax']) && !isset($_SESSION['DataInizio']) && !isset($_SESSION['DataFine'])) {
                $cars = $this->_clientModel->getCars($paged);
                $this->view->assign(array('Cars' => $cars, 'Deep' => 'false')
                );
            } else {
                $where = "";
                if (isset($_SESSION['Posti'])) {
                    if ($_SESSION['Posti'] != null)
                        $where .= "posti";
                } else {
                    $where .= "noposti";
                }

                if (isset($_SESSION['PrezzoMin']) && isset($_SESSION['PrezzoMax'])) {
                    if ($_SESSION['PrezzoMin'] != null && $_SESSION['PrezzoMax'] != null) {
                        $where .= ",prezzo";
                    }
                } else {
                    $where .= ",noprezzo";
                }
                if (isset($_SESSION['DataFine']) && isset($_SESSION['DataInizio'])) {
                    if ($_SESSION['DataFine'] != null && $_SESSION['DataInizio'] != null)
                        $where .= ",date";
                } else {
                    $where .= ",nodate";
                }

                $whereArray = explode(",", $where);

                if (count($whereArray) === 3) {
                    if ($whereArray[0] == "posti") {
                        if ($whereArray[1] == "prezzo") {
                            if ($whereArray[2] == "date") {
                                $cars = $this->_clientModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], $_SESSION['Posti'], $_SESSION['DataInizio'], $_SESSION['DataFine']);
                            } else {
                                $cars = $this->_clientModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], $_SESSION['Posti'], null, null);
                            }
                        } else {
                            if ($whereArray[2] == "date") {
                                $cars = $this->_clientModel->getCarsByFilter($paged, null, null, $_SESSION['Posti'], $_SESSION['DataInizio'], $dataFine);
                            } else {
                                $cars = $this->_clientModel->getCarsByFilter($paged, null, null, $posti, null, null);
                            }
                        }
                    } else {
                        if ($whereArray[1] == "prezzo") {
                            if ($whereArray[2] == "date") {
                                $cars = $this->_clientModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], null, $_SESSION['DataInizio'], $_SESSION['DataFine']);
                            } else {
                                $cars = $this->_clientModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], null, null, null);
                            }
                        } else {
                            if ($whereArray[2] == "date") {
                                $cars = $this->_clientModel->getCarsByFilter($paged, null, null, null, $_SESSION['DataInizio'], $_SESSION['DataFine']);
                            } else {
                                $cars = $this->_clientModel->getCars($paged);
                            }
                        }
                    }
                    $this->view->assign(array('Cars' => $cars, 'Deep' => $filtri)
                    );
                } else {
                    $cars = $this->_clientModel->getCars($paged);
                    $this->view->assign(array('Cars' => $cars, 'Deep' => 'false')
                    );
                }
            }
        } else {
            $cars = $this->_clientModel->getCars($paged);
            $this->view->assign(array('Cars' => $cars, 'Deep' => 'false')
            );
        }
    }

    public function visualizzaAction() {
        $idCar = $this->_getParam('carId', null);
        if (!is_null($idCar)) {
            $car = $this->_clientModel->getCarById($idCar);
            $this->view->assign(array('Car' => $car));
        } else {
            $this->_helper->redirector('catalogo', 'public');
        }
    }

    public function getFilterForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $paged = $this->_getParam('page', 1);
        $this->_filterForm = new Application_Form_Client_Catalogo_Filter();

        $this->_filterForm->setAction($urlHelper->url(array(
                    'controller' => 'client',
                    'action' => 'catalogo',
                    'page' => $paged,
                    'deep' => 'true'),
                        'default'));
        return $this->_filterForm;
    }

    public function newbookingAction() {
        
    }

    public function addbookingAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_bookingForm;
        if (!$form->isValid($_POST)) {
            return $this->render('newbooking');
        }
        $values = $form->getValues();
        $this->_clientModel->saveBooking($values);
        $this->_helper->redirector('showbooking');
    }

    public function getBookingForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idMacchina = $this->_getParam('carId');
        $idUtente = Zend_Auth::getInstance()->getIdentity()->IDUtente;


        $this->_bookingForm = new Application_Form_Client_Booking_Add();
        $this->_bookingForm->populate(array('IDMezzo' => $idMacchina, 'IDUtente' => $idUtente));
        $this->_bookingForm->setAction($urlHelper->url(array(
                    'controller' => 'client',
                    'action' => 'addbooking'), 'default'));

        return $this->_bookingForm;
    }

    public function showbookingAction() {

        $idUtenteLog = Zend_Auth::getInstance()->getIdentity()->IDUtente;
        $Booked = $this->_clientModel->getBooking2($idUtenteLog);
        $this->view->assign(array(
            'Prenotazione' => $Booked)
        );
    }

    public function deletebookingAction() {

        $idBooking = $this->_getParam('BookingId', null);
        if (!is_null($idBooking)) {
            $idBooking = $this->_clientModel->deleteBookingById($idBooking);

            $prenotazioni = $this->_clientModel->getBookings();
            $this->view->assign(array('Prenotazioni' => $prenotazioni));
            $this->_helper->redirector('showbookings', 'client');
        } else {
            $this->_helper->redirector('showbookings', 'client');
        }
    }

    public function editbookingAction() {
        
    }

    public function getBookingEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idPrenotazione = $this->_getParam('bookingId', null);
        $booking = null;
        $bookingArray = array();
        if (!is_null($idPrenotazione)) {
            $booking = $this->_clientModel->getBookingById($idPrenotazione);
            $bookingArray = array(
                'IDPrenotazione' => $booking['IDPrenotazione'],
                'IDMezzo' => $booking['IDMezzo'],
                'IDUtente' => $booking['IDUtente'],
                'DataInizio' => $booking['DataInizio'],
                'DataFine' => $booking['DataFine'],
                'DataPrenotazione' => $booking['DataPrenotazione']
            );
        }
        $this->_bookingEditForm = new Application_Form_Client_Booking_Edit();
        $this->_bookingEditForm->populate($bookingArray);
        $this->_bookingEditForm->setAction($urlHelper->url(array(
                    'controller' => 'client',
                    'action' => 'saveeditbooking'),
                        'default'));
        return $this->_bookingEditForm;
    }

    public function saveeditbookingAction() {
        $id = $this->_getParam('bookingId', null);
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_bookingEditForm;
        if (!$form->isValid($_POST)) {
            return $this->render('editbooking');
        }
        $values = $form->getValues();
        $this->_clientModel->editBooking($values, $id);
        $this->_helper->redirector('showbooking');
    }

    //ALTER profile 
    public function editprofileAction() {
        
    }

    public function getProfileEditForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idClient = $this->_getParam('Id', null);
        $client = null;
        $clientArray = array();
        if (!is_null($idClient)) {
            $client = $this->_clientModel->getUserById($idClient);
            $clientArray = array(
                'Nome' => $client['Nome'],
                'Cognome' => $client['Cognome'],
                'Username' => $client['Username'],
                'Password' => $client['Password'],
                'CodicePatente' => $client['CodicePatente'],
                'LuogoResidenza' => $client['LuogoResidenza'],
                'DataNascita' => $client['DataNascita'],
                'Occupazione' => $client['Occupazione']
            );
        }
        $this->_profileEditForm = new Application_Form_Client_Profile_Edit();
        $this->_profileEditForm->populate($clientArray);
        $this->_profileEditForm->setAction($urlHelper->url(array(
                    'controller' => 'client',
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
        $this->_clientModel->editProfile($values, $id);
        $this->_helper->redirector('index');
    }

    /* ----------------MESSAGE---------------------------- */

    public function messaggiAction() {
        $idUtenteLog = Zend_Auth::getInstance()->getIdentity()->IDUtente;
        $messaggi = $this->_clientModel->getMessageByUserId($idUtenteLog);

        $this->view->assign(array(
            'Messaggi' => $messaggi));
    }

    public function getMessageForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $idUtente = Zend_Auth::getInstance()->getIdentity()->IDUtente;
        $idAdmin = 1;
        $visualizzato = 1;

        $messageArray = array('IDDestinatario' => $idAdmin, 'Visualizzato' => $visualizzato, 'IDMittente' => $idUtente);
        $this->_ResponseForm = new Application_Form_Client_Messagge_Response();
        $this->_ResponseForm->populate($messageArray);
        $this->_ResponseForm->setAction($urlHelper->url(array(
                    'controller' => 'client',
                    'action' => 'invio'),
                        'default'));
        return $this->_ResponseForm;
    }

    public function newmessaggeAction() {
        
    }

    public function invioAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_ResponseForm;
        if (!$form->isValid($_POST)) {
            return $this->render('newmessagge');
        }
        $values = $form->getValues();
        $this->_clientModel->invio($values);
        $this->_helper->redirector('messaggi');
    }

    //LOGOUT
    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

    public function faqAction() {
        //Vado a prendere il contenuto dal model  
        $faqs = $this->_clientModel->getFaqs();

        //assegno il contenuto da mandare al view script 
        $this->view->assign(array(
            'Faqs' => $faqs)
        );
    }

}
