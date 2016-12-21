<?php
require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PROFILE_model.php");

require_once(__DIR__."/../controller/BaseController.php");


class ProfileController extends BaseController {

    private $profileMapper;
    private $permissionMapper;

    public function __construct() {
        parent::__construct();

        $this->profileMapper = new ProfileMapper();
        $this->permissionMapper = new PermissionMapper();

        $this->view->setLayout("navbar");
    }

    public function add(){

        if (isset($_POST["submit"])) {
            //Creamos un obxecto Profile baleiro
            $profile = new Profile();

            //Engadimos o nome ao perfil
            $profile->setProfilename(htmlentities(addslashes($_POST["profilename"])));


            //Engadimos os permisos ao perfil
            if(isset($_REQUEST["profileperm"])){

                $pm = new PermissionMapper();
                $upm= new UserPermissionMapper();
                $profileperms = $_REQUEST["userperm"];
                foreach ($profileperms as $pp){
                    array_push($perms, $pm->view($pp));
                }
            }

            $profile->setPermissions($perms);

            try {
                if(!$this->profileMapper->profilenameExists(htmlentities(addslashes($_POST["username"])))){
                    $this->profileMapper->add($profile);
                    //ENVIAR AVISO DE PERFIL ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("Perfil creado correctamente!");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                    $this->view->redirect("profile", "show");
                } else {
                    $errors = array();
                    $errors["general"] = "Profile already exists";
                    $this->view->setVariable("errors", $errors);
                    $this->view->setFlash("profile_already_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("profile", "add");
    }

    public function delete(){
        try{
            if (isset($_GET['user'])) {
                $this->userMapper->delete($this->userMapper->getIdByName($_GET["user"]));
                $this->view->setFlash('msg_delete_correct');
                $this->view->redirect("user", "show");
            }

        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("user", "show");
    }

    public function  show(){
        $users = $this->userMapper->show();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "show");
    }

    public function view(){
        $userid = $this->userMapper->getIdByName($_REQUEST["user"]);
        $user = $this->userMapper->view($userid);
        $this->view->setVariable("user", $user);
        $this->view->render("user", "view");
    }

    public function edit(){
        if (isset($_POST["submit"])) {
            //Creamos un obxecto User baleiro
            $user_id = $this->userMapper->getIdByName($_REQUEST["user"]);
            $user = $this->userMapper->view($user_id);

            //Engadimos o novo contrasinal ao usuario se chega (se non deixamos o que ten)
            if(isset($_POST["newpass"])){
                $user->setPasswd(md5(htmlentities(addslashes($_POST["newpass"]))));
            }else{
                $pass = $this->view($user_id)->getPasswd();
                $user->setPasswd($pass);
            }

            //Engadimos o perfil
            $prof = htmlentities(addslashes($_POST["perf_id"]));
            $profile = $this->profileMapper->view($prof);
            //var_dump($profile);exit;
            $user->setProfile($profile);

            $perms = array();
            //Engadimos os permisos do usuario (Non entran os do perfil)
            if(isset($_REQUEST["userperm"])){

                $pm = new PermissionMapper();
                $upm= new UserPermissionMapper();
                $userperms = $_REQUEST["userperm"];
                foreach ($userperms as $up){
                    array_push($perms, $pm->view($up));
                }
            }

            $user->setPermissions(new UserPermission($user_id, $perms));

            try {
                $this->userMapper->edit($user);
                //ENVIAR AVISO DE USUARIO EDITADO!!!!!!!!!!
                $this->view->setFlash("Usuario modificado correctamente!");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                $this->view->redirect("user", "view", "user=".$user->getUsername());
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("user", "edit");
    }
}
