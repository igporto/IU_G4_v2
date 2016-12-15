<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

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
	

	public function __construct() {
		parent::__construct();


		$this->userMapper = new UserMapper();

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

				//setteamos a variable da vista 'currentperms' a un array de permisos do user actual
				$this->view->setVariable('currentperms', $this->getCurrentUserPerms());

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

		foreach ($cu->getPermissions()->getUserPermissions() as $perm) {
			array_push($perms, $perm);
		}

		//obtemos os permisos do perfil e metémolos en $perms
		foreach ($cu->getProfile()->getPermissions() as $perm) {
			array_push($perms, $perm);
		}


		//devolvemos o array de permisos do usuario actual
		return $perms;


	}

	

	//cerra sesión e redirecciona a login
	public function logout() {
		session_destroy();

		//redirecciona o login
		$this->view->redirect("user", "login");

	}

}
