<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");

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
                    <div class="form-group"><!-- div1 -->
                        <label><?php echo $strings['CLIENT'] ?>: </label>
                        <select id='clientdni' name='clientdni' class='form-control' onchange='enviar()'>
                            <?php
                            //Engadimos unha opcion por controlador que se pode escoller
                            $cm = new ClientMapper();


                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $clients = $cm->show();

                            echo "<option value=NULL>".$strings["no_controller"]."</option>";
                            foreach ($clients as $client) {
                                if(isset($_REQUEST["clientdni"]) && $client->getDni() == $_REQUEST["clientdni"] ){
                                    echo "<option value=" . $client->getDni()." selected >" . $client->getName() . "</option>
                            ";
                                }else{
                                    echo "<option value=" . $client->getDni().">" . $client->getName() . "</option>
                            ";
                                }
                            }
                            ?>
                        </select>

                    </div><!-- cerrar div1 -->
                    <div class="col-xs-12 col col-md-5">
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder=<?php echo $strings['date'] ?>
                            required="true" maxlength="9">
                            <div id="error"></div>
                        </div>
                        <!--Campo fecha-->
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="text" class="form-control" id="coste" name="coste" placeholder=<?php echo $strings['cost'] ?>
                            required="true" maxlength="">
                            <div id="error"></div>
                        </div>
                        <!--Campo coste-->

                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder=<?php echo $strings['description'] ?>
                            required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo descripcion-->
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder=<?php echo $strings['dni'] ?>
                            required="true" maxlength="9">
                            <div id="error"></div>
                        </div>
                        <!--Campo dni-->
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
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>