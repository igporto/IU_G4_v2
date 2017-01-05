<?php

require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/SCHEDULE_model.php");
require_once(__DIR__."/../model/HOUR_model.php");
require_once(__DIR__."/../model/WORKDAY_model.php");


class ScheduleController extends BaseController {

	private $userMapper;
	private $hourMapper;
	private $workdayMapper;

	public function __construct() {
		parent::__construct();

		$this->scheduleMapper = new ScheduleMapper();
        $this->hourMapper = new HourMapper();
        $this->workdayMapper = new WorkdayMapper();

		$this->view->setLayout("navbar");
	}

	public function add(){

		if (isset($_POST["submit"])) {
            $schedule = new Schedule();

			$schedule->setSchedulename(htmlentities(addslashes($_POST["name"])));

			//comproba se que a data de inicio<data de fin
			if (isset($_POST["datestart"]) && isset($_POST["dateend"])) {
				$datestart = $_POST["datestart"];
				$dateend = $_POST["dateend"];

				if ($this->scheduleMapper->isValidDate($datestart,$dateend)) {
					$schedule->setDateStart($datestart);
					$schedule->setDateEnd($dateend);
				}else{
					$this->view->setFlash("fail_date_interval");
					$this->view->redirect("schedule", "add");
				}	

				if (!$this->scheduleMapper->isValidSchedule($schedule)) {
					$this->view->setFlash("fail_schedule_overlap");
                    $this->view->redirect("schedule", "add");		
				}		
			}

			try {
				if(!$this->scheduleMapper->scheduleNameExists($schedule->getSchedulename())){
                    $this->scheduleMapper->add($schedule);

                    $this->view->setFlash("succ_schedule_add");
                    $this->view->redirect("schedule", "show");
				} else {
					$this->view->setFlash("fail_schedule_name_exists");
					$this->view->redirect("schedule", "add");
				}
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
				$this->view->setFlash("erro_general");
			}
		}

        $this->view->render("schedule", "add");
	}

	public function manageworkday(){
		$scheduleName = $_GET['scheduleName'];


		if (isset($_POST["submit"])) {
			$workday = new Workday();

			//obtemos o id do horario ó que engadimos a xornada
			$workday->setIdSchedule($this->scheduleMapper->getIdByName($scheduleName));
			
			//comprobamos e seteamos a hora
			if (isset($_POST["hourstart"]) && isset($_POST["hourend"])) {
				$hourstart = $_POST["hourstart"];
				$hourend = $_POST["hourend"];

				for ($i=0; $i < 7; $i++) { 
					$workday->setHourStart($hourstart[$i]);
					$workday->setHourEnd($hourend[$i]);

					if (!$this->workdayMapper->isValidWorkdayHour($workday)) {
						$this->view->setFlash("fail_hour_not_valid");
						$this->view->redirect("schedule", "manageWorkday", "&scheduleName=".$scheduleName);
					}
				}

						
			}
			else{
				$this->view->setFlash("erro_general");
			}

			//intentamos introducir na BD
			for ($i=0; $i < 7; $i++) { 
					$hourstart = $_POST["hourstart"];
					$hourend = $_POST["hourend"];
					$workday->setHourStart($hourstart[$i]);
					$workday->setHourEnd($hourend[$i]);
					$workday->setDay($i);
					try {
		            	$this->workdayMapper->edit($workday);
					}catch(ValidationException $ex) {
						$errors = $ex->getErrors();
						$this->view->setVariable("errors", $errors);
						$this->view->setFlash("erro_general");
					}
					
			}
			$this->view->setFlash("succ_workday_add");
		    $this->view->redirect("schedule", "manageWorkday", "&scheduleName=".$scheduleName);
			
		}
        $this->view->render("workday", "manage");
	}


    public function delete(){
    		try{
    			if (isset($_GET['scheduleName'])) {
    				$this->scheduleMapper->delete($this->scheduleMapper->getIdByName($_GET["scheduleName"]));
					$this->view->setFlash('succ_schedule_delete');
					$this->view->redirect("schedule", "show");
    			}
				
			}catch (Exception $e) {
				$errors = $e->getErrors();
				$this->view->setVariable("errors", $errors);
			}
			$this->view->render("schedule", "show");	
    }

    public function  show(){
        $schedules = $this->scheduleMapper->show();
		$this->view->setVariable("schedulestoshow", $schedules);
        $this->view->render("schedule", "show");
    }

    public function view(){
		$userid = $this->userMapper->getIdByName($_REQUEST["user"]);
        $user = $this->userMapper->view($userid);
        $this->view->setVariable("user", $user);
        $this->view->render("user", "view");
    }
	
	public function edit(){
		$scheduleName = $_GET['scheduleName'];
		if (isset($_POST["submit"])) {
            $schedule = new Schedule();

            $schedule->setIdSchedule($this->scheduleMapper->getIdByName($scheduleName));
            if (isset($_POST['name'])) {
            	$schedule->setSchedulename(htmlentities(addslashes($_POST["name"])));
            }
			

			//comproba se que a data de inicio<data de fin
			if (isset($_POST["datestart"]) && isset($_POST["dateend"])) {
				$datestart = $_POST["datestart"];
				$dateend = $_POST["dateend"];

				if ($this->scheduleMapper->isValidDate($datestart,$dateend)) {
					$schedule->setDateStart($datestart);
					$schedule->setDateEnd($dateend);
				}else{
					$this->view->setFlash("fail_date_interval");
					$this->view->redirect("schedule", "edit", "&scheduleName=".$scheduleName);
				}	

				if (!$this->scheduleMapper->isValidSchedule($schedule,$schedule->getIdSchedule())) {
					$this->view->setFlash("fail_schedule_overlap");
                    $this->view->redirect("schedule", "edit", "&scheduleName=".$scheduleName);		
				}		
			}

			try {
				if(!$this->scheduleMapper->scheduleNameExists($schedule->getSchedulename(),$schedule->getIdSchedule())){
                    $this->scheduleMapper->edit($schedule);

                    $this->view->setFlash("succ_schedule_edit");
                    $this->view->redirect("schedule", "show");
				} else {
					$this->view->setFlash("fail_schedule_name_exists");
					$this->view->redirect("schedule", "edit", "&scheduleName=".$scheduleName);
				}
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
				$this->view->setFlash("erro_general");
			}
		}

        $this->view->render("schedule", "edit");
	}
	
	public function search(){
		if(isset($_POST["submit"])){
			$schedule = new Schedule();

			if(!empty($_POST["name"])){
				$schedule->setSchedulename(htmlentities(addslashes($_POST["name"])));
			}


			$this->view->setVariable("schedulestoshow", $this->scheduleMapper->search($schedule));
			$this->view->render("schedule","show");
		}else{
			$this->view->render("schedule", "search");
		}

	}
}
