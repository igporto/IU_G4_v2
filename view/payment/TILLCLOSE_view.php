<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");
require_once(__DIR__ . "/../../model/CONTROLLER_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__ . "/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__ . "/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$permissions = $view->getVariable("paymentstoshow");
date_default_timezone_set("Europe/Madrid");
$dateActual = date("Y-m-d");

?>

<div class="col-xs-12 ">

    <h1 class="page-header"><?php echo $strings['list_of'] . ' ' . $strings['till']. " " .$dateActual?></h1>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px; width: 150%">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'] . ' ' . $strings['till']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover"
                       style="width:85%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row">
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['quantity'] ?></th>
                        <th class="text-center"><?php echo $strings['date'] ?></th>
                        <th class="text-center"><?php echo $strings['concept'] ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    <?php
                    //Para cada pago, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    $total = 0;

                    foreach ($permissions as $p) {
                        if ($p->getFecha() == $dateActual) {
                            echo "<tr class='row text-center' ><td> ";
                            $total = $total + intval($p->getCantidad());
                            echo $p->getCantidad() . " €</td><td class='text-center'>";
                            echo $p->getFecha() . "</td><td class='text-center'>";
                            if ($p->getConcepto() == "WITHDRAWAL") {
                                echo $strings["withdrawal"] . "</td><td class='text-center'>";
                            } elseif ($p->getConcepto() == "PAYMENT") {
                                echo $strings["payment"] . "</td><td class='text-center'>";
                            } else {
                                echo $p->getConcepto() . "</td><td class='text-center'>";
                            }
                            echo "</td></tr>";
                        }
                    }

                    echo "<tr class='row' ><th class='text-center'>-----------------------</th><td class='text-center'>";
                    echo "<tr class='row' ><th class='text-center'>TOTAL: " . $total . " €</th><td class='text-center'>";
                    ?>

                    <tr class='row'>
                        <th class='text-center'>
                            -----
                        </th>
                        <td class='text-center'>
                    <tr class='row'>
                        <th class='text-center'>
                            <a class="btn btn-default btn-md" href="index.php?controller=payment&action=show">
                                <i class="fa fa-arrow-left"></i>
                                <?php echo $strings['back'] ?></i></a>
                        </th>
                        <td class='text-center'>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->
