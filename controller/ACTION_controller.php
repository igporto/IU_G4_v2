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

    //devolve un array de Permiso, que son os permisos de usuario+perfil do usuario $_SESSION['currentaction']
    public function getCurrentActionPerms()
    {
        //obtén o obxecto usuario
        $cu = $this->actionMapper->view($this->actionMapper->getIdByName($_SESSION['currentaction']));
        //$this->helper->toConsole(var_dump($cu));

        $perms = array();

        if ($cu->getPermissions()->getActionPermissions() != NULL) {
            foreach ($cu->getPermissions()->getActionPermissions() as $perm) {
                array_push($perms, $perm);
            }
        }

        //obtemos os permisos do perfil e metémolos en $perms
        if ($cu->getProfile()->getPermissions() != NULL) {

            foreach ($cu->getProfile()->getPermissions() as $perm) {
                array_push($perms, $perm);
            }
        }

        //devolvemos o array de permisos do usuario actual
        return array_unique($perms);
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
                    //ENVIAR AVISO DE USUARIO ENGADIDO!!!!!!!!!!
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
            if (isset($_GET['action'])) {
                $this->actionMapper->delete($this->actionMapper->getIdByName($_GET["action"]));
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
}
