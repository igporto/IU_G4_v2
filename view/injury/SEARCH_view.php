<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["INJURY"] ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=injury&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info " style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12  col-md-5 ">
                        <label for="divdatestart"><?= $strings['name']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input autofocus class="form-control" type="text" name="name" placeholder="<?php echo $strings['name'];?>" >
                        </div>
                    </div>
                    <!--Campo name-->


                    <div class="col-xs-12  col-md-5 ">
                        <label for="divdatestart"><?= $strings['time_recovery']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input  class="form-control" type="number" min="1" name="time_recovery" placeholder="<?php echo $strings['time_recovery'];?>">
                            <div id="error"></div>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-xs-12  col-md-5 pull-left">
                        <label for="divdatestart"><?= $strings['code']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="id_lesion" placeholder="<?php echo $strings['injury_id'];?>" >
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
                        <i class="fa fa-search"></i>
                        <?php echo $strings['find'] ?></i></button>
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