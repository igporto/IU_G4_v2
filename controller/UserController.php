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
		$this->view->setLayout("login");
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

		//if the user is already logged in, it is redirected to the home page
		if(isset($_SESSION['currentuser']))
		{
			// send user to the restricted area (HTTP 302 code)
				$this->view->redirect("calendar", "index");
		}

		if (isset($_POST["userName"])){ // reaching via HTTP Post...
			//process login form
			if ($this->userMapper->isValidUser($_POST["userName"],  $_POST["password"])) {

				$_SESSION["currentuser"]=$_POST["userName"];

				// send user to the restricted area (HTTP 302 code)
				$this->view->redirect("calendar", "index");

			}else{
				$errors = array();
				$errors["userNotValid"] = 'Usuario ou Contrasinal incorrecto';
				$this->view->setVariable("errors", $errors);

			}
		}

		// render the view (/view/user/login.php)
		$this->view->render("user", "login");
	}

	

	/**
	* Action to logout
	*
	* This action should be called via GET
	*
	* No HTTP parameters are needed.
	*
	* The views are:
	* <ul>
	* <li>users/login (via redirect)</li>
	* </ul>
	*
	* @return void
	*/
	public function logout() {
		session_destroy();

		//redirect to login
		$this->view->redirect("user", "login");

	}

}
