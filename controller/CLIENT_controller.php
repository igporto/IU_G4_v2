<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/CLIENT.php");
require_once(__DIR__ . "/../model/CLIENT_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");



class ClientController extends BaseController
{

    private $clientMapper;

    public function __construct()
    {
        parent::__construct();


        $this->clientMapper = new ClientMapper();

        $this->view->setLayout("navbar");
    }

    public function add(){

        if (isset($_POST["submit"])) {
            //Creamos un obxecto Client baleiro
            $client = new Client();

            //Engadimos os datos
            $client->setDni(htmlentities(addslashes($_POST["dni"])));
            $client->setName(htmlentities(addslashes($_POST["name"])));
            $client->setSurname(htmlentities(addslashes($_POST["surname"])));
            $client->setPhone(htmlentities(addslashes($_POST["phone"])));
            $client->setEmail(htmlentities(addslashes($_POST["email"])));


            try {
                if(!$this->clientMapper->dniExists(htmlentities(addslashes($_POST["dni"])))){
                    $this->clientMapper->add($client);
                    //ENVIAR AVISO DE CLIENTE ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_client_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos clientes)
                    $this->view->redirect("client", "show");
                } else {
                    $this->view->setFlash("fail_client_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        //Se non se enviou nada
        $this->view->render("client", "add");
    }


    public function show()
    {
        $clients = $this->clientMapper->show();
        $this->view->setVariable("clientstoshow", $clients);
        $this->view->render("client", "show");
    }


    public function view()
    {
        $clientdni = htmlentities(addslashes($_REQUEST["dni_cliente_externo"]));
        $client = $this->clientMapper->view($clientdni);
        $this->view->setVariable("client", $client);
        $this->view->render("client", "view");
    }



    public function delete()
    {
        try {
            if (isset($_GET['clientdni'])) {
                $this->clientMapper->delete(htmlentities(addslashes($_GET["clientdni"])));
                $this->view->setFlash('succ_client_delete');
                $this->view->redirect("client", "show");
            }

        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
            $this->view->setFlash("erro_general");
        }
        $this->view->render("client", "show");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $client = new Client();
            if(isset($_POST['dni'])){
                $client->setDni((htmlentities(addslashes($_POST["dni"]))));
            }
            if(isset($_POST["name"])){
                $client->setName(htmlentities(addslashes($_POST["name"])));
            }

            try {
                $this->view->setFlash("succ_client_search");
                $this->view->setVariable("clientstoshow", $this->clientMapper->search($client));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
            }

            $this->view->render("client","show");
        }else{
            $this->view->render("client", "search");
        }

    }


    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto action baleiro
            $client_id = htmlentities(addslashes($_REQUEST["clientdni"]));
            $client = $this->clientMapper->view($client_id);

            //Engadimos o novo contrasinal ao usuario se chega (se non deixamos o que ten)
            if(isset($_POST["newname"])&& ($_POST['newname'])!=""){
                $client->setName(htmlentities(addslashes($_POST["newname"])));
            }else{
                $aux = $client->getName();
                $client->setName($aux);
            }
            if(isset($_POST["newsurname"])&& ($_POST['newsurname'])!=""){
                $client->setSurname(htmlentities(addslashes($_POST["newsurname"])));
            }else{
                $aux = $client->getSurname();
                $client->setSurname($aux);
            }
            if(isset($_POST["newphone"])&& ($_POST['newphone'])!=""){
                $client->setPhone(htmlentities(addslashes($_POST["newphone"])));
            }else{
                $aux = $client->getPhone();
                $client->setPhone($aux);
            }
            if(isset($_POST["newemail"])&& ($_POST['newemail'])!=""){
                $client->setEmail(htmlentities(addslashes($_POST["newemail"])));
            }else{
                $aux = $client->getEmail();
                $client->setEmail($aux);
            }


            try {
                $this->clientMapper->edit($client);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_client_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("client", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("client", "edit");
    }

}
