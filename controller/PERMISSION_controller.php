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
                $this->view->setFlash('msg_delete_correct');
                $this->view->redirect("permission", "show");
            }

        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("permission", "show");
    }

    public function show()
    {
        $permissions = $this->permissionMapper->show();
        $this->view->setVariable("permissions", $permissions);
        $this->view->render("permission", "show");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Permission baleiro
            $permission_id = $this->permissionMapper->getIdByName($_REQUEST["permission"]);
            $permission = $this->permissionMapper->view($permission_id);

            //Engadimos o novo contrasinal ao usuario se chega (se non deixamos o que ten)
            if (isset($_POST["newpass"]) && addslashes($_POST['newpass']) != "") {
                $permission->setPasswd(md5(htmlentities(addslashes($_POST["newpass"]))));
            } else {
                $pass = $this->view($permission_id)->getPasswd();
                $permission->setPasswd($pass);
            }

            //Engadimos o perfil
            $prof = htmlentities(addslashes($_POST["perf_id"]));
            $profile = $this->profileMapper->view($prof);
            //var_dump($profile);exit;
            $permission->setProfile($profile);

            $perms = array();
            //Engadimos os permisos do usuario (Non entran os do perfil)
            if (isset($_REQUEST["permissionperm"])) {

                $pm = new PermissionMapper();
                $ppm = new PermissionPermissionMapper();
                $permissionperms = $_REQUEST["permissionperm"];
                foreach ($permissionperms as $pp) {
                    array_push($perms, $pm->view($pp));
                }
            }

            $permission->setPermissions(new PermissionPermission($permission_id, $perms));

            try {
                $this->permissionMapper->edit($permission);
                //ENVIAR AVISO DE USUARIO EDITADO!!!!!!!!!!
                $this->view->setFlash("Usuario modificado correctamente!");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                $this->view->redirect("permission", "view", "permission=" . $permission->getPermissionname());
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("permission", "edit");
    }

    public function view()
    {
        $permissionid = $this->permissionMapper->getIdByName($_REQUEST["permission"]);
        $permission = $this->permissionMapper->view($permissionid);
        $this->view->setVariable("permission", $permission);
        $this->view->render("permission", "view");
    }
}
