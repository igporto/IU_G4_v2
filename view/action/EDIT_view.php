<!-- CONTIDO DA PAXINA -->

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
$actionname = $_REQUEST["actionName"];
?>
<script>
    function enviar() {
        var ruta = 'index.php?controller=action&action=edit&actionName=';
        var nome = <?php echo '"' . $actionname . '"';?>;
        var query = '&perf_id=';
        var perfil = document.getElementById("perf_id").value;

        var parte1 = ruta.concat(nome);
        var parte2 = query.concat(perfil);
        window.location.href = parte1.concat(parte2);
    }
</script>

<div class="col-md-8 col-md-offset-2" style="margin-top: 20px">
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=action&action=edit&actionName=<?php echo $actionname; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['action_modify'] . " " . $_REQUEST["actionName"] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="text" name="newname"
                                   placeholder=<?php echo $strings['name']; ?>>
                        </div>
                        <!--Campo password-->
                    </div>
                </div>

                <?php
                $am = new ActionMapper();
                //Recuperamos o id do usuario a editar
                $id_action = $am->getIdByName($_REQUEST["actionName"]);

                $action = $_REQUEST["actionName"];

                ?>

                <div style="margin-top:20px; margin-bottom: 20px" class="col-md-6 col-md-offset-3">
                    <button class="btn btn-primary btn-md btn-block" name="submit" type="submit">
                        <?php echo $strings['edit'] ?></i></button>

                    <button class="btn btn-outline btn-warning btn-md btn-block" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>
                </div>
    </form>
    <!--fin formulario-->
</div>
