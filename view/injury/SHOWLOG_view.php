<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");
require_once(__DIR__ . "/../../model/ACCESSLOG.php");


include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__ . "/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__ . "/../../view/layouts/show_flag_setter.php");

$showinjury = false;
//Comprobamos os permisos sobre lesion

//obtemos o contido a mostrar
$logs = $view->getVariable("logstoshow");
?>


<script>
    function imprimir() {
        window.print();
    }
</script>
<div class="col-xs-12 col-md-8 ">

    <h1 class="page-header"><?php echo $strings['injury_access_log'] ?></h1>

    <div class="row">

        <!--BOTÓN IMPRIMIR-->
        <?php
        echo '
        <a href="index.php?controller=injury&action=printPDF">
        <button class="btn btn"> 
            <i class="fa fa-fw fa-file-pdf-o "></i>
        </button>
        </a>

        ';
        ?>

    </div>

    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'] . ' ' . $strings['injury_access_log']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover"
                       style="width:100%; margin-right: 10%;">
                    <thead>
                    <tr class="row">
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['one_user'] ?></th>
                        <th class="text-center"><?php echo $strings['employee'] ?></th>
                        <th class="text-center"><?php echo $strings['alumn'] ?></th>
                        <th class="text-center"><?php echo $strings['access_date'] ?></th>

                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    <?php

                    //Para cada actividade, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($logs as $c) {
                        echo "<tr class='row text-center' ><td> ";
                        echo $c->getUser()->getUsername(). "</td><td>";
                        if($c->getEmployee() != NULL){
                            echo $c->getEmployee()->getEmployeename()." ". $c->getEmployee()->getEmployeesurname(). "</td><td>";
                        }else{
                            echo "" . "</td><td>";
                        }
                        if($c->getAlumn() != NULL){
                            echo $c->getAlumn()->getAlumnname()." ". $c->getAlumn()->getAlumnsurname(). "</td><td>";
                        }else{
                            echo "" . "</td><td>";
                        }

                        echo $c->getDate();

                        echo "</td></tr>";
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


