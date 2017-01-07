5<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$activity = $view->getVariable("activity");
$event = $view->getVariable("event");
$space = $view->getVariable("space");
$employee = $view->getVariable("employee");


?>


<div class="col-md-6 " style="margin-top: 20px; margin-bottom: 20px">
    <h1 class="page-header"><?php echo $strings['create_session']; ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=session&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_session'] ?>
            </div>
            <div class="panel-body">
                
                
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-xs-12 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                        <!--  <div class="row">
                            <?php echo $strings['max_length'] ?>: 25
                        </div>-->
                         
                    </div>
                    
                </div>
                <label for="asd"><?= $strings['activity']."/".$strings['event'] ?></label>
                <div id="asd" class="well">
                    <div class="row">
                        <div id="selector" class="row">
                            <div class="col-xs-12">
                                 <div class="form-group input-group">
                                <label class="radio-inline"><input checked value="ac" type="radio" name="selector"><?= $strings["ACTIVITY"] ?></label>
                                <label class="radio-inline"><input value="ev" type="radio" name="selector"><?= $strings["EVENT"]?></label>

                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="2"><?= $strings['activity'] ?></label>
                                <div id="2" class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                    <select  class="form-control" id="selactivity" name="selactivity">
                                        
                                        <?php 
                                            foreach ($activity as $ac) {
                                                echo "<option value='".$ac->getCodactivity()."'>".$ac->getActivityname()."</option>";
                                            }

                                         ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label for="2"><?= $strings['event'] ?></label>
                                <div id="2" class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                    <select  class="form-control" id="selevent" name="selevent">
                                            <?php 
                                            foreach ($event as $ev) {
                                                echo "<option value='".$ev->getCodevent()."'>".$ev->getName()."</option>";
                                            }

                                         ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <label for="1"><?= $strings['SCHEDULE'] ?></label>
                <div id="1" class="well">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                        <label for="2"><?= $strings['date'] ?></label>
                        <div id="2" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="date" name="date"
                                   required="true" maxlength="5">
                            
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-md-6">
                    <label for="3"><?= $strings['hourstart'] ?></label>
                        <div id="3" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="text" class="form-control" id="hourstart" name="hourstart"
                                   placeholder= "HH:MM"
                                   required="true" maxlength="5">
                            
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-md-offset-6">
                    <label for="4"><?= $strings['hourend'] ?></label>
                        <div id="4" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input type="text" class="form-control" id="hourend" name="hourend"
                                   placeholder= "HH:MM"
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                    </div>
                    </div>
                </div>

                <label><?= $strings['space'] ?></label>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                        <select  class="form-control" id="selspace" name="selspace">
                                                <?php 
                                                foreach ($space as $sp) {
                                                    echo "<option value='".$sp->getCodspace()."'>".$sp->getSpacename()."</option>";
                                                }

                                             ?>
                                        </select>
                                    </div>
                        </div>
                        
                    </div>

                <label><?= $strings['monitor'] ?></label>
                    <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                    <select  class="form-control" id="selemployee" name="selemployee">
                                            <?php 
                                            foreach ($employee as $em) {
                                                echo "<option value='".$em->getCodemployee()."'>".$em->getEmployeename()."</option>";
                                            }

                                         ?>
                                    </select>
                                </div>
                        </div>
                    </div>



                
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=session&action=show">
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