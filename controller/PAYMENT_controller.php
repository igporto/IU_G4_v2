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

            //Engadimos a cantidade ao Payment
            $payment->setCantidad(htmlentities(addslashes($_POST["cantidad"])));

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
            if (isset($_GET['paymentName'])) {
                $payment_id = $this->paymentMapper->getIdByName($_REQUEST["paymentName"]);
                $payment = $this->paymentMapper->view($payment_id);
                $this->paymentMapper->delete($payment);
                $this->view->setFlash('succ_payment_delete');
                $this->view->redirect("payment", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("payment", "show");
    }

    public function show()
    {
        $payments = $this->paymentMapper->show();
        $this->view->setVariable("paymentstoshow", $payments);
        $this->view->render("payment", "show");
    }

    public function view()
    {
        $paymentid = $this->paymentMapper->getIdByName($_REQUEST["payment"]);
        $payment = $this->paymentMapper->view($paymentid);
        $this->view->setVariable("payment", $payment);
        $this->view->render("payment", "view");
    }

    public function edit()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto payment baleiro
            $payment_id = $this->paymentMapper->getIdByName($_REQUEST["paymentName"]);
            $payment = $this->paymentMapper->view($payment_id);

            if ($this->paymentMapper->paymentnameExists($payment->getPaymentname())) {
                $this->view->setFlash("fail_payment_exists");
                $this->view->redirect("payment", "edit", "paymentName=" . $_REQUEST["paymentName"]);
            }

            $payment->setPaymentname($_REQUEST["newname"]);

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
            if (isset($_POST['paymentname'])) {
                $payment->setPaymentname((htmlentities(addslashes($_POST["paymentname"]))));
            }
            if (isset($_POST["id_pago"])) {
                $payment->setCodpayment(htmlentities(addslashes($_POST["id_pago"])));
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
}
