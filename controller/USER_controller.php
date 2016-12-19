<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/USER.php");
require_once(__DIR__."/../model/USER_model.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user data managing
*/
class UserController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;
	private $profileMapper;

	public function __construct() {
		parent::__construct();


		$this->userMapper = new UserMapper();
        $this->profileMapper = new ProfileMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("navbar");
	}

	/**
	* Action to login
	*
	* Logins a user checking its creedentials agains
	* the database
	*
	* When called via GET, it shows the login form
	* When called via POST, it tries to login
	* @return void
	*/
	public function login() {

		if (isset($_POST["userName"])){ 
			//process login form
			if ($this->userMapper->isValidUser($_POST["userName"],  $_POST["password"])) {

				$_SESSION["currentuser"]=$_POST["userName"];

				

			}else{
				$errors = array();
				$errors["userNotValid"] = 'Usuario ou Contrasinal incorrecto';

				$this->view->setVariable("errors", $errors);

			}


		}

				//if the user is already logged in, it is redirected to the home page
		if(!isset($_SESSION['currentuser']))
		{
			$this->view->setLayout("login");
			$this->view->render("user", "login");
		}
		else {
			$this->view->setVariable('currentperms', $this->getCurrentUserPerms());
			$this->view->render("calendar", "placeholder");
		}
		
	}

	//devolve un array de Permiso, que son os permisos de usuario+perfil do usuario $_SESSION['currentuser']
	public function getCurrentUserPerms()
	{
		//obtén o obxecto usuario
		$cu = $this->userMapper->view($this->userMapper->getIdByName($_SESSION['currentuser']));
		//$this->helper->toConsole(var_dump($cu));

		$perms = array();

		if($cu->getPermissions()->getUserPermissions() !=NULL) {
			foreach ($cu->getPermissions()->getUserPermissions() as $perm) {
				array_push($perms, $perm);
			}
		}

		//obtemos os permisos do perfil e metémolos en $perms
		if($cu->getProfile()->getPermissions() != NULL) {

			foreach ($cu->getProfile()->getPermissions() as $perm) {
				array_push($perms, $perm);
			}
		}


		//devolvemos o array de permisos do usuario actual
		return array_unique($perms);


	}

	

	//cerra sesión e redirecciona a login
	public function logout() {
		session_destroy();

		//redirecciona o login
		$this->view->redirect("user", "login");

	}

	public function add(){


		if (isset($_POST["submit"])) {
            //Creamos un obxecto User baleiro
            $user = new User();

			//Engadimos o usuario e o contrasinal ao usuario
			$user->setUsername(htmlentities(addslashes($_POST["username"])));
			$user->setPasswd(md5(htmlentities(addslashes($_POST["password"]))));

			//Engadimos o perfil

            $profile = $this->profileMapper->view(htmlentities(addslashes($_POST["profile"])));
			$user->setProfile($profile);

			//Engadimos os permisos do usuario (Non entran os do perfil)
			$user->setPermissions(new UserPermission());

			try {
				if(!$this->userMapper->usernameExists($_POST["username"])){
                    $user->checkIsValidForCreate();
                    $this->userMapper->add($user);
                    //ENVIAR AVISO DE USUARIO ENGADIDO!!!!!!!!!!
                    /////////CODIGO AQUI!!!!!/////////////////////////

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos usuarios)
                    $this->view->redirect("user", "show");
				} else {
					$errors = array();
					$errors["general"] = "Username already exists";
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("user", "add");
	}

    public function delete(){
        try{
            $this->userMapper->delete($_POST["user"]);
        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
    }

    public function  show(){
        $users = $this->userMapper->show();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "show");
    }

    public function view(){
        $user = $this->userMapper->view($_POST["user"]);
        $this->view->setVariable("user", $user);
        $this->view->render("user", "view");
    }
}
