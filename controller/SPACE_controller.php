<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/SPACE.php");
require_once(__DIR__."/../model/SPACE_model.php");

require_once(__DIR__."/../controller/BaseController.php");

class SpaceController extends BaseController {
    private $spaceMapper;
    
    public function __construct() {
        parent::__construct();

        $this->spaceMapper = new SpaceMapper();
        $this->view->setLayout("navbar");
    }

    public function  show(){
        $spaces = $this->spaceMapper->show();
        $this->view->setVariable("spacestoshow", $spaces);
        $this->view->render("space", "show");
    }

    public function view(){
        $codspace = $this->spaceMapper->getIdByName($_REQUEST["id_espacio"]);
        $space = $this->spaceMapper->view($codspace);
        $this->view->setVariable("id_espacio", $space);
        $this->view->render("space", "view");
    }

    public function add(){

        if (isset($_POST["submit"])) {
            //Creamos un obxecto espazo baleiro
            $space = new Space();

            //Engadimos o id, aforo e descripción ao espazo
            $space->setSpacename(htmlentities(addslashes($_POST["name"])));
            $space->setCapacity(htmlentities(addslashes($_POST['capacity'])));
            $space->setDescription(htmlentities(addslashes($_POST['description'])));

            try {
                if(!$this->spaceMapper->spaceNameExists($space->getSpacename())){
                    $this->spaceMapper->add($space);
                    //ENVIAR AVISO DE ESPAZO ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_space_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos espazos)
                    $this->view->redirect("space", "show");
                } else {
                    $this->view->setFlash("space_already_exists");
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("space", "add");
    }

    public function edit(){
        if (isset($_POST["submit"])) {
            $sp = $this->spaceMapper->view($_REQUEST['id_espacio']);

            //Engadimos o novo aforo ao espazo (se non deixamos o que ten)
            if(isset($_POST["capacity"])&& addslashes($_POST['capacity'])!=""){
                $sp->setCapacity(htmlentities(addslashes($_POST["capacity"])));
            }else{
                $capacity = $sp->getCapacity();
                $sp->setCapacity($capacity);
            }

            //Engadimos a nova descripción ao espazo (se non deixamos a que ten)
            if(isset($_POST["description"])&& addslashes($_POST['description'])!=""){
                $sp->setDescription(htmlentities(addslashes($_POST["description"])));
            }else{
                $des = $sp->getDescription();
                $sp->setDescription($des);
            }


            try {
                $this->spaceMapper->edit($sp);
                //ENVIAR AVISO DE ESPAZO EDITADO!!!!!!!!!!
                $this->view->setFlash("succ_space_mod");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos espazos)
                $this->view->redirect("space", "show");
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("space", "edit");
    }

    public function delete(){
        try{
            if (isset($_GET['id_espacio'])) {
                $this->spaceMapper->delete($_GET["id_espacio"]);
                $this->view->setFlash('succ_space_delete');
                $this->view->redirect("space", "show");
            }

        }catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("space", "show");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $space = new Space();

            if(!empty($_POST["id_espacio"])){
                $space->setCodspace(htmlentities(addslashes($_POST["id_espacio"])));
            }
            if(!empty($_POST['name'])){
                $space->setSpacename(htmlentities(addslashes($_POST["name"])));
            }
            if(!empty($_POST["description"])){
                $space->setDescription(htmlentities(addslashes($_POST["description"])));
            }
            if(!empty($_POST["capacity"])){
                $space->setCapacity(htmlentities(addslashes($_POST["capacity"])));
            }

            $this->view->setVariable("spacestoshow", $this->spaceMapper->search($space) );
            $this->view->render("space","show");
        }else{
            $this->view->render("space", "search");
        }
    }

}
