<!--SCRIPT DE DATATABLE-->
<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");
require_once(__DIR__ . "/../../model/CONTROLLER_model.php");
require_once(__DIR__ . "/../../model/SPACE.php");


include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__."/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__."/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$events = $view->getVariable("eventstoshow");


?>

<div class="col-xs-12  ">

    <h1 class="page-header"><?php echo $strings['management_events'] ?></h1>

    <div class="row">


        <!--BOTÃ“N QUITAR FILTRO-->
        <a class="btn btn-warning btn-outline"  href="index.php?controller=event&action=show">
            <i class="fa fa-search-minus"></i>
            <?php echo $strings['clean'];?>
        </a>
        <!--BOTÃ“N BUSCAR-->
        <a class="btn btn-primary" href="index.php?controller=event&action=search">
            <i class="fa fa-fw fa-search"></i>
            <?php echo $strings['find']; ?>
        </a>

        <!--BOTÃ“N ENGADIR-->
        <?php if ($add) {
            echo '  
                            <a href="index.php?controller=event&action=add">
                                <button type="button" class="btn btn-success">
                                <i class="fa fa-fw fa-plus"></i>
                                    '. $strings['ADD'].'
                                </button>
                            </a>
                        ';
        } ?>

    </div>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'].' '.$strings['EVENT']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row" >
                        <!--CADA UN DE ESTES E UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['EVENTS_NAME']?></th>
                        <th class="text-center"><?php echo $strings['date']?></th>
                        <th class="text-center"><?php echo $strings['free_places']?></th>
                        <th class="text-center"><?php echo $strings['one_space']?></th>
                        <?php
                        if(!$edit && !$delete){ ?>
                            <th class="text-center"><?php echo $strings['no_actions_to_do']?></th>
                            <?php
                        }else{
                            ?>
                            <th class="text-center"><?php echo $strings['ACTION']?></th>
                        <?php } ?>

                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES E UNHA FILA-->

                    <?php


                    //Para cada evento, imprimimos o seu nome e as acciónns que se poden realizar nel (view,edit e delete)
                    foreach ($events as $e) {

                        echo "<tr class='row text-center' ><td> ";

                        echo $e->getName() . "</td><td>";
                        echo $e->getDate() . "</td><td>";
                        echo $e->getFreeplaces() . "</td><td>";
                        echo $e->getSpace()->getCodspace() . "</td>";

                        echo " <td class='text-center'>";
                        if ($v) {
                            echo '<button type="button" class="btn btn-primary btn-xs';
                            echo '" data-toggle="modal" data-target="#view' . $e->getCodevent() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-eye fa-fw"></i>
                                        </button>';
                        }

                        //Boton que direcciona a vista do editar
                        if ($edit) {

                            echo "<a href=index.php?controller=event&action=edit&codevent=" . $e->getCodevent() . '>';
                            echo "<button class='btn btn-warning btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-edit fa-fw'></i></button></a>";

                        }

                        //Boton que direcciona a vista de eliminar
                        if ($delete) {
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar' . $e->getCodevent() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                                        </button>';
                        }

                        if ($v) {
                            echo "<a href=index.php?controller=event&action=showpupil&codevent=" . $e->getCodevent() . '>';
                            echo "<button class='btn btn-info btn-xs ";
                            echo "' style='margin:2px'>";
                            echo "<i class='fa fa-male fa-fw'></i></button></a>";
                        }


                        //MODAL DE CONFIRMACION DE BORRADO PARA CADA ACCION
                        include(__DIR__ . '/DELETE_view.php');

                        //MODAL DE VISTA PARA CADA ACCION
                        include(__DIR__ . '/VIEW_view.php');


                        echo "</td></tr>";
                        //  }
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->

