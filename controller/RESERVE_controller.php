<?php
	require_once(__DIR__ ."/../controller/BaseController.php");
	require_once(__DIR__ . "/../model/SPACE.php");
	require_once(__DIR__ . "/../model/SPACE_model.php");
	//FALTABAN LOS DE RESERVE
	require_once(__DIR__ . "/../model/RESERVE.php");
	require_once(__DIR__ . "/../model/RESERVE_model.php");
	//
	require_once(__DIR__ . "/../model/SERVICE.php");
	require_once(__DIR__ . "/../model/SERVICE_model.php");
	require_once(__DIR__ . "/../model/ALUMN.php");
	require_once(__DIR__ . "/../model/ALUMN_model.php");
    require_once(__DIR__ ."/../core/ViewManager.php");

	class ReserveController extends BaseController
	{
    private $reserveMapper;
    private $spaceMapper;
    private $serviceMapper;
    private $alumnMapper;

    public function __construct()
    {
        parent::__construct();
        $this->reserveMapper = new ReserveMapper();
        $this->spaceMapper = new SpaceMapper();
        $this->serviceMapper = new ServiceMapper();
        $this->alumnMapper = new AlumnMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }
    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto reserve baleiro
            $reserve = new Reserve();
            //Engadimos os datos ao obxecto reserve
            if(isset($_POST['space'])){
                if($_POST['space'] !=NULL){
                    $reserve->setSpace($this->spaceMapper->view($_POST["space"]));
                }else{
                    $reserve->setSpace(new Space());
                }
            }
            if(isset($_POST['service'])){
                if($_POST['service'] !=NULL){
                    $reserve->setService($this->serviceMapper->view($_POST["service"]));
                }else{
                    $reserve->setService(new Service());
                }
            }
            if(isset($_POST['alumn'])){
                if($_POST['alumn'] !=NULL){
                    $reserve->setAlumn($this->alumnMapper->view($_POST["alumn"]));
                }else{
                    $reserve->setAlumn(new Alumn());
                }
            }
            if(isset($_POST['date'])){
                $reserve->setDate($_POST["date"]);
            }
            if(isset($_POST['startTime'])){
                $reserve->setStartTime($_POST["startTime"]);
            }
            if(isset($_POST['endTime'])){
                $reserve->setEndTime($_POST["endTime"]);
            }
            if(isset($_POST['spacePrice'])){
                $reserve->setSpacePrice($_POST["spacePrice"]);
            }
            if(isset($_POST['physioPrice'])){
                $reserve->setPhysioPrice($_POST["physioPrice"]);
            }
            try {
                    $this->reserveMapper->add($reserve);
                    //ENVIAR AVISO DE INSCRIPCION ENGADIDA!!!!!!!!!!
                    $this->view->setFlash('succ_reserve_add');
                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das inscricións)
                    $this->view->redirect("reserve", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("reserve", "add");
    }
    public function delete()
    {
        try {
            if (isset($_GET['codReserve'])) {
                $this->reserveMapper->delete(htmlentities(addslashes($_GET['codReserve'])));
                $this->view->setFlash('succ_reserve_delete');
                $this->view->redirect("reserve", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("reserve", "show");
    }
    public function show()
    {
        $reserves = $this->reserveMapper->show();
        $this->view->setVariable("reservestoshow", $reserves);
        $this->view->render("reserve", "show");
    }
    public function view()
    {
        $reserve = $this->reserveMapper->view(htmlentities(addslashes($_REQUEST["codReserve"])));
        $this->view->setVariable("reserve", $reserve);
        $this->view->render("reserve", "view");
    }
    public function edit()
    {
        if (isset($_POST["submit"])) {
            //creamos un obxecto actividade cos datos da actividade a editar
            $reserve = $this->reserveMapper->view($_GET["codReserve"]);
            if(isset($_POST['space'])){
                if($_POST['space'] != NULL){
                    $reserve->setSpace($this->spaceMapper->view($_POST["space"]));
                }else{
                    $reserve->setSpace(new Space());
                }
            }
            if(isset($_POST['service'])){
                if($_POST['service'] != NULL){
                    $reserve->setService($this->serviceMapper->view($_POST["service"]));
                }else{
                    $reserve->setService(new Service());
                }
            }
            if(isset($_POST['alumn'])){
                if($_POST['alumn'] != NULL){
                    $reserve->setAlumn($this->alumnMapper->view($_POST["alumn"]));
                }else{
                    $reserve->setAlumn(new Alumn());
                }
            }            
            if(isset($_POST['date'])){
                $reserve->setDate($_POST["date"]);
            }
            if(isset($_POST['startTime'])){
                $reserve->setStartTime($_POST["startTime"]);
            }
            if(isset($_POST['endTime'])){
                $reserve->setEndTime($_POST["endTime"]);
            }
            if(isset($_POST['spacePrice'])){
                $reserve->setSpacePrice($_POST["spacePrice"]);
            }
            if(isset($_POST['physioPrice'])){
                $reserve->setPhysioPrice($_POST["physioPrice"]);
            }                                                
            try {
                //ENVIAR AVISO DE INSCRIPCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_registration_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das INSCRIPCIONS)
                $this->view->redirect("reserve", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("reserve", "edit");
    }
    public function search()
    {
        if(isset($_POST["submit"])){
            $reserve = new Reserve();
            //Comprobamos os datos que nos chegan e engadimolos ao obxecto $reserve
            if(isset($_POST['codReserve']) && $_POST['codReserve']!= ""){
                $reserve->setCodReserve((htmlentities(addslashes($_POST["codReserve"]))));
            }
            if(isset($_POST['usespa']) && isset($_POST['space'])){
                $reserve->setSpace($this->spaceMapper->view($_POST["space"]));
            }else{
                $aux = new Space();
                $aux->setCodspace("");
                $reserve->setSpace($aux);
            }
            if(isset($_POST['useser']) && isset($_POST['service'])) {
                $reserve->setService($this->serviceMapper->view($_POST["service"]));
            }else {
                $aux = new Service();
                $aux->setId("");
                $reserve->setService($aux);
            }
            if(isset($_POST['usealu']) && isset($_POST['alumn'])) {
                $reserve->setAlumn($this->alumnMapper->view($_POST["alumn"]));
            }else {
                $aux = new Alumn();
                $aux->setCodalumn("");
                $reserve->setAlumn($aux);
            }
            if(isset($_POST['date']) && $_POST['date']){
                $reserve->setDate((htmlentities(addslashes($_POST["date"]))));
            }
            if(isset($_POST['startTime']) && $_POST['startTime']){
                $reserve->setStartTime((htmlentities(addslashes($_POST["startTime"]))));
            }
            if(isset($_POST['endTime']) && $_POST['endTime']){
                $reserve->setEndTime((htmlentities(addslashes($_POST["endTime"]))));
            }
            if(isset($_POST['spacePrice']) && $_POST['spacePrice']){
                $reserve->setSpacePrice((htmlentities(addslashes($_POST["spacePrice"]))));
            }
            if(isset($_POST['physioPrice']) && $_POST['physioPrice']){
                $reserve->setPhysioPrice((htmlentities(addslashes($_POST["physioPrice"]))));
            }
            try {
                $this->view->setVariable("reservestoshow", $this->reserveMapper->search($reserve));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("reserve", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("reserve","show");
        }else{
            $this->view->render("reserve", "search");
        }
    }
}
?>