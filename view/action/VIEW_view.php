<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/ACTION_controller.php");
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
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px">
    <form name="form" id="form" method="POST" enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['action_info'] ?>
            </div>
            <div class="panel-body">

                <?php $am = new ActionMapper();
                $id_action = $am->getIdByName($_REQUEST["actionName"]);
                ?>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label for=""><?php echo $strings['name']; ?>: </label>
                        <span class=""><?php echo $am->view($id_action)->getActionname(); ?></span>

                        <!--Campo accion-->
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!--fin formulario-->
</div>