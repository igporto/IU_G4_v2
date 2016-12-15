<?php

require_once(__DIR__."/../core/ViewManager.php");


require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class CalendarController extends BaseController {

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
		$this->view->setLayout("navbar");
	}

	public function index()
	{
		$this->view->setVariable('currentperms', $this->userPerms);
		$this->view->render('calendar', 'placeholder');
	}

}
