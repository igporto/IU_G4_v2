<?php
require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/DISCOUNT.php");
require_once(__DIR__ . "/../model/DISCOUNT_model.php");

require_once(__DIR__ . "/../controller/BaseController.php");



class DiscountController extends BaseController
{


    private $discountMapper;

    public function __construct()
    {
        parent::__construct();


        $this->discountMapper = new DiscountMapper();

        // Actions controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Discount baleiro
            $discount = new Discount();

            //Engadimos os datos ao Discount
            $discount->setType(htmlentities(addslashes($_POST["type"])));
            $discount->setPercent(htmlentities(addslashes($_POST["percent"])));
            if(isset($_POST["description"])){
                $discount->setDescription(htmlentities(addslashes($_POST["description"])));
            }

            try {
                if (!$this->discountMapper->discountExists($discount->getType())) {
                    if( $discount->getPercent()<100 && $discount->getPercent()>0 ){
                        $this->discountMapper->add($discount);
                        //ENVIAR AVISO DE ACCION ENGADIDO!!!!!!!!!!
                        $this->view->setFlash('succ_discount_add');

                        //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista das discount)
                        $this->view->redirect("discount", "show");
                    }else{
                        $this->view->setFlash("fail_discount_incorrect");
                    }
                } else {
                    $this->view->setFlash("fail_discount_exists");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        //Se non se enviou nada
        $this->view->render("discount", "add");
    }


    public function delete()
    {
        try {
            if (isset($_GET['coddiscount'])) {
                $this->discountMapper->delete(htmlentities(addslashes($_GET['coddiscount'])));
                $this->view->setFlash('succ_discount_delete');
                $this->view->redirect("discount", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("discount", "show");
    }


    public function show()
    {
        $discounts = $this->discountMapper->show();
        $this->view->setVariable("discountstoshow", $discounts);
        $this->view->render("discount", "show");
    }

    public function view()
    {
        $discount = $this->discountMapper->view(htmlentities(addslashes($_GET['coddiscount'])));
        $this->view->setVariable("discount", $discount);
        $this->view->render("discount", "view");
    }


    public function edit()
    {
        if (isset($_POST["submit"])) {
            //collemos os datos do desconto a editar
            $discount = $this->discountMapper->view(htmlentities(addslashes($_REQUEST["coddiscount"])));

            //se queremos editar o tipo de desconto comprobamos que non sexa "" e que non exista na BD
            if(isset($_REQUEST["type"]) && $_REQUEST["type"] !=""){
                $discount->setType(htmlentities(addslashes($_REQUEST["type"])));

                if ($this->discountMapper->discountExists($discount->getType())) {
                    $this->view->setFlash("fail_discount_exists");
                    $this->view->redirect("discount", "edit", "coddiscount=".htmlentities(addslashes($_REQUEST["coddiscount"])));
                }
            }

            if(isset($_POST["percent"])){
                $discount->setPercent(htmlentities(addslashes($_POST["percent"])));
            }

            if(isset($_POST["description"])){
                $discount->setDescription(htmlentities(addslashes($_POST["description"])));
            }

            try {
                if( $discount->getPercent()<100 && $discount->getPercent()>0 ) {
                    $this->discountMapper->edit($discount);
                    //ENVIAR AVISO DE Desconto EDITADo!!!!!!!!!!
                    $this->view->setFlash("succ_discount_edit");
                    //REDIRECCION Á PAXINA QUE TOQUE(Neste caso á lista dos descontos)
                    $this->view->redirect("discount", "show");
                }else{
                    $this->view->setFlash("fail_discount_incorrect");
                }
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }
        //Se non se enviou nada
        $this->view->render("discount", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $discount = new Discount();

            if(isset($_POST['code']) && $_POST['code']!=""){
                $discount->setCoddiscount(htmlentities(addslashes($_POST['code'])));
            }
            if(isset($_POST['type'])){
                $discount->setType(htmlentities(addslashes($_POST["type"])));
            }
            if(isset($_POST['percent']) && ($_POST['code']<101 && $_POST['code']>0)){
                $discount->setPercent(htmlentities(addslashes($_POST["percent"])));
            }
            if(isset($_POST["description"])){
                $discount->setDescription(htmlentities(addslashes($_POST["description"])));
            }
            try {
                $this->view->setVariable("discountstoshow", $this->discountMapper->search($discount));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("discount", "show");
            }
            //render dado que non se pode settear a variable antes de un redirect
            $this->view->render("discount","show");
        }else{
            $this->view->render("discount", "search");
        }

    }

}
