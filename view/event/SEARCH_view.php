<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$eventMapper = new EventMapper();

?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["EVENT"] ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=event&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info pull-right" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>

                    </div>
                    <div class="col-xs-12  col-md-5 pull-left">

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="event_id" placeholder="<?php echo $strings['event_id'];?>" >
                        </div>
                    </div>
                    <!--Campo name-->
                </div>

                <div class="row">

                    <div class="col-xs-12  col-md-5 pull-left">

                        <p><?php echo $strings['initial_hour'];?><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="time" name="ini_hour" placeholder="<?php echo $strings['initial_hour'];?>" >
                        </div></p>

                        <p><?php echo $strings['final_hour'];?><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="time" name="fin_hour" placeholder="<?php echo $strings['final_hour'];?>" >
                        </div></p>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="space_id" placeholder="<?php echo $strings['space_id'];?>" >
                        </div>
                    </div>
                    <!--Campo name-->

                    <div class="col-xs-12  col-md-5 pull-left">

                        <p><?php echo $strings['date'];?><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="date" name="date" placeholder="<?php echo $strings['date'];?>" >
                        </div></p>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="number" name="capacity" placeholder="<?php echo $strings['aforo'];?>" >
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="number" name="dni_prof" placeholder="<?php echo $strings['dni_p'];?>" >
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <input class="form-control" type="text" name="name" placeholder="<?php echo $strings['name'];?>" >
                        </div>
                    </div>
                </div>


                <div class="row">


                </div>




            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=event&action=show">
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
