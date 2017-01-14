<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");

include(__DIR__ . "/../../model/CLIENT_model.php");

$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$serviceMapper = new ServiceMapper();

?>

<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_service']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=service&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_service'] ?>
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
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['client']; ?></label>
                        <div class="form-group input-group">
                                <span class="input-group-btn">
                                <button class="btn btn-info" type="button"
                                        data-toggle="modal"
                                        data-target="#view<?php echo $strings['client']; ?>">
                                        <i class="fa fa-eye fa-fw"></i>
                                </button>
                                </span>

                            <select id='dni' name='dni' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por perfil que se pode escoller
                                $pc = new ClientMapper();

                                //Recuperamos todos os posibles clientes que se poden escoller para o usuario
                                $clients = $pc->show();

                                foreach ($clients as $cliente) {
                                    echo "<option value='" . $cliente->getDni() . "'>" . $cliente->getDni() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label for="divdatestart"><?= $strings['date'] ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="datestart" name="fecha"
                                   maxlength="10" required="" placeholder=<?= $strings['date'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo fecha -->
                        <label for="divdatestart"><?= $strings['cost'] ?></label>
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="text" class="form-control" id="coste" name="coste"
                                   placeholder=<?php echo $strings['cost'] ?>
                                   required="true" maxlength="">
                            <div id="error"></div>
                        </div>
                        <!--Campo coste-->
                        <label for="divdatestart"><?= $strings['description'] ?></label>
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                   placeholder=<?php echo $strings['description'] ?>
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo descripcion-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=service&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-plus"></i>
                        <?php echo $strings['ADD'] ?></i></button>
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </form>
    <!--fin formulario-->
</div>
<script>
    $(function () {
        $("#datestart").datepicker();
        $("#datestart").datepicker("option", "dateFormat", "yy-mm-d");
    });
</script>
<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>