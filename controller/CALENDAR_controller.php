<?php

require_once(__DIR__."/../core/ViewManager.php");


require_once(__DIR__."/../model/USER.php");
require_once(__DIR__."/../model/USER_model.php");
require_once(__DIR__."/../model/SESSION_model.php");
require_once(__DIR__."/../model/WORKDAY_model.php");
require_once(__DIR__."/../model/SCHEDULE_model.php");
require_once(__DIR__."/../model/EVENT_model.php");

require_once(__DIR__."/../controller/BaseController.php");


class CalendarController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;
	private $sessionMapper;
	private $scheduleMapper;
	private $eventMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();
		$this->sessionMapper = new SessionMapper();
		$this->workdayMapper = new WorkdayMapper();
		$this->scheduleMapper = new ScheduleMapper();
		$this->eventMapper = new EventMapper();
		$this->view->setLayout("navbar");
	}

	public function index()
	{
		$this->view->setVariable('currentperms', $this->userPerms);
		$this->view->render('calendar', 'placeholder');
	}

	public function home(){
		$this->view->setVariable("events", $this->eventMapper->show());
		$this->view->setVariable("schedules", $this->scheduleMapper->show());
		$this->view->setVariable("scheduledata", $this->sessionMapper->show());
		$this->view->render("calendar", "home");
	}

}
