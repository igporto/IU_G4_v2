<?php
require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/DOCUMENT.php");
require_once(__DIR__ . "/../model/DOCUMENT_model.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");



class DocumentController extends BaseController{
    private $documentMapper;
    private $alumnMapper;
    private $employeeMapper;

    public function __construct()
    {
        parent::__construct();


        $this->documentMapper = new DocumentMapper();
        $this->employeeMapper = new EmployeeMapper();
        $this->alumnMapper = new AlumnMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Document baleiro
            $document = new Document();

            $document->setSigndate($this->documentMapper->getDay());
            $document->setAlumn($this->alumnMapper->view(htmlentities(addslashes($_REQUEST['codalumn']))));
            if(isset($_REQUEST['codemployee']) ){
                $document->setEmployee($this->employeeMapper->view(htmlentities(addslashes($_REQUEST['codemployee']))));
            }else{
                $document->setEmployee(new Employee());
            }


            $ruta = __DIR__."/../media/documents/";
            $dest = $ruta.$document->getAlumn()->getDni()."_".$_FILES['document']['name'];
            copy($_FILES['document']['tmp_name'],$dest);
            $document->setName($_FILES['document']['name']);
            $document->setRoute("media/documents/".$document->getAlumn()->getDni()."_".$_FILES['document']['name']);

            try {
                $this->documentMapper->add($document);
                $this->view->setFlash('succ_document_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das categorias)
                $this->view->redirect("document", "show");

            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("document", "add");
    }


    public function show()
    {
        $docs = $this->documentMapper->show();
        $this->view->setVariable("documentstoshow", $docs);
        $this->view->render("document", "show");
    }


    public function view()
    {
        $document = $this->documentMapper->view(htmlentities(addslashes($_GET['coddocument'])));
        $this->view->setVariable("document", $document);
        $this->view->render("document", "view", "coddocument=".$_GET['coddocument']);
    }

}
