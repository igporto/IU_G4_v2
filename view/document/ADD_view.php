<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../model/CLIENT_model.php");
require_once(__DIR__ . "/../../model/EMPLOYEE_model.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_document']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=document&action=add&codemployee="<?php echo htmlentities(addslashes($_GET['codemployee']))?>
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_document'] ?>
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
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-12">
                        <label for="selectperf"><?php echo $strings['document'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clipboard fa-fw"></i></span>
                            <input autofocus type="file" class="form-control" id="doc" name="document" required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo category-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['alumn'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <select id='codalumn' name='codalumn' class='form-control icon-menu''>
                            <?php
                            //Engadimos unha opcion por categoria a escoller
                            $am = new AlumnMapper();

                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $alumns = $am->show();

                            foreach ($alumns as $alumn) {
                                echo "<option value='" . $alumn->getCodalumn()."'>".$alumn->getAlumnname() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo espazo-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=category&action=show">
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