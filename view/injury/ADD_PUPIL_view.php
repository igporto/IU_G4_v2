<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$injuryMapper = new InjuryMapper();
?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['add_student']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=injury&action=addpupil"
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
                    <div class="col-xs-12  col-md-7 pull-right">

                        <p><?php echo $strings['dni']." ".$strings['student'].":";?><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                            <select name="codpupil">
                                <?php
                                $a = $injuryMapper->selectDniA();
                                foreach ($a as $b){
                                    echo '<option>'.$b.'</option>';
                                }
                                ?>
                            </select>
                        </div></p>
                        <!--Campo dni-->

                        <p><?php echo $strings['injury_name'].":";?><div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                            <select name="id_lesion">
                                <?php
                                $a = $injuryMapper->selectInjuryID();
                                foreach ($a as $b){
                                    echo '<option>'.$b.'</option>';
                                }
                                ?>
                            </select>
                        </div></p>

                        <label for="divdatestart"><?= $strings['date_injury']  ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="datestart" name="date_injury"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>

                        <label for="divdatestart"><?= $strings['date_recovery']  ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="datestart" name="date_recovery"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>

                    </div>
                    <!--Campo name-->
                </div>

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

