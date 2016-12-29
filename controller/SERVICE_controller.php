<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/SERVICE.php");
require_once(__DIR__ . "/../model/SERVICE_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");



class ServiceController extends BaseController
{

    private $serviceMapper;

    public function __construct()
    {
        parent::__construct();


        $this->serviceMapper = new ServiceMapper();

        $this->view->setLayout("navbar");
    }

    public function add(){

        if (isset($_POST["submit"])) {
            //Creamos un obxecto Client baleiro
            $service = new Service();

            //Engadimos os datos
            $service->setFecha(htmlentities(addslashes($_POST["fecha"])));
            $service->setCoste(htmlentities(addslashes($_POST["coste"])));
            $service->setDescripcion(htmlentities(addslashes($_POST["descripcion"])));
            $service->setDniClienteExterno(htmlentities(addslashes($_POST["dni"])));


            try {
                    $this->serviceMapper->add($service);
                    //ENVIAR AVISO DE CLIENTE ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_service_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos clientes)
                    $this->view->redirect("service", "show");

            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        //Se non se enviou nada
        $this->view->render("service", "add");
    }


    public function show()
    {
        $services = $this->serviceMapper->show();
        $this->view->setVariable("servicestoshow", $services);
        $this->view->render("service", "show");
    }


    public function view()
    {
        $service_id = htmlentities(addslashes($_REQUEST["id_servicio"]));
        $service = $this->serviceMapper->view($service_id);
        $this->view->setVariable("service", $service);
        $this->view->render("service", "view");
    }


    public function delete()
    {
        try {
            if (isset($_GET['service_id'])) {
                $this->serviceMapper->delete(htmlentities(addslashes($_GET["service_id"])));
                $this->view->setFlash('succ_service_delete');
                $this->view->redirect("service", "show");
            }

        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
            $this->view->setFlash("erro_general");
        }
        $this->view->render("service", "show");
    }


    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto action baleiro
            $service_id = htmlentities(addslashes($_REQUEST["service_id"]));
            $service = $this->serviceMapper->view($service_id);

            //Engadimos o novo contrasinal ao usuario se chega (se non deixamos o que ten)
            if(isset($_POST["fecha"])&& ($_POST['fecha'])!=""){
                $service->setFecha(htmlentities(addslashes($_POST["fecha"])));
            }else{
                $aux = $service->getFecha();
                $service->setFecha($aux);
            }
            if(isset($_POST["coste"])&& ($_POST['coste'])!=""){
                $service->setCoste(htmlentities(addslashes($_POST["coste"])));
            }else{
                $aux = $service->getCoste();
                $service->setCoste($aux);
            }
            if(isset($_POST["descripcion"])&& ($_POST['descripcion'])!=""){
                $service->setDescripcion(htmlentities(addslashes($_POST["descripcion"])));
            }else{
                $aux = $service->getDescripcion();
                $service->setDescripcion($aux);
            }
            if(isset($_POST["dni"])&& ($_POST['dni'])!=""){
                $service->setDniClienteExterno(htmlentities(addslashes($_POST["dni"])));
            }else{
                $aux = $service->getDniClienteExterno();
                $service->setDniClienteExterno($aux);
            }


            try {
                $this->serviceMapper->edit($service);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_service_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("service", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("service", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $service = new Service();
            $empty = true;

            if(!empty($_POST['id'])){
                $service->setId(htmlentities(addslashes($_POST["id"])));
                $empty = false;
            }
            if(!empty($_POST["fecha"])){
                $service->setFecha(htmlentities(addslashes($_POST["fecha"])));
                $empty = false;
            }

            if ($empty) {
                $this->view->setFlash("fail_empty_query");
                $this->view->redirect("service","search");
            }

            $this->view->setVariable("servicestoshow", $this->serviceMapper->search($service));
            $this->view->render("service","show");
        }else{
            $this->view->render("service", "search");
        }

    }


}
