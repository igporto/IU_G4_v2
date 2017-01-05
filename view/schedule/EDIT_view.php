<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTION_controller.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$schedulename = $_REQUEST["scheduleName"];

$scheduleMapper = new scheduleMapper();
$schedule = $scheduleMapper->view($scheduleMapper->getIdByName($schedulename));


?>


<div class="col-md-6">
<h1 class="page-header"><?php echo $strings['schedule_modify'].': '.$_GET['scheduleName']?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=schedule&action=edit&scheduleName=<?php echo $schedulename; ?>"
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
                    <div class="col-xs-12 col col-md-5">
                        <label for="name"><?= $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                   value=<?= $schedulename ?>
                                    maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                    </div>
                </div>
                <div class="row">

                    <div  class="col-md-6">
                        <label for="divdatestart"><?= $strings['datestart']  ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="datestart" name="datestart"
                                    value=<?= $schedule->getDateStart() ?> 
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                    </div>    
                    
                    <div  class="col-md-6">
                        <label for="divdateend"><?= $strings['dateend']  ?></label>
                        <div id="divdateend" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="dateend" name="dateend"
                                    value=<?= $schedule->getDateEnd() ?> 
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
  $( function() {
    $( "#datestart" ).datepicker();
    $( "#datestart" ).datepicker( "option", "dateFormat", "yy-mm-d" );
  } );
  </script>

  <script>
  $( function() {
    $( "#dateend" ).datepicker();
    $( "#dateend" ).datepicker( "option", "dateFormat", "yy-mm-d" );
  } );
  </script>
<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>
