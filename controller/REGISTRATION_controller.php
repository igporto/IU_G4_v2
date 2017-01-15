<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../model/REGISTRATION.php");
require_once(__DIR__ . "/../model/REGISTRATION_model.php");
require_once(__DIR__ . "/../model/ACTIVITY.php");
require_once(__DIR__ . "/../model/ACTIVITY_model.php");
require_once(__DIR__ . "/../model/EVENT.php");
require_once(__DIR__ . "/../model/EVENT_model.php");
require_once(__DIR__ . "/../model/ALUMN.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");
require_once(__DIR__ . "/../model/PAYMENT.php");
require_once(__DIR__ . "/../model/PAYMENT_model.php");
require_once(__DIR__ . "/../controller/BaseController.php");
/**
 * Class ActionsController
 *
 * Controller to login, logout and action data managing
 */
class RegistrationController extends BaseController
{
    private $registrationMapper;
    private $activityMapper;
    private $eventMapper;
    private $alumnMapper;
    private $paymentMapper;

    public function __construct()
    {
        parent::__construct();
        $this->registrationMapper = new RegistrationMapper();
        $this->activityMapper = new ActivityMapper();
        $this->eventMapper = new EventMapper();
        $this->alumnMapper = new AlumnMapper();
        $this->paymentMapper = new PaymentMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }
    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto registration baleiro
            $registration = new Registration();
            //Engadimos os datos ao obxecto registration

            $registration->setAlumn($this->alumnMapper->view($_POST["alumn"]));


            if(isset($_POST['activity'])){
                if($_POST['activity'] != "NULL"){
                    $registration->setActivity($this->activityMapper->view($_POST["activity"]));
                }else{
                    $registration->setActivity(new Activity());
                }
            }

            if(isset($_POST['event'])){
                if($_POST['event'] !=NULL){
                    $registration->setEvent($this->eventMapper->view($_POST["event"]));
                }else{
                    $registration->setEvent(new Event());
                }
            }
            $registration->setDate($this->registrationMapper->getToday());
            $registration->setPayment(new Payment());

            try {
                if($registration->getActivity()->getCodactivity() != NULL || $registration->getEvent()->getCodevent() != NULL){
                    $this->registrationMapper->add($registration);
                    $this->view->setFlash('succ_registration_add');
                    $this->view->redirect("registration", "show");
                }else{
                    $this->view->setFlash('fail_not_inscript');
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("registration", "add");
    }
    public function delete()
    {
        try {
            if (isset($_GET['codRegistration'])) {
                $this->registrationMapper->delete(htmlentities(addslashes($_GET['codRegistration'])));
                $this->view->setFlash('succ_registration_delete');
                $this->view->redirect("registration", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("registration", "show");
    }
    public function show()
    {
        $registrations = $this->registrationMapper->show();
        $this->view->setVariable("registrationstoshow", $registrations);
        $this->view->render("registration", "show");
    }
    public function view()
    {
        $registration = $this->registrationMapper->view(htmlentities(addslashes($_REQUEST["codRegistration"])));
        $this->view->setVariable("registration", $registration);
        $this->view->render("registration", "view");
    }
    public function edit()
    {
        if (isset($_POST["submit"])) {
            //creamos un obxecto actividade cos datos da actividade a editar
            $registration = $this->registrationMapper->view(htmlentities(addslashes($_GET["codRegistration"])));


            $registration->setAlumn($this->alumnMapper->view($_POST["alumn"]));


            if(isset($_POST['activity'])){
                if($_POST['activity'] !=NULL){
                    $registration->setActivity($this->activityMapper->view($_POST["activity"]));
                }else{
                    $registration->setActivity(new Activity());
                }
            }

            if(isset($_POST['event'])){
                if($_POST['event'] !=NULL){
                    $registration->setEvent($this->eventMapper->view($_POST["event"]));
                }else{
                    $registration->setEvent(new Event());
                }
            }

            try {
                $this->registrationMapper->edit($registration);
                $this->view->setFlash("succ_registration_edit");
                $this->view->redirect("registration", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("registration", "edit");
    }
    public function search(){
        if(isset($_POST["submit"])){
            $registration = new Registration();
            //Comprobamos os datos que nos chegan e engadimolos ao obxecto $registration
            if(isset($_POST['alumn'])){
                if($_POST['alumn'] !=NULL){
                    $registration->setAlumn($this->alumnMapper->view($_POST["alumn"]));
                }else{
                    $aux = new Alumn();
                    $aux->setCodalumn("");
                    $registration->setAlumn($aux);
                }
            }

            if(isset($_POST['activity'])){
                if($_POST['activity'] !=NULL){
                    $registration->setActivity($this->activityMapper->view($_POST["activity"]));
                }else{
                    $aux = new Activity();
                    $aux->setCodactivity("");
                    $registration->setActivity($aux);
                }
            }

            if(isset($_POST['event'])){
                if($_POST['event'] !=NULL){
                    $registration->setEvent($this->eventMapper->view($_POST["event"]));
                }else{
                    $aux = new Event();
                    $aux->setCodevent("");
                    $registration->setEvent($aux);
                }
            }
            try {
                $this->view->setVariable("registrationstoshow", $this->registrationMapper->search($registration));
            } catch (Exception $e) {
                var_dump($e->getMessage());exit;
                $this->view->setFlash("erro_general");
                $this->view->redirect("registration", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("registration","show");
        }else{
            $this->view->render("registration", "search");
        }
    }

    public function pay(){
        if(isset($_POST['submit'])){
            $registration = $this->registrationMapper->view($_GET['codRegistration']);
            $payment = new Payment();
            $payment->setDniAlum($registration->getAlumn()->getDni());
            $date = $this->registrationMapper->getNow();
            $payment->setFecha($date);
            $payment->setCantidad($_POST['money']);
            $payment->setMetodoPago($_POST['metodo_pago']);
            $payment->setPagado(1);
            $payment->setTipoCliente("student");
            $this->paymentMapper->add($payment);

            $registration->setPayment($this->paymentMapper->getByDate($payment));
            $this->registrationMapper->edit($registration);
            $this->view->setFlash("succ_payment_add");
            $this->view->redirect("registration", "show");
        }else{
            $this->view->render("registration", "pay", "codRegistration=".$_GET['codRegistration']);
        }

    }
}
?>