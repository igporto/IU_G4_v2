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

            $perms = array();
            //Engadimos os permisos ao perfil
            if(isset($_REQUEST["profileperm"])){
                $pm = new PermissionMapper();
                $profileperms = $_REQUEST["profileperm"];
                foreach ($profileperms as $p){
                    array_push($perms, $pm->view($p));
                }
            }

            $profile->setPermissions($perms);

            try {
                if(!$this->profileMapper->profilenameExists(htmlentities(addslashes($_POST["profilename"])))){
                    $this->profileMapper->add($profile);
                    //ENVIAR AVISO DE PERFIL ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_profile_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                    $this->view->redirect("profile", "show");
                } else {
                    $this->view->setFlash("fail_profile_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("profile", "add");
    }

    public function delete(){
        try{
            if (isset($_GET["profile_id"])) {
                $this->profileMapper->delete(htmlentities(addslashes($_GET["profile_id"])));
                $this->view->setFlash('succ_profile_delete');
                $this->view->redirect("profile", "show");
            }

        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
            $this->view->setFlash("erro_general");
        }
        $this->view->render("profile", "show");
    }

    public function  show(){
        $profiles = $this->profileMapper->show();
        $this->view->setVariable("profilestoshow", $profiles);
        $this->view->render("profile", "show");
    }

    public function view(){
        $profile = $this->profileMapper->view($_REQUEST["profile_id"]);
        $this->view->setVariable("profile", $profile);
        $this->view->render("profile", "view");
    }

    public function edit(){
        if (isset($_POST["submit"])) {

            //Creamos un obxecto Profile baleiro
            $profile_id = htmlentities(addslashes($_REQUEST["profile_id"]));
            $profile = $this->profileMapper->view($profile_id);

            //Engadimos o novo nome ao perfil se chega (se non deixamos o que ten)
            if(isset($_POST["newname"]) && $_POST["newname"] != ""){
                //se o nome xa existe abórtase o edit
                if ($this->profileMapper->profilenameExists($_POST["newname"])) {
                    $this->view->setFlash("fail_profile_exists");
                    $this->view->redirect("profile", "edit","profile_id=".$_REQUEST['profile_id']);
                }

                $profile->setProfilename(htmlentities(addslashes($_POST["newname"])));
            }else{
                $name = $profile->getProfilename();
                $profile->setProfilename($name);
            }

            $perms = array();
            //Engadimos os permisos ao perfil
            if(isset($_REQUEST["profileperm"])){
                $pm = new PermissionMapper();
                $profileperms = $_REQUEST["profileperm"];
                foreach ($profileperms as $up){
                    array_push($perms, $pm->view($up));
                }
            }

            $profile->setPermissions($perms);

            try {
                $this->profileMapper->edit($profile);
                //ENVIAR AVISO DE USUARIO EDITADO!!!!!!!!!!
                $this->view->setFlash("succ_profile_edit");
                //REDIRECCION Á PAXINA
                $this->view->redirect("profile", "show");
            }catch(ValidationException $ex) {
                $this->view->setVariable("errors", $errors);
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("profile", "edit");
    }

    public function search(){
        //se ven do show, mostra formulario; senón procesa e manda ó show co resultado
        if(isset($_POST["submit"])){
            $profile = new Profile();

            //se non se enviou nada no formulario, avisa e devolve ó formulario
            if (isset($_POST["profilename"]) 
                    && empty($_POST["profilename"]) 
                        && !isset($_POST["profileperm"])) 
            {
                //aviso de formulario vacío
                $this->view->setFlash("erro_nothing_to_search");
                $this->view->redirect("profile","search");
            }
            else{

                if (isset($_POST["profilename"])) {
                if (!empty($_POST["profilename"])) {
                    $profile->setProfilename($_POST["profilename"]);
                    $profile->setCodprofile(
                                $this->profileMapper->getIdByName($_POST["profilename"])
                            );
                    }
                    
                }


                if (isset($_POST["profileperm"])) {

                    $permis = array();
                    foreach ($_POST["profileperm"] as $perm) {
                        //obten o obxeto permiso e méteo en $permis
                        array_push($permis, $this->permissionMapper->view($perm));
                    }
                    $profile->setPermissions($permis);
                }


                try {
                    $this->view->setVariable("profilestoshow", $this->profileMapper->search($profile));
                } catch (Exception $e) {
                    $this->view->setFlash("erro_general"); 
                }
                
                $this->view->render("profile","show");
            }
            
        }else{
            $this->view->render("profile", "search");
        }
    }
}
