<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/PERMISSION.php");
require_once(__DIR__ . "/../model/PERMISSION_model.php");
require_once(__DIR__ . "/../model/CONTROLLER_model.php");
require_once(__DIR__ . "/../model/ACTION_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");

/**
 * Class PermissionsController
 *
 * Controller to login, logout and permission data managing
 */
class PermissionController extends BaseController
{

    /**
     * Reference to the PermissionMapper to interact
     * with the database
     *
     * @var PermissionMapper
     */
    private $permissionMapper;
    private $actionMapper;
    private $controllerMapper;
    

    public function __construct()
    {
        parent::__construct();


        $this->permissionMapper = new PermissionMapper();
        $this->actionMapper = new ActionMapper();
        $this->controllerMapper = new ControllerMapper();

        // Permissions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Permission baleiro e "seteamos o controlador do mesmo"
            $permission = new Permission();
            $codcontroller = htmlentities(addslashes($_POST["controller_id"]));

            if(isset($_POST["actions"])){
                $actions = $_POST["actions"];
                $permission->setController($this->controllerMapper->view($codcontroller));

                //Variable que nos di que todo va benne
                $flag = false;
                try {
                    foreach ($actions as $action) {
                        //Engadimos accion e permiso
                        $permission->setAction($this->actionMapper->view($action));
                        //Comprobamos se existe ese permiso se non, creamolo
                        if (!$this->permissionMapper->permissionExists($permission)) {
                            $this->permissionMapper->add($permission);
                            $flag = true;
                        }
                    }
                    if($flag) {
                        //ENVIAR AVISO DE PERMISO ENGADIDO!!!!!!!!!!
                        $this->view->setFlash('succ_perm_add');
                        //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                        $this->view->redirect("permission", "show");
                    }else {
                        $errors = array();
                        $errors["general"] = "Permissionname already exists";
                        $this->view->setVariable("errors", $errors);
                        $this->view->setFlash("permission_already_exists");
                    }
                } catch (ValidationException $ex) {
                    $errors = $ex->getErrors();
                    $this->view->setVariable("errors", $errors);
                }
            }else{
                $this->view->setFlash('erro_no_add');
                $this->view->redirect("permission", "show");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("permission", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['perm_id'])) {
                $this->permissionMapper->delete(htmlentities(addslashes($_GET["perm_id"])));
                $this->view->setFlash('succ_perm_delete');
                $this->view->redirect("permission", "show");
            }

        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
            $this->view->setFlash("erro_general");
        }
        $this->view->render("permission", "show");
    }

    public function show()
    {
        $permissions = $this->permissionMapper->show();
        $this->view->setVariable("permissionstoshow", $permissions);
        $this->view->render("permission", "show");
    }

    public function view()
    {
        $permissionid = htmlentities(addslashes($_REQUEST["perm_id"]));
        $permission = $this->permissionMapper->view($permissionid);
        $this->view->setVariable("permission", $permission);
        $this->view->render("permission", "view");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $permission = new Permission();

            if (isset($_POST['codpermission'])) {
                $permission->setCodpermission($_POST['codpermission']);
            }

            if(isset($_POST["actionname"])){
                $permission->setAction(
                    $this->actionMapper->view($_POST["actionname"])
                    );
            }

           
            if(isset($_POST["controllername"])){
                $permission->setController(
                    $this->controllerMapper->view($_POST["controllername"])
                    );
            }


            $this->view->setVariable("permissionstoshow", $this->permissionMapper->search($permission));
            $this->view->setFlash('succ_perm_search');
            $this->view->render("permission","show");
        }else{
            $this->view->render("permission", "search");
        }
    }
}
