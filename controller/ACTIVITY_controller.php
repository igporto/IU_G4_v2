<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/ACTIVITY.php");
require_once(__DIR__ . "/../model/ACTIVITY_model.php");
require_once(__DIR__ . "/../model/CATEGORY.php");
require_once(__DIR__ . "/../model/CATEGORY_model.php");
require_once(__DIR__ . "/../model/SPACE.php");
require_once(__DIR__ . "/../model/SPACE_model.php");
require_once(__DIR__ . "/../model/EMPLOYEE.php");
require_once(__DIR__ . "/../model/EMPLOYEE_model.php");
require_once(__DIR__ . "/../model/DISCOUNT.php");
require_once(__DIR__ . "/../model/DISCOUNT_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


/**
 * Class ActionsController
 *
 * Controller to login, logout and action data managing
 */
class ActivityController extends BaseController
{

    private $activityMapper;
    private $categoryMapper;
    private $spaceMapper;
    private $employeeMapper;
    private $discountMapper;

    public function __construct()
    {
        parent::__construct();


        $this->activityMapper = new ActivityMapper();
        $this->categoryMapper = new CategoryMapper();
        $this->spaceMapper = new SpaceMapper();
        $this->employeeMapper = new EmployeeMapper();
        $this->discountMapper = new DiscountMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Activity baleiro
            $activity = new Activity();

            //Engadimos os datos ao obxecto Activity
            if(isset($_POST["name"])){
                $activity->setActivityname(htmlentities(addslashes($_POST["name"])));
            }

            if(isset($_POST['capacity'])){
                $activity->setCapacity((htmlentities(addslashes($_POST["capacity"]))));
            }

            if(isset($_POST['category'])){
                $activity->setCategory($this->categoryMapper->view($_POST["category"]));
            }

            if(isset($_POST['space'])){
                $activity->setSpace($this->spaceMapper->view($_POST["space"]));
            }

            if(isset($_POST['discount'])){
                $activity->setDiscount($this->discountMapper->view($_POST["discount"]));
            }

            if(isset($_POST['employee'])){
                $activity->setEmployee($this->employeeMapper->view($_POST["employee"]));
            }

            if(isset($_POST['color'])){
                $activity->setColor($_POST["color"]);
            }

            try {
                if (!$this->activityMapper->activitynameExists($activity->getActivityname())) {
                    //Comprobamos que ten un aforo minimo dunha persoa
                    if($activity->getCapacity() > 1){
                        //Comprobamos que non se pode >100 nin <0
                        if(($activity->getDiscount()->getPercent() < 100) && ($activity->getDiscount()->getPercent() > 0)) {
                            $this->activityMapper->add($activity);
                            //ENVIAR AVISO DE ACTIVIDADE ENGADIDA!!!!!!!!!!
                            $this->view->setFlash('succ_activity_add');

                            //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das Actividades)
                            $this->view->redirect("activity", "show");
                        }else{
                            $this->view->setFlash("fail_discount_incorrect");
                        }
                    }else{
                        $this->view->setFlash("fail_aforo_incorrect");
                    }
                } else {
                    $this->view->setFlash("fail_action_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        $this->view->render("activity", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['codactivity'])) {
                $this->activityMapper->delete(htmlentities(addslashes($_GET['codactivity'])));
                $this->view->setFlash('succ_activity_delete');
                $this->view->redirect("activity", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("activity", "show");
    }

    public function show()
    {
        $activities = $this->activityMapper->show();
        $this->view->setVariable("activitiestoshow", $activities);
        $this->view->render("activity", "show");
    }

    public function view()
    {
        $activity = $this->activityMapper->view(htmlentities(addslashes($_REQUEST["codactivity"])));
        $this->view->setVariable("activity", $activity);
        $this->view->render("activity", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {

            //creamos un obxecto actividade cos datos da actividade a editar
            $activity = $this->activityMapper->view($_GET["codactivity"]);


            if(isset($_POST['name']) && $_POST['name']!="") {
                $activity->setActivityname((htmlentities(addslashes($_POST["name"]))));
                if ($this->activityMapper->activitynameExists($activity->getActivityname())) {
                    $this->view->setFlash("fail_activity_exists");
                    $this->view->redirect("activity", "edit", "codactivity=" . $_GET["codactivity"]);
                }
            }

            if(isset($_POST['capacity']) && $_POST['capacity']>0){
                $activity->setCapacity((htmlentities(addslashes($_POST["capacity"]))));
            }

            if(isset($_POST['category'])){
                $activity->setCategory($this->categoryMapper->view($_POST["category"]));
            }

            if(isset($_POST['space'])){
                $activity->setSpace($this->spaceMapper->view($_POST["space"]));
            }

            if(isset($_POST['discount'])){
                $activity->setDiscount($this->discountMapper->view($_POST["discount"]));
            }

            if(isset($_POST['employee'])){
                $activity->setEmployee($this->employeeMapper->view($_POST["employee"]));
            }

            if(isset($_POST['color'])){
                $activity->setColor($_POST["color"]);
            }

            try {
                $this->activityMapper->edit($activity);
                //ENVIAR AVISO DE ACTIVIDADE EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_activity_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das actividades)
                $this->view->redirect("activity", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        $this->view->render("activity", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){

            $activity = new Activity();

            //Comprobamos os datos que nos chegan e engadimolos ao obxecto $activity
            if(isset($_POST['codactivity']) && $_POST['codactivity']!= ""){
                $activity->setCodactivity((htmlentities(addslashes($_POST["codactivity"]))));
            }

            if(isset($_POST['name']) && $_POST['name']!= ""){
                $activity->setActivityname((htmlentities(addslashes($_POST["name"]))));
            }

            if(isset($_POST['capacity']) && $_POST['capacity']>0 ){
                $activity->setCapacity((htmlentities(addslashes($_POST["capacity"]))));
            }

            if(isset($_POST['usecat']) && isset($_POST['category'])){
                $activity->setCategory($this->categoryMapper->view($_POST["category"]));

            }else{
                $aux = new Category();
                $aux->setCodcategory("");
                $activity->setCategory($aux);
            }

            if(isset($_POST['usespa']) && isset($_POST['space'])) {
                $activity->setSpace($this->spaceMapper->view($_POST["space"]));
            }else {
                $aux = new Space();
                $aux->setCodspace("");
                $activity->setSpace($aux);
            }

            if(isset($_POST['usedis']) && isset($_POST['discount'])) {
                $activity->setDiscount($this->discountMapper->view($_POST["discount"]));
            }else {
                $aux = new Discount();
                $aux->setCoddiscount("");
                $activity->setDiscount($aux);
            }

            if(isset($_POST['useemp']) && isset($_POST['employee'])){
                $activity->setEmployee($this->employeeMapper->view($_POST["employee"]));
            }else {
                $aux = new Employee();
                $aux->setCodemployee("");
                $activity->setEmployee($aux);
            }

            try {
                $this->view->setVariable("activitiestoshow", $this->activityMapper->search($activity));
            } catch (Exception $e) {
                var_dump($e->getMessage());exit;
                $this->view->setFlash("erro_general");
                $this->view->redirect("activity", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("activity","show");
        }else{
            $this->view->render("activity", "search");
        }

    }
}
