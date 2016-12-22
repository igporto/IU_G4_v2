<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/PERMISSION.php");
require_once(__DIR__ . "/../model/PERMISSION_model.php");

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
    private $profileMapper;

    public function __construct()
    {
        parent::__construct();


        $this->permissionMapper = new PermissionMapper();

        // Permissions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    /**
     * Action to login
     *
     * Logins a permission checking its creedentials agains
     * the database
     *
     * When called via GET, it shows the login form
     * When called via POST, it tries to login
     * @return void
     */
    public function login()
    {

        if (isset($_POST["permissionName"])) {
            //process login form
            if ($this->permissionMapper->isValidPermission($_POST["permissionName"], $_POST["password"])) {

                $_SESSION["currentpermission"] = $_POST["permissionName"];

            } else {
                $errors = array();
                $errors["permissionNotValid"] = 'Usuario ou Contrasinal incorrecto';

                $this->view->setVariable("errors", $errors);
            }
        }

        //if the permission is already logged in, it is redirected to the home page
        if (!isset($_SESSION['currentpermission'])) {
            $this->view->setLayout("login");
            $this->view->render("permission", "login");
        } else {
            $this->view->setVariable('currentperms', $this->getCurrentPermissionPerms());
            $this->view->render("calendar", "placeholder");
        }

    }

    //devolve un array de Permiso, que son os permisos de usuario+perfil do usuario $_SESSION['currentpermission']
    public function getCurrentPermissionPerms()
    {
        //obtén o obxecto usuario
        $cu = $this->permissionMapper->view($this->permissionMapper->getIdByName($_SESSION['currentpermission']));
        //$this->helper->toConsole(var_dump($cu));

        $perms = array();

        //obtemos os permisos do perfil e metémolos en $perms
        if ($cu->getProfile()->getPermissions() != NULL) {

            foreach ($cu->getProfile()->getPermissions() as $perm) {
                array_push($perms, $perm);
            }
        }

        //obtemos os permisos propios do usuario e metémolos en $perms
        if ($cu->getPermissions()->getPermissionPermissions() != NULL) {
            foreach ($cu->getPermissions()->getPermissionPermissions() as $perm) {
                array_push($perms, $perm);
            }
        }

        //devolvemos o array de permisos do usuario actual
        return array_unique($perms);
    }

    //cerra sesión e redirecciona a login
    public function logout()
    {
        session_destroy();

        //redirecciona o login
        $this->view->redirect("permission", "login");

    }

    public function add()
    {

        if (isset($_POST["submit"])) {
            //Creamos un obxecto Permission baleiro
            $permission = new Permission();

            //Engadimos o usuario e o contrasinal ao usuario
            $permission->setPermissionname(htmlentities(addslashes($_POST["permissionname"])));
            $permission->setPasswd(md5(htmlentities(addslashes($_POST["password"]))));

            //Engadimos o perfil

            $profile = $this->profileMapper->view(htmlentities(addslashes($_POST["profile"])));
            $permission->setProfile($profile);

            //Engadimos os permisos do usuario (Non entran os do perfil)
            $permission->setPermissions(new PermissionPermission());

            try {
                if (!$this->permissionMapper->permissionnameExists(htmlentities(addslashes($_POST["permissionname"])))) {
                    $this->permissionMapper->add($permission);
                    //ENVIAR AVISO DE USUARIO ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("Usuario creado correctamente!");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                    $this->view->redirect("permission", "show");
                } else {
                    $errors = array();
                    $errors["general"] = "Permissionname already exists";
                    $this->view->setVariable("errors", $errors);
                    $this->view->setFlash("permission_already_exists");
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("permission", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['permission'])) {
                $this->permissionMapper->delete($this->permissionMapper->getIdByName($_GET["permission"]));
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
