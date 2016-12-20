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

?>

<!--ESTRUTURA DA TABLA EN SI-->

<!--O id debe ser este para que funcione o script-->
<div class="col-md-6 col-md-offset-3" style="margin-top: 20px" >
    <div class="panel ">
        <div class="panel-heading">
            <!--Mensaxes de cabeceira nos recadros das vistas-->
            <?php echo $strings['confirm_message'].$_REQUEST['user']."?";?>
        </div>
    </div>
    <div style="margin-bottom: 20px" class="col-md-6 col-md-offset-3">

        <!--Enviamos ao router o controller user e a accion delete para que este faga as accións pertinentes (o borrado)-->
        <a href='index.php?controller=user&action=delete&user=<?php echo $_REQUEST["user"];?>&op=s'>
            <button class='btn btn-success btn-xs'>
                <i class="fa fa-check fa-"></i></button>
        </a>

        <!--Tras esto volvemos a redireccionar á vista de show_user, é dicir, a USER_SHOW_view-->
        <a href='index.php?controller=USER&action=SHOW'>
            <button class='btn btn-danger btn-xs'>
                <i class="fa fa-times fa-"></i></button>
        </a>
    </div>
    <!--fin formulario-->
</div>
<script>
    function confirmar() {
        if (confirm("Seguro que desexa eliminalo?") == true) {
            return true;
        } else {
            return false;
        }
    }
</script>