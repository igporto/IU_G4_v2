<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/EVENT.php");
require_once(__DIR__ . "/../model/PUPILATTENDSEVENT.php");
require_once(__DIR__."/../model/EVENT_model.php");
require_once(__DIR__."/../model/SPACE_model.php");
require_once(__DIR__."/../model/EMPLOYEE_model.php");
require_once(__DIR__."/../model/ALUMN_model.php");
//require_once(__DIR__."/SESSION_controller.php");

require_once(__DIR__."/../model/PERMISSION_model.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
 * Class EventController
 *
 *
 */
class EventController extends BaseController {

    private $spaceMapper;
    private $employeeMapper;
    private $eventMapper;
    private $alumnMapper;


    public function __construct() {
        parent::__construct();

        $this->eventMapper = new EventMapper();
        $this->employeeMapper = new EmployeeMapper();
        $this->spaceMapper = new SpaceMapper();
        $this->alumnMapper = new AlumnMapper();

        $this->view->setLayout("navbar");

    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Event baleiro
            $event = new Event();
            //Engadimos os datos do obxecto
            $event->setName(htmlentities(addslashes($_POST["name"])));
            $event->setIniHour(htmlentities(addslashes($_POST["inihour"])));
            $event->setFinHour(htmlentities(addslashes($_POST["finhour"])));
            $event->setDate(htmlentities(addslashes($_POST["date"])));
            $event->setCapacity(htmlentities(addslashes($_POST["capacity"])));
            $event->setSpace($this->spaceMapper->view(htmlentities(addslashes($_POST["space"]))));
            $event->setEmployee($this->employeeMapper->view(htmlentities(addslashes($_POST["employee"]))));
            $event->setFreeplaces(htmlentities(addslashes($_POST["capacity"])));

            try {
                if(!$this->eventMapper->EventNameExists($event->getName())){
                    if($event->getCapacity()>0){
                        if($event->getCapacity()<= $event->getSpace()->getCapacity()){
                            //if(isValidRange($event->getDate(),$event->getIniHour(),$event->getFinHour())) {
                                $this->eventMapper->add($event);
                                $this->view->setFlash('succ_event_add');
                                $this->view->redirect("event", "show");
                            /*}else{
                                $this->view->setFlash("fail_hour_incorrect");
                            }*/
                        }else{
                            $this->view->setFlash("fail_aforo_fail_event");
                        }
                    } else {
                        $this->view->setFlash("fail_aforo_incorrect");
                    }
                }else{
                    $this->view->setFlash("fail_event_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada

        $this->view->render("event", "add");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {

            //creamos un obxecto Evento cos datos da actividade a editar
            $event = $this->eventMapper->view($_GET["codevent"]);


            if(isset($_POST['name']) && $_POST['name']!="") {
                $event->setName(htmlentities(addslashes($_POST["name"])));
                if ($this->eventMapper->eventnameExists($event->getName())) {
                    $this->view->setFlash("fail_event_exists");
                    $this->view->redirect("event", "edit", "codevent=" . $_GET["codevent"]);
                }
            }

            if(isset($_POST['capacity']) && $_POST['capacity'] != ""){
                $apuntados = $event->getCapacity() - $event->getFreeplaces();
                if($apuntados < $_POST['capacity']){
                    $event->setCapacity(htmlentities(addslashes($_POST["capacity"])));
                    $event->setFreeplaces($event->getCapacity() - $apuntados);
                }else{
                    $this->view->setFlash("fail_capacity_less_apuntados");
                    $this->view->redirect("event", "edit", "codevent=" . $_GET["codevent"]);
                }
            }

            if(isset($_POST['date']) && $_POST['date'] != ""){
                $event->setDate(htmlentities(addslashes($_POST["capacity"])));
            }

            if(isset($_POST['inihour']) && $_POST['inihour'] != ""){
                $event->setIniHour(htmlentities(addslashes($_POST["inihour"])));
            }

            if(isset($_POST['finhour']) && $_POST['finhour'] != ""){
                $event->setFinHour(htmlentities(addslashes($_POST["finhour"])));
            }

            if(isset($_POST['space'])){
                $event->setSpace($this->spaceMapper->view(htmlentities(addslashes($_POST["space"]))));
            }

            if(isset($_POST['employee'])){
                $event->setEmployee($this->employeeMapper->view(htmlentities(addslashes($_POST["employee"]))));
            }


            try {
                if($event->getCapacity()>0){
                    if($event->getCapacity() <= $event->getSpace()->getCapacity()){
                        //if(isValidRange($event->getDate(),$event->getIniHour(),$event->getFinHour())) {
                            $this->eventMapper->edit($event);
                            $this->view->setFlash("succ_event_edit");
                            $this->view->redirect("event", "show");
                        /*}else{
                            $this->view->setFlash("fail_hour_incorrect");
                        }*/
                    }else{
                        $this->view->setFlash("fail_aforo_fail_event");
                    }
                } else {
                    $this->view->setFlash("fail_aforo_incorrect");
                }

            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("event", "edit");
    }

    public function show()
    {
        $events = $this->eventMapper->show();
        $this->view->setVariable("eventstoshow", $events);
        $this->view->render("event", "show");
    }

    public function view()
    {
        $event = $this->eventMapper->view(htmlentities(addslashes($_REQUEST["codevent"])));
        $this->view->setVariable("event", $event);
        $this->view->render("event", "view");
    }

    public function delete()
    {
        try {
            if (isset($_GET['codevent'])) {
                $this->eventMapper->delete(htmlentities(addslashes($_GET['codevent'])));
                $this->view->setFlash('succ_event_delete');
                $this->view->redirect("event", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("event", "show");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {
            $event = new Event();


            if (isset($_POST['name']) && $_POST['name'] != "") {
                $event->setName(htmlentities(addslashes($_POST["name"])));
            }

            if (isset($_POST['capacity']) && $_POST['capacity'] != "") {
                $event->setCapacity(htmlentities(addslashes($_POST["capacity"])));
            }

            if (isset($_POST['date']) && $_POST['date'] != "") {
                $event->setDate(htmlentities(addslashes($_POST["capacity"])));
            }

            if (isset($_POST['inihour']) && $_POST['inihour'] != "") {
                $event->setIniHour(htmlentities(addslashes($_POST["inihour"])));
            }

            if (isset($_POST['finhour']) && $_POST['finhour'] != "") {
                $event->setFinHour(htmlentities(addslashes($_POST["finhour"])));
            }

            if (isset($_POST['space']) && $_POST['space'] != "") {
                $event->setSpace($this->spaceMapper->view(htmlentities(addslashes($_POST["date"]))));
            } else {
                $event->setSpace(new Space(""));
            }

            if (isset($_POST['employee']) && $_POST['employee'] != "") {
                $event->setEmployee($this->employeeMapper->view(htmlentities(addslashes($_POST["employee"]))));
            } else {
                $event->setEmployee(new Employee(""));
            }

            try {
                $this->view->setVariable("eventstoshow", $this->eventMapper->search($event));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("event", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("event", "show");
        } else {
            $this->view->render("event", "search");
        }
    }

    public function addpupil(){
        if (isset($_POST["submit"])) {
            $pupil = new PupilAttendsEvent();

            $pupil->setEvent($this->eventMapper->view(htmlentities(addslashes($_REQUEST['codevent']))));
            $pupil->setAlumn($this->alumnMapper->view(htmlentities(addslashes($_POST['codpupil']))));


            try {
                if(!$this->eventMapper->pupilannotated($pupil)){
                    if($pupil->getEvent()->getFreeplaces()>0){
                        $this->eventMapper->addpupil($pupil);
                        //ENVIAR AVISO DE ALUMNO ENGADIDO!!!!!!!!!!
                        $this->view->setFlash("succ_pupil_add");
                        //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos alumnos no evento)
                        $this->view->redirect("event", "showpupil" , "codevent=".$pupil->getEvent()->getCodevent());
                    }else{
                        $this->view->setFlash("fail_no_places");
                    }
                } else {
                    $this->view->setFlash("student_already_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("event", "addpupil");
    }

    public function showpupil(){
        $pupils = $this->eventMapper->showPupils($_GET['codevent']);
        $this->view->setVariable("pupilstoshow", $pupils);
        $this->view->render("event", "showpupil", "codevent=".$_GET['codevent']);
    }

    public function deletepupil()
    {

        try{
            if (isset($_GET['codpupil'])) {

                $alumn = $this->alumnMapper->view($_GET['codpupil']);
                $event = $this->eventMapper->view($_GET['codevent']);
                $this->eventMapper->deletePupil(new PupilAttendsEvent($event, $alumn));
                $this->view->setFlash('succ_student_delete');
                $this->view->redirect("event", "showpupil" , "codevent=".$event->getCodevent());
            }
        }catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }

        $this->view->render("event", "show");
    }
}
