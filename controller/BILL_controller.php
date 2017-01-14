<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/BILL.php");
require_once(__DIR__ . "/../model/BILL_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


/**
 * Class BillsController
 *
 * Controller to login, logout and bill data managing
 */
class BillController extends BaseController
{

    /**
     * Reference to the BillMapper to interact
     * with the database
     *
     * @var BillMapper
     */
    private $billMapper;

    public function __construct()
    {
        parent::__construct();

        $this->billMapper = new BillMapper();

        // Bills controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {


        if (isset($_POST["submit"])) {
            //Creamos un obxecto Bill baleiro
            $bill = new Bill();

            //Engadimos a cantidade ao Bill
            $bill->setNombre(htmlentities(addslashes($_POST["name"])));
            $bill->setNumero(htmlentities(addslashes($_POST["number"])));

            date_default_timezone_set('Europe/Madrid');
            $date = date("Y-m-d");
            $bill->setFecha($date);

            try {
                if ($this->billMapper->add($bill) == false) {
                    $this->view->setFlash('fail_bill_num');
                } else {
                    //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                    $this->view->setFlash('succ_bill_add');

                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos bills)
                    $this->view->redirect("bill", "show");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("bill", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['id_factura'])) {
                $bill_id = $_GET["id_factura"];
                $bill = $this->billMapper->view($bill_id);
                $this->billMapper->delete($bill);
                $this->view->setFlash('succ_bill_delete');
                $this->view->redirect("bill", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("bill", "show");
    }

    public function show()
    {
        $bills = $this->billMapper->show();
        $this->view->setVariable("billstoshow", $bills);
        $this->view->render("bill", "show");
    }

    public function view()
    {
        $billid = $this->billMapper->getIdByName($_REQUEST["bill"]);
        $bill = $this->billMapper->view($billid);
        $this->view->setVariable("bill", $bill);
        $this->view->render("bill", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto bill baleiro
            $bill = $this->billMapper->view($_REQUEST["id_factura"]);

            $bill->setNombre($_REQUEST["name"]);
            $bill->setNumero($_REQUEST["number"]);

            try {
                $this->billMapper->edit($bill);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_bill_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("bill", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("bill", "edit");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {

            $bill = new Bill();
            if (isset($_POST['name'])) {
                $bill->setNombre((htmlentities(addslashes($_POST["name"]))));
            }
            if (isset($_POST["number"])) {
                $bill->setNumero(htmlentities(addslashes($_POST["number"])));
            }

            try {

                $this->view->setVariable("billstoshow", $this->billMapper->search($bill));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("bill", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("bill", "show");
        } else {
            $this->view->render("bill", "search");
        }

    }

    public function showlines()
    {
        $lines = $this->billMapper->showlines($_REQUEST["id_factura"]);
        $this->view->setVariable("linestoshow", $lines);
        $this->view->render("bill", "showlines");
    }

    public function addline()
    {


        if (isset($_POST["submit"])) {
            //Creamos un obxecto Bill baleiro
            $line = new BillLine();

            //Engadimos a cantidade ao Bill
            $line->setConcepto(htmlentities(addslashes($_POST["concepto"])));
            $line->setPrecio(htmlentities(addslashes($_POST["precio"])));
            $line->setIva(htmlentities(addslashes($_POST["iva"])));
            $line->setPrecio(htmlentities(addslashes($_POST["precio"])));
            $line->setIdFactura(htmlentities(addslashes($_GET["id_factura"])));
            $line->setUnidades(htmlentities(addslashes($_POST["cantidad"])));
            $precio = doubleval($_POST["precio"]);
            $iva = doubleval($_POST["iva"]);
            $unidades = doubleval($_POST["cantidad"]);
            $total = (($precio + ($precio * ($iva / 100))) * $unidades);
            $line->setTotal($total);

            try {
                $this->billMapper->addline($line);
                //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                $this->view->setFlash('succ_bill_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos bills)
                $this->view->redirect("bill", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("bill", "addline");
    }

    public function deleteline()
    {
        try {
            if (isset($_GET['id_linea'])) {
                $line_id = $_GET["id_linea"];
                $this->billMapper->deleteline($line_id);
                $this->view->setFlash('succ_bill_delete');
                $this->view->redirect("bill", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("bill", "show");
    }

    public function editline()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto bill baleiro
            $line = $this->billMapper->viewline($_REQUEST["id_linea"]);

            $line->setConcepto(htmlentities(addslashes($_POST["concepto"])));
            $line->setPrecio(htmlentities(addslashes($_POST["precio"])));
            $line->setIva(htmlentities(addslashes($_POST["iva"])));
            $line->setPrecio(htmlentities(addslashes($_POST["precio"])));
            $line->setUnidades(htmlentities(addslashes($_POST["cantidad"])));
            $precio = doubleval($_POST["precio"]);
            $iva = doubleval($_POST["iva"]);
            $unidades = doubleval($_POST["cantidad"]);
            $total = (($precio + ($precio * ($iva / 100))) * $unidades);
            $line->setTotal($total);

            try {
                $this->billMapper->editline($line);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_bill_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("bill", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("bill", "editline");
    }
}
