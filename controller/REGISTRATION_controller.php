<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../model/REGISTRATION.php");
require_once(__DIR__ . "/../model/REGISTRATION_model.php");
require_once(__DIR__ . "/../model/RESERVE.php");
require_once(__DIR__ . "/../model/RESERVE_model.php");
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
    private $reserveMapper;
    private $paymentMapper;

    public function __construct()
    {
        parent::__construct();
        $this->registrationMapper = new RegistrationMapper();
        $this->reserveMapper = new ReserveMapper();
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
            if(isset($_POST['reserve'])){
                if($_POST['reserve'] !=NULL){
                    $registration->setReserve($this->reserveMapper->view($_POST["reserve"]));
                }else{
                    $registration->setReserve(new Reserve());
                }
            }
            if(isset($_POST['date'])){
                $registration->setDate($_POST["date"]);
            }
            if(isset($_POST['payment'])){
                if($_POST['payment'] != NULL){
                $registration->setPayment($this->paymentMapper->view($_POST["payment"]));
                }else{
                    $registration->setPayment(new Payment());
                }
            }
            try {
                var_dump($registration);exit;
                $this->registrationMapper->add($registration);
                //ENVIAR AVISO DE INSCRIPCION ENGADIDA!!!!!!!!!!
                $this->view->setFlash('succ_registration_add');
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das inscricións)
                $this->view->redirect("registration", "show");
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
            $registration = $this->registrationMapper->view($_GET["codRegistration"]);
            if(isset($_POST['reserve'])){
                if($_POST['reserve'] != NULL){
                    $registration->setReserve($this->reserveMapper->view($_POST["reserve"]));
                }else{
                    $registration->setReserve(new Reserve());
                }
            }
            if(isset($_POST['payment'])){
                if($_POST['payment'] != NULL){
                $registration->setPayment($this->paymentMapper->view($_POST["payment"]));
                }else{
                    $registration->setPayment(new Payment());
                }
            }
            if(isset($_POST['date'])){
                $registration->setDate($_POST["date"]);
            }
            try {
                //ENVIAR AVISO DE INSCRIPCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_registration_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das INSCRIPCIONS)
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
            if(isset($_POST['codRegistration']) && $_POST['codRegistration']!= ""){
                $registration->setCodRegistration((htmlentities(addslashes($_POST["codRegistration"]))));
            }
            if(isset($_POST['useres']) && isset($_POST['reserve'])){
                $registration->setReserve($this->reserveMapper->view($_POST["reserve"]));
            }else{
                $aux = new Reserve();
                $aux->setCodReserve("");
                $registration->setReserve($aux);
            }
            if(isset($_POST['date']) && $_POST['date']){
                $registration->setDate((htmlentities(addslashes($_POST["date"]))));
            }
            if(isset($_POST['usepay']) && isset($_POST['payment'])) {
                $registration->setPayment($this->paymentMapper->view($_POST["payment"]));
            }else {
                $aux = new Payment();
                $aux->setIdPago("");
                $registration->setPayment($aux);
            }
            try {
                $this->view->setVariable("registrationstoshow", $this->registrationMapper->search($registration));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("registration", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("registration","show");
        }else{
            $this->view->render("registration", "search");
        }
    }
}
?>