<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../model/PHYSIO.php");
require_once(__DIR__ . "/../model/PHYSIO_model.php");
require_once(__DIR__ . "/../model/RESERVE.php");
require_once(__DIR__ . "/../model/RESERVE_model.php");
require_once(__DIR__ . "/../controller/BaseController.php");
/**
 * Class ActionsController
 *
 * Controller to login, logout and action data managing
 */
class PhysioController extends BaseController
{
    private $physioMapper;
    private $reserveMapper;

    public function __construct()
    {
        parent::__construct();
        $this->physioMapper = new PhysioMapper();
        $this->reserveMapper = new ReserveMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }
    public function add()
    {
        if(isset($_POST["submit"])){
            //Creamos un obxecto physio baleiro
            $physio = new Physio();
            //Engadimos os datos ao obxecto physio
            if(isset($_POST['reserve'])){
                if($_POST['reserve'] !=NULL){
                    $physio->setReserve($this->reserveMapper->view($_POST["reserve"]));
                }else{
                    $physio->setReserve(new Reserve());
                }
            }
            if(isset($_POST['date'])){
                $physio->setDate($_POST["date"]);
            }
            if(isset($_POST['startTime'])){
                $physio->setStartTime($_POST["startTime"]);
            }
            if(isset($_POST['endTime'])){
                $physio->setEndTime($_POST["endTime"]);
            }
            try {
                if($physio->getStartTime() < $physio->getEndTime()){
                    if($this->physioMapper->validDate($physio->getDate()) ){
                        $this->physioMapper->add($physio);
                        $this->view->setFlash('succ_physio_add');
                        $this->view->redirect('physio', 'show');
                    }else{
                        $this->view->setFlash("fail_date_incorrect");
                    }
                }else{
                    $this->view->setFlash("fail_data_ini_fin_incorrect");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("physio", "add");
    }
    public function delete()
    {
        try {
            if (isset($_GET['codphysio'])) {
                $this->physioMapper->delete(htmlentities(addslashes($_GET['codphysio'])));
                $this->view->setFlash('succ_physio_delete');
                $this->view->redirect("physio", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("physio", "show");
    }
    public function show()
    {
        $physios = $this->physioMapper->show();
        $this->view->setVariable("physiostoshow", $physios);
        $this->view->render("physio", "show");
    }
    public function view()
    {
        $physio = $this->physioMapper->view(htmlentities(addslashes($_REQUEST["codPhysio"])));
        $this->view->setVariable("physio", $physio);
        $this->view->render("physio", "view");
    }
    public function edit()
    {
        if (isset($_POST["submit"])) {
            //creamos un obxecto actividade cos datos da actividade a editar
            $physio = $this->physioMapper->view($_GET["codPhysio"]);
            if(isset($_POST['reserve'])){
                if($_POST['reserve'] != NULL){
                    $physio->setReserve($this->reserveMapper->view($_POST["reserve"]));
                }else{
                    $physio->setReserve(new Reserve());
                }
            }
            if(isset($_POST['date'])){
                $physio->setDate($_POST["date"]);
            }
            if(isset($_POST['startTime'])){
                $physio->setStartTime($_POST["startTime"]);
            }
            if(isset($_POST['endTime'])){
                $physio->setEndTime($_POST["endTime"]);
            }
            try {
                if($physio->getStartTime() < $physio->getEndTime()){
                    if($this->physioMapper->validDate($physio->getDate()) ) {
                        $this->physioMapper->edit($physio);
                        $this->view->setFlash("succ_physio_edit");
                        $this->view->redirect("physio", "show");
                    }else{
                        $this->view->setFlash("fail_date_incorrect");
                    }
                }else{
                    $this->view->setFlash("fail_data_ini_fin_incorrect");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("physio", "edit");
    }
    public function search(){
        if(isset($_POST["submit"])){
            $physio = new Physio();
            //Comprobamos os datos que nos chegan e engadimolos ao obxecto $physio
            if(isset($_POST['codPhysio']) && $_POST['codPhysio']!= ""){
                $physio->setcodPhysio((htmlentities(addslashes($_POST["codPhysio"]))));
            }
            if(isset($_POST['useres']) && isset($_POST['reserve'])){
                $physio->setReserve($this->reserveMapper->view($_POST["reserve"]));
            }else{
                $aux = new Reserve();
                $aux->setCodReserve("");
                $physio->setReserve($aux);
            }
            if(isset($_POST['date']) && $_POST['date']){
                $physio->setDate((htmlentities(addslashes($_POST["date"]))));
            }
            if(isset($_POST['startTime']) && $_POST['startTime']){
                $activity->setStartTime((htmlentities(addslashes($_POST["startTime"]))));
            }
            if(isset($_POST['endTime']) && $_POST['endTime']){
                $activity->setEndTime((htmlentities(addslashes($_POST["endTime"]))));
            }
            try {
                $this->view->setVariable("physiostoshow", $this->physioMapper->search($physio));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("physio", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("physio","show");
        }else{
            $this->view->render("physio", "search");
        }
    }
}