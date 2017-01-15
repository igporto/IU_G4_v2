<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../controller/USER_controller.php");

require_once(__DIR__ . "/../../model/CATEGORY_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$view = ViewManager::getInstance();

//include do selector de idioma da datatable
include(__DIR__ . "/../../view/layouts/datatable_lang_select.php");

//include do setter de permisos do usuario
include(__DIR__ . "/../../view/layouts/show_flag_setter.php");

//obtemos o contido a mostrar
$documents = $view->getVariable("documentstoshow");
?>

<div class="col-xs-12">

    <h1 class="page-header"><?php echo $strings['management_documents'] ?></h1>
    <!--PANEL TABOA DE LISTADO-->
    <div class="row" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $strings['list_of'] . ' ' . $strings['DOCUMENT']; ?>

            </div>
            <div class="panel-body">
                <table id="dataTable" class="table-responsive   table-hover"
                       style="width:80%; margin-right: 10%; margin-left: 10%">
                    <thead>
                    <tr class="row">
                        <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
                        <th class="text-center"><?php echo $strings['name'] ?></th>
                        <th class="text-center"><?php echo $strings['ALUMN'] ?></th>
                        <th class="text-center"><?php echo $strings['employee'] ?></th>
                        <th class="text-center"><?php echo $strings['ACTION'] ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <!--CADA UN DE ESTES É UNHA FILA-->

                    <?php

                    //Para cada usuario, imprimimos o seu nome e as accións que se poden realizar nel (view,edit e delete)
                    foreach ($documents as $c) {
                        echo "<tr class='row text-center' > <td> ";

                        echo $c->getName() . "</td> <td>";

                        echo $c->getAlumn()->getAlumnname() . "</td> <td> ";

                        if($c->getEmployee()->getCodemployee() == NULL){
                            echo $strings['without_employee'];
                        }else{
                            echo $c->getEmployee()->getEmployeename();
                        }
                        echo "</td> <td class='text-center'> ";
                        echo "<a href=index.php?controller=document&action=view&coddocument=" . $c->getCoddocument() . '>';
                        echo "<button class='btn btn-primary btn-xs ";
                        echo "' style='margin:2px'>";
                        echo "<i class='fa fa-eye fa-fw'></i></button></a>";
                        echo "</td>";


                        echo "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table><!-- fin table -->
            </div>
        </div><!-- fin panel -->

    </div><!-- fin row -->
</div><!-- fin contedor -->


