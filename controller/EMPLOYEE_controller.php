<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/EMPLOYEE.php");
require_once(__DIR__ . "/../model/EMPLOYEE_model.php");
require_once(__DIR__ . "/../model/USER.php");
require_once(__DIR__ . "/../model/USER_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


class EmployeeController extends BaseController
{

    private $employeeMapper;
    private $userMapper;

    public function __construct()
    {
        parent::__construct();

        $this->employeeMapper = new EmployeeMapper();
        $this->userMapper = new UserMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Employee baleiro
            $employee = new Employee();

            //Engadimos os datos ao obxecto Employee
            if(isset($_POST["dni"])){
                $employee->setEmployeedni(htmlentities(addslashes($_POST["dni"])));
            }

            if(isset($_POST['name'])){
                $employee->setEmployeename((htmlentities(addslashes($_POST["name"]))));
            }

            if(isset($_POST['surname'])){
                $employee->setEmployeesurname($_POST["surname"]);
            }

            if(isset($_POST['birthdate'])){
                $employee->setBirthdate($_POST["birthdate"]);
            }

            if(isset($_POST['address'])){
                $employee->setAddress($_POST["address"]);
            }

            if(isset($_POST['email'])){
                $employee->setEmail($_POST["email"]);
            }

            if(isset($_POST['comment']) && $_POST['comment']!= ""){
                $employee->setComment($_POST["comment"]);
            }

            if(isset($_POST['hourIn'])){
                $employee->setHourIn($_POST["hourIn"]);
            }

            if(isset($_POST['hourOut'])){
                $employee->setHourOut($_POST["hourOut"]);
            }

            if(isset($_POST['banknum'])){
                $employee->setBanknum($_POST["banknum"]);
            }

            if(isset($_POST['contracttype'])){
                $employee->setContracttype($_POST["contracttype"]);
            }

            if(htmlentities(addslashes($_POST['user'])) == "NULL"){
                $employee->setUser(new User());
            }else{
                $employee->setUser($this->userMapper->view($_POST["user"]));
            }

            try {
                if (!$this->employeeMapper->employeedniExists($employee->getEmployeedni())) {
                    if($this->validar_dni($employee->getEmployeedni())){
                        if($this->validar_email($employee->getEmail())){
                            if($this->employeeMapper->validar_fecha_nac($employee->getBirthdate())){
                                $this->employeeMapper->add($employee);
                                //ENVIAR AVISO DE Empregafo engadido!!!!!!!!!!
                                $this->view->setFlash('succ_employee_add');
                                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos empregados)
                                $this->view->redirect("employee", "show");
                            }else{
                                $this->view->setFlash("fail_birthdate_incorrect");
                            }
                        }else{
                            $this->view->setFlash("fail_email_incorrect");
                        }
                    }else{
                        $this->view->setFlash("fail_dni_incorrect");
                    }
                }else{
                    $this->view->setFlash("fail_dni_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("employee", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['codemployee'])) {
                $this->employeeMapper->delete(htmlentities(addslashes($_GET['codemployee'])));
                $this->view->setFlash('succ_employee_delete');
                $this->view->redirect("employee", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("employee", "show");
    }

    public function show()
    {
        $employees = $this->employeeMapper->show();
        $this->view->setVariable("employeestoshow", $employees);
        $this->view->render("employee", "show");
    }

    public function view()
    {
        $employee = $this->employeeMapper->view(htmlentities(addslashes($_REQUEST["codemployee"])));
        $this->view->setVariable("employee", $employee);
        $this->view->render("employee", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //creamos un obxecto actividade cos datos da actividade a editar
            $employee = $this->employeeMapper->view(htmlentities(addslashes($_REQUEST["codemployee"])));

            //Engadimos os datos ao obxecto Employee
            if(isset($_POST["dni"]) && $_POST["dni"] !=""){
                if($this->validar_dni(htmlentities(addslashes($_POST["dni"])))){
                    if($this->employeeMapper->employeedniExists($_POST["dni"])){
                        $employee->setEmployeedni(htmlentities(addslashes($_POST["dni"])));
                    }else{
                        $this->view->setFlash("fail_dni_exists");
                        $this->view->render("employee", "edit");
                    }
                }else{
                    $this->view->setFlash("fail_dni_incorrect");
                    $this->view->render("employee", "edit");
                }
            }

            if(isset($_POST['name'])  && $_POST["name"] !=""){
                $employee->setEmployeename((htmlentities(addslashes($_POST["name"]))));
            }

            if(isset($_POST['surname'])  && $_POST["surname"] !=""){
                $employee->setEmployeesurname($_POST["surname"]);
            }

            if(isset($_POST['birthdate'])  && $_POST["birthdate"] !=""){
                if($this->employeeMapper->validar_fecha_nac(htmlentities(addslashes($_POST['birthdate'])))){
                    $employee->setBirthdate($_POST["birthdate"]);
                }else{
                    $this->view->setFlash("fail_birthdate_incorrect");
                    $this->view->render("employee", "edit");
                }
            }

            if(isset($_POST['address'])  && $_POST["address"] !=""){
                $employee->setAddress($_POST["address"]);
            }

            if(isset($_POST['email']) && $_POST["email"] !=""){
                if($this->validar_email(htmlentities(addslashes($_POST['email'])))){
                    $employee->setEmail($_POST["email"]);
                }else{
                    $this->view->setFlash("fail_email_incorrect");
                    $this->view->render("employee", "edit");
                }
            }

            if(isset($_POST['comment']) && $_POST["comment"] !=""){
                $employee->setComment($_POST["comment"]);
            }

            if(isset($_POST['hourIn']) && $_POST["hourIn"] !=""){
                $employee->setHourIn($_POST["hourIn"]);
            }

            if(isset($_POST['hourOut']) && $_POST["hourOut"] !=""){
                $employee->setHourOut($_POST["hourOut"]);
            }

            if(isset($_POST['banknum']) && $_POST["banknum"] !=""){
                $employee->setBanknum($_POST["banknum"]);
            }

            if(isset($_POST['contracttype']) && $_POST["contracttype"] !=""){
                $employee->setContracttype($_POST["contracttype"]);
            }

            if(isset($_POST['user'])){
                if(htmlentities(addslashes($_POST['user'])) == "NULL"){
                    $employee->setUser(new User());
                }else{
                    $employee->setUser($this->userMapper->view($_POST["user"]));
                }
            }

            try {
                $this->employeeMapper->edit($employee);
                //ENVIAR AVISO DE Empregado EDITADo!!!!!!!!!!
                $this->view->setFlash("succ_employee_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos empregado)
                $this->view->redirect("employee", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        $this->view->render("employee", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){

            //Creamos un obxecto Employee baleiro
            $employee = new Employee();


            //Engadimos os datos ao obxecto Employee
            if(isset($_POST["code"])){
                $employee->setCodemployee(htmlentities(addslashes($_POST["code"])));
            }

            if(isset($_POST["dni"])){
                $employee->setEmployeedni(htmlentities(addslashes($_POST["dni"])));
            }

            if(isset($_POST['name'])){
                $employee->setEmployeename((htmlentities(addslashes($_POST["name"]))));
            }

            if(isset($_POST['surname'])){
                $employee->setEmployeesurname($_POST["surname"]);
            }

            if(isset($_POST['address'])){
                $employee->setAddress($_POST["address"]);
            }

            if(isset($_POST['contracttype'])){
                $employee->setContracttype($_POST["contracttype"]);
            }

            if(isset($_POST['useuser']) && isset($_POST['user'])){
                $employee->setUser($this->userMapper->view($_POST["user"]));
            }else{
                $employee->setUser(new User());
            }

            try {
                $this->view->setVariable("employeestoshow", $this->employeeMapper->search($employee));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("employee", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("employee","show");
        }else{
            $this->view->render("employee", "search");
        }

    }

    public function validar_dni($dni){
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
            return true;
        }else{
            return false;
        }
    }

    public function validar_email($direccion){
    $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
       if(preg_match($Sintaxis,$direccion))
           return true;
       else
           return false;
    }

}
