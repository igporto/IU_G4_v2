<!--SCRIPT DE DATATABLE-->
<?php
require_once(__DIR__ . "/../../controller/USER_controller.php");
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
    $pm = new PermissionMapper();
?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px" >
    <form name="form" id="form" method="POST" enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                            <label for="">
                                <?php
                                    $permission = $pm->view($_REQUEST["perm_id"]);
                                    echo '<span class=\"\">'.$strings["one_controller"].'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                    echo '<span class=\"\">'.$strings["one_action"].'</span>';
                                ?>
                            </label>
                            <ul>
                                <?php
                                   echo '<li><span class=\"\">'.$permission->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                   echo '<span class=\"\">'.$permission->getAction()->getActionname().'</span></li>';

                                ?>
                            </ul>

                    </div>

                </div>
            </div>
        </div>
    </form>
    <!--fin formulario-->
</div>