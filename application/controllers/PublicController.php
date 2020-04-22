<?php

class PublicController extends Zend_Controller_Action {

    protected $_publicModel;
    protected $_faqModel;
    protected $_authService;
    protected $_form;
    protected $_filterForm;
    protected $_formclient;

    public function init() {
        //session_start();
        $this->_helper->layout->setLayout('main');
        $this->_publicModel = new Application_Model_Public();
        $this->_authService = new Application_Service_Auth();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->filterForm = $this->getFilterForm();
        $this->view->clientForm = $this->getClientForm();
        $this->_faqModel = new Application_Model_Faq();
        $this->_logger = Zend_Registry::get('log');
    }

    public function indexAction() {
        $this->_logger->info('Nuovo accesso al sito');
    }

    public function viewstaticAction() {
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }

    public function loginAction() {
        
    }

    public function authenticateAction() {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->Role);
    }

    public function getLoginForm() {
        $urlHelper = $this->_helper->getHelper('url');

        $this->_form = new Application_Form_Public_Auth_Login();

        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'authenticate'),
                        'default'));

        return $this->_form;
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
        return $this->_helper->redirector('catalogo','public');
    }

    public function catalogoAction() {
        $request = $this->getRequest();
        $paged = $this->_getParam('page', 1);
        $filtri = $this->_getParam('deep', false);
        $posti = null;
        $prezzoMinimo = null;
        $prezzoMassimo = null;




        if ($filtri === 'true') {
            if (isset($_SESSION['Posti']) || (isset($_SESSION['PrezzoMin']) && isset($_SESSION['PrezzoMax']))) {
                if ($this->getRequest()->isPost()) {
                    if (isset($_SESSION['Posti'])) {
                        unset($_SESSION['Posti']);
                    }
                    if (isset($_SESSION['PrezzoMin'])) {
                        unset($_SESSION['PrezzoMin']);
                    }
                    if (isset($_SESSION['PrezzoMax'])) {
                        unset($_SESSION['PrezzoMax']);
                    }
                    //return null; 
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
                    if (isset($_SESSION['Posti'])) {
                        $posti !== null ? $_SESSION['Posti'] = $posti : $_SESSION['Posti'] = $this->getRequest()->getParam('Posti');
                    }
                    if (isset($_SESSION['PrezzoMin'])) {
                        $prezzoMinimo === $_SESSION['PrezzoMin'] ? $_SESSION['PrezzoMin'] = $prezzoMinimo : $_SESSION['PrezzoMin'] = $this->getRequest()->getParam('PrezzoMin');
                    }
                    if (isset($_SESSION['PrezzoMax'])) {
                        $prezzoMassimo === $_SESSION['PrezzoMax'] ? $_SESSION['PrezzoMax'] = $prezzoMassimo : $_SESSION['PrezzoMax'] = $this->getRequest()->getParam('PrezzoMax');
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
                }
                $posti === null ? $_SESSION['Posti'] = null : $_SESSION['Posti'] = $posti;
                $prezzoMassimo === null ? $_SESSION['PrezzoMax'] = null : $_SESSION['PrezzoMax'] = $prezzoMassimo;
                $prezzoMinimo === null ? $_SESSION['PrezzoMin'] = null : $_SESSION['PrezzoMin'] = $prezzoMinimo;
            }

            if (!isset($_SESSION['Posti']) && !isset($_SESSION['PrezzoMin']) && !isset($_SESSION['PrezzoMax'])) {
                $cars = $this->_publicModel->getCars($paged);
                $this->view->assign(array('Cars' => $cars, 'Deep' => 'false')
                );
            } else {
                if (!isset($_SESSION['Posti'])) {
                    if (!isset($_SESSION['PrezzoMin']) || !isset($_SESSION['PrezzoMax'])) {
                        $this->_helper->redirector('catalogo');
                    } else {
                        $cars = $this->_publicModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], null, null, null);
                    }
                } else {
                    if (!isset($_SESSION['PrezzoMin']) || !isset($_SESSION['PrezzoMax'])) {
                        $cars = $this->_publicModel->getCarsByFilter($paged, null, null, $_SESSION['Posti'], null, null);
                    } else {
                        $cars = $this->_publicModel->getCarsByFilter($paged, $_SESSION['PrezzoMin'], $_SESSION['PrezzoMax'], $_SESSION['Posti'], null, null);
                    }
                }

                $this->view->assign(array('Cars' => $cars, 'Deep' => $filtri)
                );
            }
        } else {
            $cars = $this->_publicModel->getCars($paged);
            $this->view->assign(array('Cars' => $cars, 'Deep' => 'false')
            );
        }
    }

    public function faqAction() {
        $faqs = $this->_faqModel->getFaqs();

        $this->view->assign(array(
            'Faqs' => $faqs)
        );
    }

    public function visualizzaAction() {

        $idCar = $this->_getParam('carId', null);


        if (!is_null($idCar)) {
            $car = $this->_publicModel->getCarById($idCar);
            $this->view->assign(array(
                'Car' => $car)
            );
        } else {
            $this->_helper->redirector('catalogo', 'public');
        }
    }

    public function getFilterForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $paged = $this->_getParam('page', 1);
        $this->_filterForm = new Application_Form_Public_Catalogo_Filter();

        $this->_filterForm->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'catalogo',
                    'deep' => 'true'),
                        'default'));
        return $this->_filterForm;
    }

    public function registernewclientAction() {
        
    }
    
    
    public function docAction(){
        
    }

    public function addclientAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_formclient;
        if (!$form->isValid($_POST)) {
            return $this->render('registernewclient');
        }
        $values = $form->getValues();
        $this->_publicModel->saveClient($values);
        $this->_helper->redirector('login', 'public');
    }

    public function getClientForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formclient = new Application_Form_Public_User_New();

        $this->_formclient->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'addclient'),
                        'default'));

        return $this->_formclient;
    }

}
