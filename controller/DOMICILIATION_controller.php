<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/DOMICILIATION.php");
require_once(__DIR__ . "/../model/DOMICILIATION_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


/**
 * Class DomiciliationsController
 *
 * Controller to login, logout and domiciliation data managing
 */
class DomiciliationController extends BaseController
{

    /**
     * Reference to the DomiciliationMapper to interact
     * with the database
     *
     * @var DomiciliationMapper
     */
    private $domiciliationMapper;

    public function __construct()
    {
        parent::__construct();

        $this->domiciliationMapper = new DomiciliationMapper();

        // Domiciliations controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {


        if (isset($_POST["submit"])) {
            //Creamos un obxecto Domiciliation baleiro
            $domiciliation = new Domiciliation();

            $domiciliation->setPeriodo(htmlentities(addslashes($_POST["periodo"])));
            $domiciliation->setTotal(htmlentities(addslashes($_POST["total"])));
            $domiciliation->setIdCliente(htmlentities(addslashes($_POST["id_cliente"])));
            $domiciliation->setIban(htmlentities(addslashes($_POST["iban"])));

            try {
                $this->domiciliationMapper->add($domiciliation);
                //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                $this->view->setFlash('succ_domiciliation_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos domiciliations)
                $this->view->redirect("domiciliation", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("domiciliation", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['id_domiciliacion'])) {
                $domiciliation_id = $_REQUEST["id_domiciliacion"];
                $domiciliation = $this->domiciliationMapper->view($domiciliation_id);
                $this->domiciliationMapper->delete($domiciliation);
                $this->view->setFlash('succ_domiciliation_delete');
                $this->view->redirect("domiciliation", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("domiciliation", "show");
    }

    public function show()
    {
        $domiciliations = $this->domiciliationMapper->show();
        $this->view->setVariable("domiciliationstoshow", $domiciliations);
        $this->view->render("domiciliation", "show");
    }

    public function view()
    {
        $domiciliation = $this->domiciliationMapper->view($_REQUEST["id_domiciliacion"]);
        $this->view->setVariable("domiciliation", $domiciliation);
        $this->view->render("domiciliation", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto domiciliation baleiro
            $domiciliation_id = $_REQUEST["id_domiciliacion"];
            $domiciliation = $this->domiciliationMapper->view($domiciliation_id);

            if (isset($_POST["periodo"]) && ($_POST['periodo']) != "") {
                $domiciliation->setPeriodo(htmlentities(addslashes($_POST["periodo"])));
            } else {
                $aux = $domiciliation->getPeriodo();
                $domiciliation->setPeriodo($aux);
            }
            if (isset($_POST["total"]) && ($_POST['total']) != "") {
                $domiciliation->setTotal(htmlentities(addslashes($_POST["total"])));
            } else {
                $aux = $domiciliation->getTotal();
                $domiciliation->setTotal($aux);
            }
            if (isset($_POST["id_cliente"]) && ($_POST['id_cliente']) != "") {
                $domiciliation->setIdCliente(htmlentities(addslashes($_POST["id_cliente"])));
            } else {
                $aux = $domiciliation->getIdCliente();
                $domiciliation->setIdCliente($aux);
            }
            if (isset($_POST["iban"]) && ($_POST['iban']) != "") {
                $domiciliation->setIban(htmlentities(addslashes($_POST["iban"])));
            } else {
                $aux = $domiciliation->getIban();
                $domiciliation->setIban($aux);
            }

            try {
                $this->domiciliationMapper->edit($domiciliation);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_domiciliation_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("domiciliation", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("domiciliation", "edit");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {
            $domiciliation = new Domiciliation();

            if (isset($_POST['periodo'])) {
                $domiciliation->setPeriodo(htmlentities(addslashes($_POST["periodo"])));
            }
            if (isset($_POST['total'])) {
                $domiciliation->setTotal(htmlentities(addslashes($_POST["total"])));
            }
            if (isset($_POST['id_cliente'])) {
                $domiciliation->setIdCliente(htmlentities(addslashes($_POST["id_cliente"])));
            }
            if (isset($_POST['iban'])) {
                $domiciliation->setIban(htmlentities(addslashes($_POST["iban"])));
            }

            try {
                $this->view->setVariable("domiciliationstoshow", $this->domiciliationMapper->search($domiciliation));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("domiciliation", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("domiciliation", "show");
        } else {
            $this->view->render("domiciliation", "search");
        }

    }

    public  function  addDoc(){

        if(isset($_POST['submit'])){
            $dm =  new DomiciliationMapper();
            $dom = $dm->view($_GET['coddomiciliation']);

            $ruta = __DIR__."/../media/documents/";
            $dest = $ruta."DOMICILIACION_".$_FILES['document']['name'];
            copy($_FILES['document']['tmp_name'],$dest);

            $dom->setDocumento("media/documents/"."DOMICILIACION_".$_FILES['document']['name']);

            $this->domiciliationMapper->edit($dom);

            $this->view->setFlash("succ_document_add");
            $this->view->redirect("domiciliation", "show");
        }else{
            $this->view->render("domiciliation", "adddoc", "coddomiciliation=".$_GET['coddomiciliation']);
        }
    }

    public function viewdoc(){
        $this->view->render("domiciliation", "viewdoc", "coddomiciliation=".$_GET['coddomiciliation']);
    }

}
