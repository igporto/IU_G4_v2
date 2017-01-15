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


?>

<div class="col-xs-12">

    <?php if ($_REQUEST["action"] == "show" || $_REQUEST["action"] == "search") {
        echo "<h1 class='page-header'>" . $strings['management_payments'] . "</h1>";
    } else {
        echo "<h1 class='page-header'>" . $strings['pending_payments'] . "</h1>";
    } ?>
    <div class="row">

        <?php if ($_REQUEST["action"] == "show" || $_REQUEST["action"] == "search") {
            echo '
        <a class="btn btn-warning btn-outline" href="index.php?controller=payment&action=show">
            <i class="fa fa-search-minus"></i>
            ' . $strings['clean'] . '
        </a>
        
        <a class="btn btn-primary" href="index.php?controller=payment&action=search">
            <i class="fa fa-fw fa-search"></i>
            ' . $strings['find'] . '
        </a>';

            if ($add) {
                echo '  
                            <a href="index.php?controller=payment&action=add">
                                <button type="button" class="btn btn-success">
                                <i class="fa fa-fw fa-plus"></i>
                                    ' . $strings['ADD'] . '
                                </button>
                            </a>
                        ';
            }

            echo '<!--BOTÓN CAJA-->
        <div class="btn-group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                ' . $strings["till"] . ' <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="index.php?controller=payment&action=tillspend">' . $strings["create_spend"] . '</a>
                </li>
                <li>
                    <a href="index.php?controller=payment&action=tillwithdrawal">' . $strings["create_withdrawal"] . '</a>
                </li>
                <li><a href="index.php?controller=payment&action=tillclose">' . $strings["create_close"] . '</a>
                </li>
                <li><a href="index.php?controller=payment&action=tillconsult">' . $strings["consult"] . '</a>
                </li>
            </ul>
        </div>
</div>
<div class="row" style="margin-top: 5px;margin-bottom:-10px">
        <div class="alert alert-danger alert-dismissable" role="alert" id="pendingAlert" style="display: none">' .
                $strings['have_pending_payments'] .
                '<a href="index.php?controller=payment&action=pending" id="pendiente" style="display: none;">
            <button type="button" class="btn btn-danger" >
                <i class="fa fa-fw-alert fa"></i>' . $strings['pending_payments'] . '</button>
        </a></div>';
        } else {
            echo ' <a class="btn btn-default btn-md" href="index.php?controller=payment&action=show">
                        <i class="fa fa-arrow-left"></i>
                        ' . $strings['back'] . '</i></a>';
        }
        ?>
    </div>
    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'] . ' ' . $strings['PAYMENT']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover"
                       style="width:85%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row">
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['dni'] ?></th>
                        <th class="text-center"><?php echo $strings['quantity'] ?></th>
                        <th class="text-center"><?php echo $strings['pagado'] ?></th>
                        <th class="text-center"><?php echo $strings['date'] ?></th>
                        <?php
                        if (!$edit && !$delete && !$v) { ?>
                            <th class="text-center"><?php echo $strings['no_actions_to_do'] ?></th>
                            <?php
                        } else {
                            ?>
                            <th class="text-center"><?php echo $strings['ACTION'] ?></th>
                        <?php } ?>

                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    <?php


                    //Para cada pago, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($permissions as $p) {
                        echo "<tr class='row text-center' ><td> ";

                        if ($p->getTipoCliente() == "student") {
                            echo $p->getDniAlum() . "</td><td class='text-center'>";
                        } else {
                            echo $p->getDniClienteExterno() . "</td><td class='text-center'>";
                        }

                        echo $p->getCantidad() . " €</td><td class='text-center'>";

                        if ($p->getPagado() == 1) {
                            echo $strings["si"];
                        } else {
                            echo $strings["no"];
                        }

                        echo "</td><td class='text-center'>";
                        echo $p->getFecha() . "</td><td class='text-center'>";

                        //Botón que direcciona a vista do usuario
                        if ($v) {
                            echo '<button type="button" class="btn btn-primary btn-xs';
                            echo '" data-toggle="modal" data-target="#view' . $p->getIdPago() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-eye fa-fw"></i>
                                        </button>';
                        }

                        //Botón que direcciona á vista do editar
                        if ($edit) {

                            echo "<a href=index.php?controller=payment&action=edit&id_pago=" . $p->getIdPago() . '>';
                            echo "<button class='btn btn-warning btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                        }

                        //Botón que direcciona á vista de eliminar
                        if ($delete) {
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar' . $p->getIdPago() . '">';
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                                        </button>';
                        }

                        //Botón que direcciona á vista de cobrar
                        if ($p->getPagado() == "0") {
                            echo '<script>document.getElementById("pendiente").style = "display: block;float:left;";</script>';
                            echo "<a href=index.php?controller=payment&action=pay&id_pago=" . $p->getIdPago() . '>';
                            echo '<button type="button" class="btn btn-success btn-xs';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-usd fa-fw"></i></button></a>';

                        }

                        //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA ACCIÓN
                        include(__DIR__ . '/DELETE_view.php');

                        //MODAL DE VISTA PARA CADA ACCIÓN
                        include(__DIR__ . '/VIEW_view.php');

                        echo "</td></tr>";
                    }
                    ?><a style=""></a>

                    <script>
                        disp = document.getElementById("pendiente").style.display;
                        if (disp.toString() == "block") {
                            document.getElementById("pendingAlert").style = "font-size: 20px;display: block;text-align:right;height:65px";
                        }
                    </script>
            </div><!-- fin
                    </tbody>
                </table><!-- fin table -->
        </div>

    </div><!-- fin row -->

</div><!-- fin contedor -->
