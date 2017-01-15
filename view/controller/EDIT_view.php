<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/CONTROLLER_controller.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$controllername = $_REQUEST["controllerName"];
?>
<script>
    function enviar() {
        var ruta = 'index.php?controller=controller&action=edit&controllerName=';
        var nome = <?php echo '"' . $controllername . '"';?>;
        var query = '&perf_id=';
        var perfil = document.getElementById("perf_id").value;

        var parte1 = ruta.concat(nome);
        var parte2 = query.concat(perfil);
        window.location.href = parte1.concat(parte2);
    }
</script>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['controller_modify'] . ': ' . $_GET['controllerName'] ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=controller&action=edit&controllerName=<?php echo $controllername; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                        <!--  <div class="row">
                            <?php echo $strings['max_length'] ?>: 25
                        </div>-->

                    </div>

                    <div class="col-xs-12 col-md-5">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus required class="form-control" type="text" name="newname" maxlength="25"
                                   value=<?php echo $controllername ?>>
                                   </div>
                            <!--Campo password-->
                        </div>
                    </div>

                    <?php
                    $am = new ControllerMapper();
                    //Recuperamos o id do usuario a editar
                    $id_controller = $am->getIdByName($_REQUEST["controllerName"]);

                    $controller = $_REQUEST["controllerName"];

                    ?>
                </div>
            </div>

            <div class="row">

                <div class="col-xs-12">
                    <div class="pull-left">
                        <a class="btn btn-default btn-md" href="index.php?controller=controller&action=show">
                            <i class="fa fa-arrow-left"></i>
                            <?php echo $strings['back'] ?></i></a>
                    </div>

                    <div class="pull-right">
                        <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                            <?php echo $strings['clean'] ?></i></button>

                        <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                            <i class="fa fa-edit"></i>
                            <?php echo $strings['EDIT'] ?></i></button>
                        <?php

                        ?>
                    </div>
                </div>

            </div>
    </form>
    <!--fin formulario-->
</div>

<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>
