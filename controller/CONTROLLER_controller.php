<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/CONTROLLER.php");
require_once(__DIR__."/../model/CONTROLLER_model.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class ControllersController
*
* Controller to login, logout and controller data managing
*/
class ControllerController extends BaseController {

	/**
	* Reference to the ControllerMapper to interact
	* with the database
	*
	* @var ControllerMapper
	*/
	private $controllerMapper;

	public function __construct() {
		parent::__construct();


		$this->controllerMapper = new ControllerMapper();

		// Controllers controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("navbar");
	}

	public function add(){

		if (isset($_POST["submit"])) {
            //Creamos un obxecto Controller baleiro
            $controller = new Controller();

			//Engadimos o usuario e o contrasinal ao usuario
			$controller->setControllername(htmlentities(addslashes($_POST["controllername"])));


			try {
				if(!$this->controllerMapper->controllernameExists($_POST["controllername"])){
                    //$controller->checkIsValidForCreate();
                    $this->controllerMapper->add($controller);
                    //ENVIAR AVISO DE CONTROLADOR ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_controller_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                    $this->view->redirect("controller", "show");
				} else {
					
					$this->view->setFlash("fail_controller_exists");
				}
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
				$this->view->setFlash("erro_general");
			}
		}

        //Se non se enviou nada
        $this->view->render("controller", "add");
	}

    public function delete(){
    		try{
    			if (isset($_GET['controller_id'])) {
    				$this->controllerMapper->delete($this->controllerMapper->getIdByName($_GET["controller_id"]));
					$this->view->setFlash('succ_controller_delete');
					$this->view->redirect("controller", "show");
    			}
				
			}catch (Exception $e) {
				$errors = $e->getErrors();
				$this->view->setVariable("errors", $errors);
				$this->view->setFlash("erro_general");
			}
			$this->view->render("controller", "show");	
    }

    public function  show(){
        $controllers = $this->controllerMapper->show();
        $this->view->setVariable("controllerstoshow", $controllers);
        $this->view->render("controller", "show");
    }

    public function view(){
		$controllerid = $this->controllerMapper->getIdByName($_REQUEST["controller"]);
        $controller = $this->controllerMapper->view($controllerid);
        $this->view->setVariable("controller", $controller);
        $this->view->render("controller", "view");
    }
	
	public function edit(){
		if (isset($_POST["submit"])) {
			//Creamos un obxecto Controller baleiro
			$controller_id = $this->controllerMapper->getIdByName($_GET['controllerName']);

			$controller = $this->controllerMapper->view($controller_id);

			//Engadimos os permisos do usuario (Non entran os do perfil)
			$controller->setControllername($_POST['newname']);


			try {
				$this->controllerMapper->edit($controller);
				$this->view->setFlash("succ_controller_edit");
				$this->view->redirect("controller", "show");
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
				$this->view->setFlash("erro_general");
			}
		}
		//Se non se enviou nada
		//$this->view->setLayout("navbar");
		$this->view->render("controller", "edit");
	}

	public function search(){
		if(isset($_POST["submit"])){
			$controller = new Controller();
			if(isset($_POST['controllername'])){
				$controller->setcontrollername((htmlentities(addslashes($_POST["controllername"]))));
			}

			if(isset($_POST["codcontroller"])){
				$controller->setCodcontroller(htmlentities(addslashes($_POST["codcontroller"])));
			}

			try {
				$this->view->setVariable("controllerstoshow", $this->controllerMapper->search($controller));
			} catch (Exception $e) {
				$this->view->setFlash("erro_general");
                $this->view->redirect("controller", "show");
			}
			
			$this->view->render("controller","show");
		}else{
			$this->view->render("controller", "search");
		}

	}
}
