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
$permissions = $view->getVariable("linestoshow");


?>

<div class="col-xs-12 col-md-8 ">

    <h1 class="page-header"><?php echo $strings['management_line'] . ": " . $_REQUEST["nombre_factura"] ?></h1>

    <div class="row">

        <!--BOTÓN ENGADIR-->
        <?php if ($add) {
            echo '  
                            <a href="index.php?controller=bill&action=addline&id_factura=' . $_REQUEST["id_factura"] . '&nombre_factura='.$_REQUEST["nombre_factura"].'">
                                <button type="button" class="btn btn-success">
                                <i class="fa fa-fw fa-plus"></i>
                                    ' . $strings['ADD'] . '
                                </button>
                            </a>
                        ';
        } ?>

    </div>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px; width: 130%">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'] . ' ' . $strings['BILL']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover"
                       style="width:100%; margin-right: 20%; ">
                    <thead>
                    <tr class="row">
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['concept'] ?></th>
                        <th class="text-center"><?php echo $strings['price'] ?></th>
                        <th class="text-center">IVA</th>
                        <th class="text-center"><?php echo $strings['units'] ?></th>
                        <th class="text-center"><?php echo $strings['total'] ?></th>

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


                    //Para cada factura, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($permissions as $p) {
                        echo "<tr class='row text-center' ><td> ";

                        echo $p->getConcepto() . "</td><td class='text-center'>";
                        echo $p->getPrecio() . " €</td><td class='text-center'>";
                        echo $p->getIva() . " %</td><td class='text-center'>";
                        echo $p->getUnidades() . " </td><td class='text-center'>";
                        echo $p->getTotal() . " €</td><td class='text-center'>";

                        //Botón que direcciona a vista do usuario
                        if ($v) {
                            echo '<button type="button" class="btn btn-primary btn-xs';
                            echo '" data-toggle="modal" data-target="#view' . $p->getIdLinea() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-eye fa-fw"></i>
                                        </button>';
                        }

                        //Botón que direcciona á vista do editar
                        if ($edit) {

                            echo "<a href=index.php?controller=bill&action=editline&id_factura=" . $p->getIdFactura() .
                                "&id_linea=" . $p->getIdLinea() . "&nombre_factura=" . $_REQUEST["nombre_factura"] . ">";
                            echo "<button class='btn btn-warning btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                        }

                        //Botón que direcciona á vista de eliminar
                        if ($delete) {
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar' . $p->getIdLinea() . '">';
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                                        </button>';
                        }

                        //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA ACCIÓN
                        include(__DIR__ . '/DELETELINE_view.php');

                        //MODAL DE VISTA PARA CADA ACCIÓN
                        include(__DIR__ . '/VIEWLINE_view.php');

                        echo "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
                <div class="row">

                    <div class="col-xs-12">
                        <div class="pull-left">
                            <a class="btn btn-default btn-md" href="index.php?controller=bill&action=show">
                                <i class="fa fa-arrow-left"></i>
                                <?php echo $strings['back'] ?></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->
