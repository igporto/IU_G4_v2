<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CLIENT_controller.php");
require_once(__DIR__ . "/../../model/CLIENT_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__ . "/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__ . "/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$activities = $view->getVariable("activitiestoshow");
$alumnMapper = new AlumnMapper();
$alumn = $alumnMapper->view($_GET['codalumn']);
?>

<div class="col-xs-12 col-md-8 " style="margin-top: 20px">

    <h1 class="page-header"><?php echo $strings['management_discounts'].": ".$alumn->getAlumnname()." ".$alumn->getAlumnsurname()?> </h1>


    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'].' '.$strings['DISCOUNT']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row" >
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['name']?></th>
                        <th class="text-center"><?php echo $strings['discount']?></th>
                        <th class="text-center"><?php echo $strings['importe']?></th>
                        <th class="text-center"><?php echo $strings['activity']?></th>
                        <th class="text-center"><?php echo $strings['activity_price']?></th>
                        <th class="text-center"><?php echo $strings['final_importe']?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    <?php


                    //Para cada usuario, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($activities as $c) {
                        echo "<tr class='row text-center' ><td> ";

                        $discount = $c->getDiscount();
                        $prezo = $c->getPrice();
                        $desconto = $discount->getPercent();
                        $porcentaxe = $desconto/100;
                        $resta = $prezo * $porcentaxe;

                        echo $discount->getType()."</td><td>";
                        echo $discount->getPercent()."%</td><td>";
                        echo $resta."€</td><td>";

                        echo $c->getActivityname()."</td><td>";
                        echo $c->getPrice()."€</td><td>";


                        $aux = $prezo - $resta;
                        echo $aux."€</td><td>";

                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->


