<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/EVENT.php");
require_once(__DIR__."/../model/PUPIL_ATTENDS_EVENT.php");
require_once(__DIR__."/../model/EVENT_model.php");

require_once(__DIR__."/../model/PERMISSION_model.php");

require_once(__DIR__."/../controller/BaseController.php");
/**
 * Class EventController
 *
 *
 */
class EventController extends BaseController {



    public function __construct() {
        parent::__construct();

        $this->EventMapper = new EventMapper();
        $this->view->setLayout("navbar");

    }

    public function  show(){
        $events = $this->EventMapper->show();
        $this->view->setVariable("eventstoshow", $events);
        $this->view->render("event", "show");
    }

    public function view(){
        $eventid = $this->EventMapper->getIdByName($_REQUEST["name"]);
        $event = $this->EventMapper->view($eventid);
        $this->view->setVariable("id_evento", $event);
        $this->view->render("event", "view");
    }

    public function add(){
        if (isset($_POST["submit"])) {
            //Creamos un obxecto evento baleiro
            $event = new Event();

            //Engadimos o id, aforo e descripción ao espazo
            $event->setEventname(htmlentities(addslashes($_POST["name"])));
            $event->setCapacity(htmlentities(addslashes($_POST['afor'])));
            $event->setCodProf(htmlentities(addslashes($_POST['dni_p'])));
            $event->setDate(htmlentities(addslashes($_POST['fecha'])));
            $event->setFinalHour(htmlentities(addslashes($_POST['hora_fin'])));
            $event->setInitialHour(htmlentities(addslashes($_POST['hora_ini'])));
            $event->setCodSpace(htmlentities(addslashes($_POST['id_espacio'])));

            try {
                if(!$this->EventMapper->EventNameExists(htmlentities(addslashes($_POST["name"])))){
                    $this->EventMapper->add($event);
                    //ENVIAR AVISO DE EVENTO ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_event_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos eventos)
                    $this->view->redirect("event", "show");
                } else {
                    $this->view->setFlash("event_already_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("event", "add");
    }

    public function edit(){
        if (isset($_POST["submit"])) {
            $ev = $this->EventMapper->view($_REQUEST['id_evento']);
            $ev->setCodEvent($_REQUEST['id_evento']);

            //Engadimos o novo id_espazo ao evento (se non deixamos o que ten)
            if(isset($_POST["newid_espacio"])&& addslashes($_POST['newid_espacio'])!=""){
                $ev->setCodSpace(htmlentities(addslashes($_POST["newid_espacio"])));
            }else{
                $af = $ev->getCodSpace();
                $ev->setCodSpace($af);
            }

            //Engadimos o novo nome do evento ao evento(se non deixamos o que ten)
            if(isset($_POST["newname"])&& addslashes($_POST['newname'])!=""){
                $ev->setEventname(htmlentities(addslashes($_POST["newname"])));
            }else{
                $af = $ev->getEventname();
                $ev->setEventname($af);
            }

            //Engadimos a nova fecha ao evento (se non deixamos o que ten)
            if(isset($_POST["newfecha"])&& addslashes($_POST['newfecha'])!=""){
                $ev->setDate(htmlentities(addslashes($_POST["newfecha"])));
            }else{
                $af = $ev->getDate();
                $ev->setDate($af);
            }

            //Engadimos a nova hora_ini ao evento (se non deixamos o que ten)
            if(isset($_POST["newhora_ini"])&& addslashes($_POST['newhora_ini'])!=""){
                $ev->setInitialHour(htmlentities(addslashes($_POST["newhora_ini"])));
            }else{
                $af = $ev->getInitialHour();
                $ev->setInitialHour($af);
            }

            //Engadimos a nova hora_fin ao evento (se non deixamos o que ten)
            if(isset($_POST["newhora_fin"])&& addslashes($_POST['newhora_fin'])!=""){
                $ev->setFinalHour(htmlentities(addslashes($_POST["newhora_fin"])));
            }else{
                $af = $ev->getFinalHour();
                $ev->setFinalHour($af);
            }

            //Engadimos o novo aforo ao evento (se non deixamos o que ten)
            if(isset($_POST["newafor"])&& addslashes($_POST['newafor'])!=""){
                $ev->setCapacity(htmlentities(addslashes($_POST["newafor"])));
            }else{
                $af = $ev->getCapacity();
                $ev->setCapacity($af);
            }

            //Engadimos o novo dni do profesor ao evento (se non deixamos o que ten)
            if(isset($_POST["newdni_p"])&& addslashes($_POST['newdni_p'])!=""){
                $ev->setCodProf(htmlentities(addslashes($_POST["newdni_p"])));
            }else{
                $des = $ev->getCodProf();
                $ev->setCodProf($des);
            }

            try {
                $this->EventMapper->edit($ev);
                //ENVIAR AVISO DE ESPAZO EDITADO!!!!!!!!!!
                $this->view->setFlash("succ_event_mod");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos eventos)
                $this->view->redirect("event", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("event", "edit");
    }

    public function delete(){
        try{
            if (isset($_GET['id_evento'])) {
                $this->EventMapper->delete($_GET["id_evento"]);
                $this->view->setFlash('succ_event_delete');
                $this->view->redirect("event", "show");
            }

        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("event", "show");

    }

    public function search(){
        if(isset($_POST["submit"])){
            $event = new Event();

            if(!empty($_POST["event_id"])){
                $event->setCodEvent(htmlentities(addslashes($_POST["event_id"])));
            }
            if(!empty($_POST['name'])){
                $event->setEventname(htmlentities(addslashes($_POST["name"])));
            }
            if(!empty($_POST["ini_hour"])){
                $event->setInitialHour(htmlentities(addslashes($_POST["ini_hour"])));
            }
            if(!empty($_POST["capacity"])){
                $event->setCapacity(htmlentities(addslashes($_POST["capacity"])));
            }
            if(!empty($_POST["fin_hour"])){
                $event->setFinalHour(htmlentities(addslashes($_POST["fin_hour"])));
            }
            if(!empty($_POST["space_id"])){
                $event->setCodSpace(htmlentities(addslashes($_POST["space_id"])));
            }
            if(!empty($_POST["date"])){
                $event->setDate(htmlentities(addslashes($_POST["date"])));
            }
            if(!empty($_POST["dni_prof"])){
                $event->setCodProf(htmlentities(addslashes($_POST["dni_prof"])));
            }

            $this->view->setVariable("eventstoshow", $this->EventMapper->search($event) );
            $this->view->render("event","show");
        }else{
            $this->view->render("event", "search");
        }
    }

    public function addpupil(){
        if (isset($_POST["submit"])) {
            $pupil = new Pupil_attends_event();

            $pupil->setCodEvent(htmlentities(addslashes($_POST['id_evento'])));
            $pupil->setCodStudent(htmlentities(addslashes($_POST['codpupil'])));

            try {
                if(!$this->EventMapper->pupilCodExists(htmlentities(addslashes($_POST["codpupil"])),htmlentities(addslashes($_POST['id_evento'])))){
                    $this->EventMapper->addpupil($pupil);
                    //ENVIAR AVISO DE ALUMNO ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_pupil_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos alumnos no evento)
                    $this->view->redirect("event", "show");
                } else {
                    $this->view->setFlash("student_already_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("event", "add_pupil");
    }

    public function showpupil(){
        $pupils = $this->EventMapper->showpupil();
        $this->view->setVariable("pupilstoshow", $pupils);
        $this->view->render("event", "show_pupil");
    }

    public function deletepupil(){
        try{
            if (isset($_GET['codpupil'])) {
                $this->EventMapper->deletepupil(htmlentities(addslashes($_GET["codpupil"])),htmlentities(addslashes($_GET["id_evento"])));
                $this->view->setFlash('succ_student_delete');
                $this->view->redirect("event", "show");
            }

        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("event", "show");

    }

}
