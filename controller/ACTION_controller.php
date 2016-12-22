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
                    $this->view->setFlash('action_exists');

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos actions)
                    $this->view->redirect("action", "show");
                } else {
                    $errors = array();
                    $errors["general"] = "Actionname already exists";
                    $this->view->setVariable("errors", $errors);
                    $this->view->setFlash("action_already_exists");
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
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
                $this->view->setFlash('msg_delete_correct');
                $this->view->redirect("action", "show");
            }
        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("action", "show");
    }

    public function show()
    {
        $actions = $this->actionMapper->show();
        $this->view->setVariable("actions", $actions);
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
                $this->view->setFlash("Accion modificada correctamente!");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("action", "view", "actionName=" . $action->getActionname());
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("action", "edit");
    }
}
