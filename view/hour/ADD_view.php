<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');


$scheduleName = $_GET['scheduleName'];

$schMapper = new ScheduleMapper();


$schedule = $schMapper->view($schMapper->getIdByName($scheduleName));

$dateStart = 


?>

    

 


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_hour'].$schedule->getSchedulename() ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=schedule&action=addHour&scheduleName=<?= $scheduleName  ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name"><?= $strings['date']." (".$schedule->getDateStart()." - ".$schedule->getDateEnd().")"?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="date" name="date"
                                   min=<?= '"'.$schedule->getDateStart()."'" ?>
                                   max=<?= '"'.$schedule->getDateEnd()."'" ?>
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                    </div>
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart" name="hourstart"
                                   placeholder="YYYY/MM/DD"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                    </div>    
                </div>
                <div class="row">   
                    <div  class="col-md-6 col-md-offset-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend" name="hourend"
                                   placeholder= "YYYY/MM/DD"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
            <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=schedule&action=show">
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
  $( function() {
    $( "#date" ).datepicker();
    $( "#date" ).datepicker( "option", "dateFormat", "yy-mm-d" );
  } );
</script>


<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>