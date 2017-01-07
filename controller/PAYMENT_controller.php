<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/PAYMENT.php");
require_once(__DIR__ . "/../model/PAYMENT_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");


/**
 * Class PaymentsController
 *
 * Controller to login, logout and payment data managing
 */
class PaymentController extends BaseController
{

    /**
     * Reference to the PaymentMapper to interact
     * with the database
     *
     * @var PaymentMapper
     */
    private $paymentMapper;

    public function __construct()
    {
        parent::__construct();

        $this->paymentMapper = new PaymentMapper();

        // Payments controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Payment baleiro
            $payment = new Payment();

            date_default_timezone_set("Europe/Madrid");
            $date = date("Y-m-d h:i:s");

            $payment->setFecha($date);
            $payment->setCantidad(htmlentities(addslashes($_POST["cantidad"])));
            $payment->setMetodoPago(htmlentities(addslashes($_POST["metodo_pago"])));
            $payment->setTipoCliente(htmlentities(addslashes($_POST["tipo_cliente"])));

            if ($_POST["tipo_cliente"] == "student") {
                $payment->setDniAlum(htmlentities(addslashes($_POST["dni"])));
            } else {
                $payment->setDniClienteExterno(htmlentities(addslashes($_POST["dni_external"])));
            }

            $payment->setPagado(htmlentities(addslashes($_POST["pagado"])));

            try {

                $this->paymentMapper->add($payment);
                //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                $this->view->setFlash('succ_payment_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos payments)
                $this->view->redirect("payment", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("payment", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['id_pago'])) {
                $payment_id = $_REQUEST["id_pago"];
                $payment = $this->paymentMapper->view($payment_id);
                $this->paymentMapper->delete($payment);
                $this->view->setFlash('succ_payment_delete');
                $this->view->redirect("payment", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("payment", "delete");
    }

    public function show()
    {
        $payments = $this->paymentMapper->show();
        $this->view->setVariable("paymentstoshow", $payments);
        $this->view->render("payment", "show");
    }

    public function view()
    {
        $payment = $this->paymentMapper->view($_REQUEST["id_pago"]);
        $this->view->setVariable("payment", $payment);
        $this->view->render("payment", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto payment baleiro
            $payment_id = $_REQUEST["id_pago"];
            $payment = $this->paymentMapper->view($payment_id);

            date_default_timezone_set('Europe/Madrid');
            $date = date('Y-m-d h:i:s', time());

            $payment->setFecha($date);
            if (isset($_POST["cantidad"]) && ($_POST['cantidad']) != "") {
                $payment->setCantidad(htmlentities(addslashes($_POST["cantidad"])));
            } else {
                $aux = $payment->getCantidad();
                $payment->setCantidad($aux);
            }
            if (isset($_POST["metodo_pago"]) && ($_POST['metodo_pago']) != "") {
                $payment->setMetodoPago(htmlentities(addslashes($_POST["metodo_pago"])));
            } else {
                $aux = $payment->getMetodoPago();
                $payment->setMetodoPago($aux);
            }
            if (isset($_POST["tipo_cliente"]) && ($_POST['tipo_cliente']) != "") {
                $payment->setTipoCliente(htmlentities(addslashes($_POST["tipo_cliente"])));
            } else {
                $aux = $payment->getTipoCliente();
                $payment->setTipoCliente($aux);
            }

            if ($_POST["tipo_cliente"] == "student") {
                if (isset($_POST["dni"]) && ($_POST['dni']) != "") {
                    $payment->setDniAlum(htmlentities(addslashes($_POST["dni"])));
                } else {
                    $aux = $payment->getDniAlum();
                    $payment->setDniAlum($aux);
                }
            } else {
                if (isset($_POST["dni"]) && ($_POST['dni']) != "") {
                    $payment->setDniClienteExterno(htmlentities(addslashes($_POST["dni"])));
                } else {
                    $aux = $payment->getDniClienteExterno();
                    $payment->setDniClienteExterno($aux);
                }
            }

            if (isset($_POST["pagado"]) && ($_POST['pagado']) != "") {
                $payment->setPagado(htmlentities(addslashes($_POST["pagado"])));
            } else {
                $aux = $payment->getPagado();
                $payment->setPagado($aux);
            }

            try {
                $this->paymentMapper->edit($payment);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_payment_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("payment", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("payment", "edit");
    }

    public function search()
    {
        if (isset($_POST["submit"])) {
            $payment = new Payment();
            if (isset($_POST['id_pago'])) {
                $payment->setIdPago((htmlentities(addslashes($_POST["id_pago"]))));
            }

            try {
                $this->view->setVariable("paymentstoshow", $this->paymentMapper->search($payment));
            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("payment", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("payment", "show");
        } else {
            $this->view->render("payment", "search");
        }

    }

    public function pay()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto payment baleiro
            $payment_id = $_REQUEST["id_pago"];
            $payment = $this->paymentMapper->view($payment_id);

            date_default_timezone_set('Europe/Madrid');
            $date = date("Y-m-d h:i:s");

            $payment->setFecha($date);

            if (isset($_POST["metodo_pago"]) && ($_POST['metodo_pago']) != "") {
                $payment->setMetodoPago(htmlentities(addslashes($_POST["metodo_pago"])));
            } else {
                $aux = $payment->getMetodoPago();
                $payment->setMetodoPago($aux);
            }

            $payment->setPagado("1");

            try {
                $this->paymentMapper->edit($payment);
                //ENVIAR AVISO DE ACCION EDITADA!!!!!!!!!!
                $this->view->setFlash("succ_payment_edit");
                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos accions)
                $this->view->redirect("payment", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("payment", "pay");
    }

    public function tillspend()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Payment baleiro
            $till = new Till();

            $till->setCantidad(htmlentities(addslashes($_POST["cantidad"])));
            date_default_timezone_set("Europe/Madrid");
            $date = date("Y-m-d h:i:s");
            $till->setFecha($date);
            $till->setConcepto(htmlentities(addslashes($_POST["concepto"])));

            try {

                $this->paymentMapper->tillspend($till);
                //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                $this->view->setFlash('succ_payment_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos payments)
                $this->view->redirect("payment", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("payment", "tillspend");
    }

    public function tillwithdrawal()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Payment baleiro
            $till = new Till();

            $till->setCantidad(htmlentities(addslashes($_POST["cantidad"])));
            date_default_timezone_set("Europe/Madrid");
            $date = date("Y-m-d h:i:s");
            $till->setFecha($date);

            try {

                $this->paymentMapper->tillwithdrawal($till);
                //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                $this->view->setFlash('succ_payment_add');

                //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos payments)
                $this->view->redirect("payment", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        //$this->view->setLayout("navbar");
        $this->view->render("payment", "tillwithdrawal");
    }

    public function tillconsult()
    {
        $tills = $this->paymentMapper->tillconsult();
        $this->view->setVariable("paymentstoshow", $tills);
        $this->view->render("payment", "tillconsult");
    }

    public function tillclose()
    {
        $tills = $this->paymentMapper->tillconsult();
        $this->view->setVariable("paymentstoshow", $tills);
        $this->view->render("payment", "tillclose");
    }

}
