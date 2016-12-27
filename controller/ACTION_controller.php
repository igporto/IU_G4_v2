<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/ACTION.php");
require_once(__DIR__ . "/../model/ACTION_model.php");
require_once(__DIR__ . "/../model/PROFILE.php");
require_once(__DIR__ . "/../model/PROFILE_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


/**
 * Class ActionsController
 *
 * Controller to login, logout and action data managing
 */
class ActionController extends BaseController
{

    /**
     * Reference to the ActionMapper to interact
     * with the database
     *
     * @var ActionMapper
     */
    private $actionMapper;
    private $profileMapper;

    public function __construct()
    {
        parent::__construct();


        $this->actionMapper = new ActionMapper();
        $this->profileMapper = new ProfileMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {


        if (isset($_POST["submit"])) {
            //Creamos un obxecto Action baleiro
            $action = new Action();

            //Engadimos o nome ao Action
            $action->setActionname(htmlentities(addslashes($_POST["actionname"])));

            try {
                if (!$this->actionMapper->actionnameExists($_POST["actionname"])) {
                    //$action->checkIsValidForCreate();
                    $this->actionMapper->add($action);
                    //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                    $this->view->setFlash('succ_action_add');

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos actions)
                    $this->view->redirect("action", "show");
                } else {
                    $this->view->setFlash("fail_action_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("action", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['actionName'])) {
                $action_id = $this->actionMapper->getIdByName($_REQUEST["actionName"]);
                $action = $this->actionMapper->view($action_id);
                $this->actionMapper->delete($action);
                $this->view->setFlash('succ_action_delete');
                $this->view->redirect("action", "show");
            }
        } catch (Exception $e) {
           $this->view->setFlash('erro_general');
        }
        $this->view->render("action", "show");
    }

    public function show()
    {
        $actions = $this->actionMapper->show();
        $this->view->setVariable("actionstoshow", $actions);
        $this->view->render("action", "show");
    }

    public function view()
    {
        $actionid = $this->actionMapper->getIdByName($_REQUEST["action"]);
        $action = $this->actionMapper->view($actionid);
        $this->view->setVariable("action", $action);
        $this->view->render("action", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto action baleiro
            $action_id = $this->actionMapper->getIdByName($_REQUEST["actionName"]);
            $action = $this->actionMapper->view($action_id);
            $action->setActionname($_REQUEST["newname"]);

            try {
                $this->actionMapper->edit($action);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_action_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("action", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("action", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $action = new Action();
            if(isset($_POST['actionname'])){
                $action->setActionname((htmlentities(addslashes($_POST["actionname"]))));
            }
            if(isset($_POST["codaction"])){
                $action->setCodaction(htmlentities(addslashes($_POST["codaction"])));
            }
            try {
                
                $this->view->setVariable("actionstoshow", $this->actionMapper->search($action));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("action", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("action","show");
        }else{
            $this->view->render("action", "search");
        }

    }
}
