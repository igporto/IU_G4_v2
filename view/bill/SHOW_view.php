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
$permissions = $view->getVariable("billstoshow");


?>

<div class="col-xs-12 ">

    <h1 class="page-header"><?php echo $strings['management_bill'] ?></h1>

    <div class="row">


        <!--BOTÓN QUITAR FILTRO-->
        <a class="btn btn-warning btn-outline" href="index.php?controller=bill&action=show">
            <i class="fa fa-search-minus"></i>
            <?php echo $strings['clean']; ?>
        </a>
        <!--BOTÓN BUSCAR-->
        <a class="btn btn-primary" href="index.php?controller=bill&action=search">
            <i class="fa fa-fw fa-search"></i>
            <?php echo $strings['find']; ?>
        </a>

        <!--BOTÓN ENGADIR-->
        <?php if ($add) {
            echo '  
                            <a href="index.php?controller=bill&action=add">
                                <button type="button" class="btn btn-success">
                                <i class="fa fa-fw fa-plus"></i>
                                    ' . $strings['ADD'] . '
                                </button>
                            </a>
                        ';
        } ?>

    </div>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
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
                        <th class="text-center"><?php echo $strings['bill_number'] ?></th>
                        <th class="text-center"><?php echo $strings['name'] ?></th>
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


                    //Para cada factura, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($permissions as $p) {
                        echo "<tr class='row text-center' ><td> ";

                        echo $p->getNumero() . "</td><td class='text-center'>";
                        echo $p->getNombre() . "</td><td class='text-center'>";
                        echo $p->getFecha() . " </td><td class='text-center'>";

                        //Botón que direcciona a vista do usuario
                        if ($v) {
                            echo '<button type="button" class="btn btn-primary btn-xs';
                            echo '" data-toggle="modal" data-target="#view' . $p->getIdFactura() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-eye fa-fw"></i>
                                        </button>';
                        }

                        //Botón que direcciona á vista do editar
                        if ($edit) {

                            echo "<a href=index.php?controller=bill&action=edit&id_factura=" . $p->getIdFactura() . '>';
                            echo "<button class='btn btn-warning btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                        }

                        //Botón que direcciona á vista de eliminar
                        if ($delete) {
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar' . $p->getIdFactura() . '">';
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                                        </button>';
                        }

                        //Botón que direcciona á vista das liñas
                        echo "<a href='index.php?controller=bill&action=showlines&id_factura=" . $p->getIdFactura() .
                            "&nombre_factura=" . $p->getNombre() . "'>";
                        echo '<button type="button" class="btn btn-success btn-xs';
                        echo '" style="margin:2px ">' . $strings["lines"] . '</button>';
                        echo '<i class="fa fa fa-fw"></i>
                                            </button></a>';


                        //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA ACCIÓN
                        include(__DIR__ . '/DELETE_view.php');

                        //MODAL DE VISTA PARA CADA ACCIÓN
                        include(__DIR__ . '/VIEW_view.php');

                        echo "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->
