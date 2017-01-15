<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/ALUMN_model.php");
require_once(__DIR__ . "/../model/ALUMN.php");
require_once(__DIR__ . "/../model/INJURY_model.php");
require_once(__DIR__ . "/../model/ACCESSLOG.php");
require_once(__DIR__ . "/../model/ACCESSLOG_model.php");
require_once(__DIR__ . "/../model/USER.php");
require_once(__DIR__ . "/../model/USER_model.php");
require_once(__DIR__ . "/../model/REGISTRATION_model.php");
require_once(__DIR__ . "/../model/ACTIVITY_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


class AlumnController extends BaseController
{

    private $alumnMapper;
    private $injuryMapper;
    private $accesslogMapper;
    private $userMapper;

    public function __construct()
    {
        parent::__construct();

        $this->alumnMapper = new AlumnMapper();
        $this->injuryMapper = new InjuryMapper();
        $this->accesslogMapper = new AccesslogMapper();
        $this->userMapper = new UserMapper();
        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Alumn baleiro
            $alumn = new Alumn();

            //Engadimos os datos ao obxecto Alumn
            if (isset($_POST["dni"])) {
                $alumn->setDni(htmlentities(addslashes($_POST["dni"])));
            }

            if (isset($_POST["name"])) {
                $alumn->setAlumnname(htmlentities(addslashes($_POST["name"])));
            }

            if (isset($_POST['surname'])) {
                $alumn->setAlumnsurname(htmlentities(addslashes($_POST["surname"])));
            }

            if (isset($_POST['birthdate'])) {
                $alumn->setBirthdate(htmlentities(addslashes($_POST["birthdate"])));
            }
            if (isset($_POST['job'])) {
                $alumn->setJob(htmlentities(addslashes($_POST["job"])));
            }

            if (isset($_POST['address'])) {
                $alumn->setAddress(htmlentities(addslashes($_POST["address"])));
            }

            if (isset($_POST['email'])) {
                $alumn->setEmail(htmlentities(addslashes($_POST["email"])));
            }

            if (isset($_POST['comment']) && $_POST['comment'] != "") {
                $alumn->setComment(htmlentities(addslashes($_POST["comment"])));
            }

            try {
                if ($this->validar_dni($alumn->getDni())) {
                    if (!$this->alumnMapper->alumndniExists($alumn->getDni())) {
                        if ($this->validar_email($alumn->getEmail())) {
                            $this->alumnMapper->add($alumn);
                            //ENVIAR AVISO DE ALUMNO ENGADIDO!!!!!!!!!!
                            $this->view->setFlash('succ_alumn_add');

                            //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos alumnos)
                            $this->view->redirect("alumn", "show");
                        } else {
                            $this->view->setFlash("fail_email_incorrect");
                        }
                    } else {
                        $this->view->setFlash("fail_dni_exists");
                    }
                } else {
                    $this->view->setFlash("fail_dni_incorrect");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("alumn", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['codalumn'])) {
                $this->alumnMapper->delete(htmlentities(addslashes($_GET['codalumn'])));
                $this->view->setFlash('succ_alumn_delete');
                $this->view->redirect("alumn", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("alumn", "show");
    }

    public function show()
    {
        $alumns = $this->alumnMapper->show();
        $this->view->setVariable("alumnstoshow", $alumns);
        $this->view->render("alumn", "show");
    }

    public function view()
    {
        $alumn = $this->alumnMapper->view(htmlentities(addslashes($_REQUEST["codalumn"])));
        $this->view->setVariable("alumn", $alumn);
        $this->view->render("alumn", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {

            //creamos un obxecto actividade cos datos da actividade a editar
            $alumn = $this->alumnMapper->view($_GET["codalumn"]);


            if (isset($_POST["dni"]) && $_POST["dni"] != "") {
                if ($this->validar_dni(htmlentities(addslashes($_POST["dni"])))) {
                    if ($this->alumnMapper->alumndniExists($_POST["dni"])) {
                        $alumn->setAlumndni(htmlentities(addslashes($_POST["dni"])));
                    } else {
                        $this->view->setFlash("fail_dni_exists");
                        $this->view->render("alumn", "edit");
                    }
                } else {
                    $this->view->setFlash("fail_dni_incorrect");
                    $this->view->render("alumn", "edit");
                }
            }

            if (isset($_POST['name']) && $_POST["name"] != "") {
                $alumn->setAlumnname(htmlentities(addslashes($_POST["name"])));
            }

            if (isset($_POST['surname']) && $_POST["surname"] != "") {
                $alumn->setAlumnsurname(htmlentities(addslashes($_POST["surname"])));
            }

            if (isset($_POST['birthdate']) && $_POST["birthdate"] != "") {
                if ($this->alumnMapper->validar_fecha_nac(htmlentities(addslashes($_POST['birthdate'])))) {
                    $alumn->setBirthdate(htmlentities(addslashes($_POST["birthdate"])));
                } else {
                    $this->view->setFlash("fail_birthdate_incorrect");
                    $this->view->render("alumn", "edit");
                }
            }

            if (isset($_POST['job']) && $_POST["job"] != "") {
                $alumn->setJob(htmlentities(addslashes($_POST["job"])));
            }

            if (isset($_POST['address']) && $_POST["address"] != "") {
                $alumn->setAddress(htmlentities(addslashes($_POST["address"])));
            }

            if (isset($_POST['email']) && $_POST["email"] != "") {
                if ($this->validar_email(htmlentities(addslashes($_POST['email'])))) {
                    $alumn->setEmail(htmlentities(addslashes($_POST["email"])));
                } else {
                    $this->view->setFlash("fail_email_incorrect");
                    $this->view->render("alumn", "edit");
                }
            }

            if (isset($_POST['comment']) && $_POST["comment"] != "") {
                $alumn->setComment(htmlentities(addslashes($_POST["comment"])));
            }

            try {
                $this->alumnMapper->edit($alumn);
                //ENVIAR AVISO DE Alumno EDITADo!!!!!!!!!!
                $this->view->setFlash("succ_alumn_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos alumnos)
                $this->view->redirect("alumn", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        $this->view->render("alumn", "edit");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {

            //Creamos un obxecto Alumn baleiro
            $alumn = new Alumn();


            //Engadimos os datos ao obxecto Alumn

            if (isset($_POST["dni"]) && $_POST["dni"] != "") {
                $alumn->setDni(htmlentities(addslashes($_POST["dni"])));
            }

            if (isset($_POST['name'])) {
                $alumn->setAlumnname((htmlentities(addslashes($_POST["name"]))));
            }

            if (isset($_POST['surname'])) {
                $alumn->setAlumnsurname($_POST["surname"]);
            }

            if (isset($_POST['address'])) {
                $alumn->setAddress($_POST["address"]);
            }

            if (isset($_POST['job'])) {
                $alumn->setJob($_POST["job"]);
            }

            if (isset($_POST['pendingclasses']) && $_POST["pendingclasses"] != "") {
                $alumn->setPendingclasses($_POST["pendingclasses"]);
            }

            try {

                $this->view->setVariable("alumnstoshow", $this->alumnMapper->search($alumn));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("alumn", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("alumn", "show");
        } else {
            $this->view->render("alumn", "search");
        }


    }

    public function addinjury()
    {
        if (isset($_POST["submit"])) {
            $injury = new Pupilhasinjury();

            $injury->setPupil($this->alumnMapper->view(htmlentities(addslashes($_REQUEST['codalumn']))));
            $injury->setInjury($this->injuryMapper->view(htmlentities(addslashes($_POST['codinjury']))));
            $injury->setDateInjury(htmlentities(addslashes($_POST['date'])));

            try {
                if ($this->alumnMapper->validInjurydate($injury->getDateInjury())) {
                    $this->alumnMapper->addInjury($injury);
                    $this->view->setFlash("succ_injury_add");
                    $this->view->redirect("alumn", "showinjury", "codalumn=" . $injury->getPupil()->getCodalumn());
                } else {
                    $this->view->setFlash('fail_date_incorrect');
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("alumn", "addinjury");
    }

    public function showinjury()
    {
        $injurys = $this->alumnMapper->showinjury($this->alumnMapper->view(htmlentities(addslashes($_GET['codalumn']))));
        $this->view->setVariable("injurystoshow", $injurys);
        $this->view->render("alumn", "showinjury", "codalumn=" . $_GET['codalumn']);
    }

    public function editinjury()
    {
        if (isset($_POST['submit'])) {
            $phi = $this->alumnMapper->viewInjury(htmlentities(addslashes($_GET['codinjuryalumn'])));

            if (isset($_POST['dateI']) && $_POST['dateI'] != "") {
                $phi->setDateInjury(htmlentities(addslashes($_POST['dateI'])));
            }
            if(isset($_POST['dateR']) && $_POST['dateR'] != "") {
                $phi->setDateRecovery(htmlentities(addslashes($_POST['dateR'])));
            }

            try {
                if($this->alumnMapper->validInjurydate($phi->getDateInjury()) && $this->alumnMapper->validInjurydate($phi->getDateRecovery())) {
                    if($phi->getDateRecovery() > $phi->getDateInjury()){
                        $this->alumnMapper->editinjury($phi);
                        $this->view->setFlash('succ_injury_edit');
                        $this->view->redirect("alumn", "showinjury", "codalumn=" . $phi->getPupil()->getCodalumn());
                    }else{
                        $this->view->setFlash('fail_date_injuries');
                    }
                } else {
                    $this->view->setFlash('fail_date_incorrect');
                }
            } catch (Exception $e) {
                $this->view->setFlash('erro_general');
            }
        }
        $this->view->render("alumn", "editinjury", "codinjurypupil=" . $_GET['codinjuryalumn']);
    }

    public function deleteinjury(){
        try {
            if (isset($_GET['codinjuryalumn'])) {
                $ehi = $this->alumnMapper->viewInjury($_GET['codinjuryalumn']);
                $this->alumnMapper->deleteinjury(htmlentities(addslashes($_GET['codinjuryalumn'])));
                $this->view->setFlash('succ_injury_delete');
                $this->view->redirect("alumn", "showinjury", "codalumn=".$ehi->getPupil()->getCodalumn() );
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("alumn", "show");
    }

    public function viewinjury(){
        if(isset($_GET['codinjuryalumn'])){
            try{
                $phi = $this->alumnMapper->viewinjury(htmlentities(addslashes($_GET['codinjuryalumn'])));
                $log = new Accesslog();

                $log->setInjury($phi->getInjury());
                $log->setAlumn($phi->getPupil());
                $log->setUser($this->userMapper->view($this->userMapper->getIdByName($_SESSION['currentuser'])));
                $log->setDate($this->accesslogMapper->getToday());
                $this->writeLog($log);
                $this->accesslogMapper->add($log);

                $this->view->redirect("alumn", "showinjury", "codalumn=".$phi->getPupil()->getCodalumn() );
            }catch (Exception $e){
                $this->view->setFlash('erro_general');
            }
        }
    }

    public function validar_dni($dni)
    {
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
            return true;
        } else {
            return false;
        }
    }

    private function writeLog(Accesslog $log){
        $ruta = __DIR__."/../media/";
        $file = fopen($ruta."accessLog.txt", "a");

        fwrite($file, "".PHP_EOL);
        fwrite($file, $log->getDate()." --- ");
        fwrite($file, $log->getUser()->getUsername()." --- ");
        if($log->getAlumn() != NULL){
            fwrite($file, $log->getAlumn()->getDni()."->".$log->getAlumn()->getAlumnname()." ".$log->getAlumn()->getAlumnsurname()." --- ");
        }else{
            fwrite($file, " --- ");
        }
        if($log->getEmployee() != NULL){
            fwrite($file, $log->getEmployee()->getEmployeedni()."->".$log->getEmployee()->getEmployeename()." ".$log->getEmployee()->getEmployeesurname()." --- ");
        }else{
            fwrite($file, " --- ");
        }

        fwrite($file, $log->getInjury()->getNameInjury());

        fclose($file);

    }

    public function validar_email($direccion)
    {
        $Sintaxis = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if (preg_match($Sintaxis, $direccion))
            return true;
        else
            return false;
    }

    public function showdiscounts(){
        $alumn = $_GET['codalumn'];
        $rm = new RegistrationMapper();

        $registration = new Registration();

        $registration->setAlumn($this->alumnMapper->view($alumn));

        $registration->setEvent(new Event());

        $registration->setActivity(new Activity());

        $rs = $rm->search($registration);

        $activities = array();
        foreach ($rs as $r){
            array_push($activities, $r->getActivity());
        }

        $this->view->setVariable("activitiestoshow", $activities);
        $this->view->render("alumn", "showdiscount" ,"codalumn=".$alumn);

    }

}