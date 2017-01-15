<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');


$scheduleName = $_GET['scheduleName'];

$schMapper = new ScheduleMapper();

$schedule = $schMapper->view($schMapper->getIdByName($scheduleName));
$data = $schMapper->getScheduleWorkdays($schMapper->getIdByName($scheduleName));



?>

    

 


<div class="col-md-12 " style="margin-bottom: 20px">
    <h1 class="page-header"><?php echo $strings['create_workday'].$schedule->getSchedulename() ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=schedule&action=manageWorkday&scheduleName=<?= $scheduleName  ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

            <!-- luns -->
            <label for="day0"><?= $strings['day0'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[0]->getHourStart() ?>" 
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[0]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- martes -->
            <label for="day0"><?= $strings['day1'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[1]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[1]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- mercores -->
            <label for="day0"><?= $strings['day2'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[2]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[2]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- xoves -->
            <label for="day0"><?= $strings['day3'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[3]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[3]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- venres -->
            <label for="day0"><?= $strings['day4'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[4]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[4]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- sábado -->
           <label for="day0"><?= $strings['day5'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[5]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[5]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>
                </div>
            </div>

            <!-- domingo -->
            <label for="day0"><?= $strings['day6'] ?></label>
            <div id="day0" class="well">
                <div class="row">
                    <div  class="col-md-6">
                        <label for="hourstart"><?= $strings['hourstart']  ?></label>
                        <div id="hourstart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourstart[]" name="hourstart[]"
                                   value="<?= $data[6]->getHourStart() ?>"
                                   required="true" maxlength="5">
                        </div>
                    </div>      
                    <div  class="col-md-6">
                        <label for="hourend"><?= $strings['hourend']  ?></label>
                        <div id="hourend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="time" class="form-control" id="hourend[]" name="hourend[]"
                                   value="<?= $data[6]->getHourEnd() ?>"
                                   required="true" maxlength="5">
                        </div>
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
                        <i class="fa fa-check"></i>
                        <?php echo $strings['save'] ?></i></button>
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