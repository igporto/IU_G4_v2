<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/INJURY.php");
require_once(__DIR__ . "/../model/INJURY_model.php");
require_once(__DIR__ . "/../model/PUPILHASINJURY.php");
require_once(__DIR__ . "/../model/ACCESSLOG_model.php");
require_once(__DIR__ . "/../model/EMPLOYEEHASINJURY.php");
require_once(__DIR__ . "/../controller/BaseController.php");
require_once(__DIR__). "/../lib/fpdf/fpdf.php";


class InjuryController extends BaseController
{
    private $injuryMapper;
    private $accesslogMapper;
    private $fpdf;

    public function __construct()
    {
        parent::__construct();

        $this->injuryMapper = new InjuryMapper();
        $this->view->setLayout("navbar");
        $this->accesslogMapper = new AccesslogMapper();
    }

    public function show()
    {
        $injurys = $this->injuryMapper->show();
        $this->view->setVariable("injurystoshow", $injurys);
        $this->view->render("injury", "show");
    }

    public function view()
    {
        $codinjury = $this->injuryMapper->getIdByName($_REQUEST["id_lesion"]);
        $injury = $this->injuryMapper->view($codinjury);
        $this->view->setVariable("id_lesion", $injury);
        $this->view->render("injury", "view");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto injury baleiro
            $injury = new Injury();

            //Engadimos os datos
            $injury->setTime(htmlentities(addslashes($_POST["time_recovery"])));
            $injury->setTreatment(htmlentities(addslashes($_POST['treatment'])));
            if ($_POST['description'] && $_POST['description'] != "") {
                $injury->setDescription(htmlentities(addslashes($_POST['description'])));
            }
            $injury->setNameInjury(htmlentities(addslashes($_POST['name'])));

            try {

                if (!$this->injuryMapper->injuryNameExists($injury->getNameInjury())) {
                    $this->injuryMapper->add($injury);
                    //ENVIAR AVISO DE ESPAZO ENGADIDO!!!!!!!!!!
                    $this->view->setFlash("succ_injury_add");

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos espazos)
                    $this->view->redirect("injury", "show");
                } else {
                    $this->view->setFlash("injury_already_exists");
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("injury", "add");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            $in = $this->injuryMapper->view($_REQUEST['id_lesion']);

            //Engadimos o novo nome a lesion (se non deixamos o que ten)
            if (isset($_POST["name"]) && addslashes($_POST['name']) != "") {
                $in->setNameInjury(htmlentities(addslashes($_POST["name"])));
            } else {
                $injur = $in->getNameInjury();
                $in->setNameInjury($injur);
            }

            //Engadimos a nova descripción a lesion (se non deixamos a que ten)
            if (isset($_POST["description"]) && addslashes($_POST['description']) != "") {
                $in->setDescription(htmlentities(addslashes($_POST["description"])));
            } else {
                $des = $in->getDescription();
                $in->setDescription($des);
            }

            //Engadimos o novo tratamento a lesion (se non deixamos a que ten)
            if (isset($_POST["treatment"]) && addslashes($_POST['treatment']) != "") {
                $in->setTreatment(htmlentities(addslashes($_POST["treatment"])));
            } else {
                $trea = $in->getTreatment();
                $in->setTreatment($trea);
            }

            //Engadimos o novo tempo de recuperacion a lesion (se non deixamos a que ten)
            if (isset($_POST["time_recovery"]) && addslashes($_POST['time_recovery']) != "") {
                $in->setTime(htmlentities(addslashes($_POST["time_recovery"])));
            } else {
                $tim = $in->getTime();
                $in->setTime($tim);
            }

            try {
                $this->injuryMapper->edit($in);
                //ENVIAR AVISO DE ESPAZO EDITADO!!!!!!!!!!
                $this->view->setFlash("succ_injury_mod");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos lesions)
                $this->view->redirect("injury", "show");
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        //Se non se enviou nada
        $this->view->render("injury", "edit");
    }

    public function delete()
    {
        try {
            if (isset($_GET['id_lesion'])) {
                $this->injuryMapper->delete($_GET["id_lesion"]);
                $this->view->setFlash('succ_injury_delete');
                $this->view->redirect("injury", "show");
            }

        } catch (Exception $e) {
            $errors = $e->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        $this->view->render("injury", "show");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {
            $injury = new Injury();

            if (!empty($_POST["id_lesion"])) {
                $injury->setCodInjury(htmlentities(addslashes($_POST["id_lesion"])));
            }
            if (!empty($_POST['name'])) {
                $injury->setNameInjury(htmlentities(addslashes($_POST["name"])));
            }
            if (!empty($_POST["time"])) {
                $injury->setTime(htmlentities(addslashes($_POST["time"])));
            }

            $this->view->setVariable("injurystoshow", $this->injuryMapper->search($injury));
            $this->view->render("injury", "show");
        } else {
            $this->view->render("injury", "search");
        }
    }

    public function showlog()
    {
        $logs = $this->accesslogMapper->show();
        $this->view->setVariable("logstoshow", $logs);
        $this->view->render("injury", "showlog");
    }

    public function printPDF()
    {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 11);
        $ruta = __DIR__."/../media/";
        $file = fopen($ruta."accessLog.txt", "r");
        while(!feof($file)) {
            $pdf->Cell(40, 10, fgets($file),0,1);
        }

        $pdf->Output();
    }
}
