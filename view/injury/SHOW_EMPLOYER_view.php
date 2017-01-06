<!--SCRIPT DE DATATABLE-->
<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");
require_once(__DIR__ . "/../../model/CONTROLLER_model.php");
require_once(__DIR__ . "/../../model/EMPLOYER_HAS_INJURY.php");


include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__."/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__."/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$pupils = $view->getVariable("employeestoshow");
$pls = new InjuryMapper();

?>

<div class="col-xs-12 col-md-8 ">

    <h1 class="page-header"><?php echo $strings['list_of_employer'] ?></h1>

    <div class="row">


        <!--BOTÃƒâ€œN QUITAR FILTRO-->
        <a class="btn btn-warning btn-outline"  href="index.php?controller=injury&action=showemployer&id_lesion=<?php echo $_GET['id_lesion']?>">
            <i class="fa fa-search-minus"></i>
            <?php echo $strings['clean'];?>
        </a>
    </div>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'].' '.$strings['employee']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row" >
                        <!--CADA UN DE ESTES E UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['employee']?></th>
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


                    //Para cada evento, imprimimos o seu nome e as acciÃ³nns que se poden realizar nel (view,edit e delete)
                    foreach ($pupils as $s) {

                        echo "<tr class='row text-center' ><td> ";

                        echo $pls->getNameEmp($s->getCodEmpl()) . "</td><td class='text-center'>";

                        //Boton que direcciona a vista de eliminar
                        if ($delete) {
                            echo '<button type="button" class="btn btn-danger btn-xs';
                            echo '" data-toggle="modal" data-target="#confirmar' . $s->getCodEmpl() . '';
                            echo '" style="margin:2px">';
                            echo '<i class="fa fa-trash-o fa-fw"></i>
                                        </button>';
                        }

                        //MODAL DE CONFIRMACION DE BORRADO PARA CADA ACCION
                        include(__DIR__ . '/DELETE_EMPLOYER_view.php');


                        echo "</td></tr>";
                        //  }
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=injury&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>
            </div>

        </div>

    </div><!-- fin row -->
</div><!-- fin contedor -->

