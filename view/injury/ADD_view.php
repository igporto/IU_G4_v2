<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>

<!-- refresca o perfil do select -->
<script>
    function enviar() {
        var ruta = 'index.php?controller=injury&action=add';
    }
</script>

<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['create_injury']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=injury&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_injury'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12  col-md-5 ">
                        <label for="divdatestart"><?= $strings['name']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus required class="form-control" type="text" name="name" placeholder="<?php echo $strings['name'];?>" >
                        </div>
                    </div>
                    <!--Campo name-->


                    <div class="col-xs-12  col-md-5 ">
                        <label for="divdatestart"><?= $strings['time_recovery']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input required class="form-control" type="number" min="1" name="time_recovery" placeholder="<?php echo $strings['time_recovery'];?>">
                            <div id="error"></div>
                        </div>
                    </div>
                </div>

                        <div class="row">
                            <div class="col-xs-12  col-md-5">
                                <label for="divdatestart"><?= $strings['treatment']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input required class="form-control" type="text" name="treatment" placeholder="<?php echo $strings['treatment'];?>">
                        </div>
                            </div>

                            <div class="col-xs-12  col-md-5">
                                <label for="divdatestart"><?= $strings['description']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="text" name="description" placeholder="<?php echo $strings['description'];?>">
                        </div>
                            </div>
                    </div>
                    <!--Campo name-->
                </div>
            </div>


        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=injury&action=show">
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

