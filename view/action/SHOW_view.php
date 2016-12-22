<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/ACTION_controller.php");
require_once(__DIR__ . "/../../model/ACTION_model.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

switch ($_SESSION['idioma']) {
    case 'SPANISH':
        include 'js/showscriptES.js';
        break;
    case 'GALEGO':
        include 'js/showscriptGL.js';
        break;
    case 'ENGLISH':
        include 'js/showscriptEN.js';
        break;
    default:
        include 'js/showscriptGL.js';
        break;
}

?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-xs-12 col-md-8 col-md-offset-2" style="margin-top: 20px">

    <table id="dataTable" class="table-responsive   table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
        <thead>
        <tr class="row">
            <!--CADA UN DE ESTES É UN CABECERO DA TABOA (TIPO "NOMBRE")-->
            <th class="text-center"><?php echo $strings['ACTION'] ?></th>
            <th class="text-center"><?php echo $strings['ACTION'] ?></th>
        </tr>
        </thead>

        <tbody>
        <!--CADA UN DE ESTES É UNHA FILA-->

        <?php
        $ac = new ActionController();
        $am = new ActionMapper();
        //Recollemos as accions
        $actions = $am->show();

        $delete = true;
        $edit = true;
        $view = true;

        //Para cada accion, imprimimos o seu nome e as accións que se poden realizar nela (view,edit e delete)

        foreach ($actions as $a) {

            echo "<tr class='row text-center' ><td> ";

            echo $a->getActionname() . "</td><td class='text-center'>";
            //Botón que direcciona a vista da accion
            if ($view) {
                echo "<a href='index.php?controller=ACTION&action=VIEW&actionName=" .
                    $a->getActionname() . "'><button class='btn btn-primary btn-xs' style='margin:2px'>";
                echo "<i class='fa fa-eye fa-fw'></i></button></a>";
            }

            //Botón que direcciona á vista do editar
            if ($edit) {
                echo "<a href=index.php?controller=action&action=edit&actionName=" . $a->getActionname() . '>';

                echo "<button class='btn btn-warning btn-xs ";

                if ($a->getActionname() == $_SESSION["currentaction"]) {
                    echo " disabled' data-toggle='tooltip' title='" . $strings['cannot_modify_action'];
                }
                echo "' style='margin:2px'>";

                echo "<i class='fa fa-edit fa-fw'></i></button></a>";

            }

            //Botón que direcciona á vista de eliminar
            if ($delete) {
                echo '<button type="button" class="btn btn-danger btn-xs';
                if ($a->getActionname() == $_SESSION['currentaction']) {
                    echo ' disabled">';
                } else {
                    echo '" data-toggle="modal" data-target="#confirmar' . $a->getActionname() . '">';
                }

                echo '<i class="fa fa-trash-o fa-fw"></i>
                </button>';

            }

            //MODAL DE CONFIRMACIÓN DE BORRADO PARA CADA ACCION
            echo '
            <div class="modal fade" id="confirmar' . $a->getActionname() . '" tabindex="-1" role="dialog" aria-labelledby="' . $a->getActionname() . 'label" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="' . $a->getActionname() . 'label">' . $strings["confirm_message"] . ' ' . $a->getActionname() . '?</h4>
                                        </div>
                                        <div class="modal-body">
                                             <label for="">' . $strings["action_data"] . ': </label>';
            //DATOS DO ACCION A BORRAR
            echo '  
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                    <label for="">' . $strings["name"] . ': </label>
                                                    <span class="">' . $a->getActionname() . '</span>

                                                <!--Campo action-->
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>';

            //fin dos datos da accion
            echo '
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                            
                                            <a href="index.php?controller=action&action=delete&actionName=' . $a->getActionname() . '">
                                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>';
            echo "</td></tr>";
        }
        ?>

        </tbody>
    </table>

</div>