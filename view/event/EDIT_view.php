<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$evMapper = new EventMapper();
//Recuperamos o id do evento a editar
$event= $_REQUEST["id_evento"];
$currentEv = $evMapper->view($evMapper->getIdByName($event));


?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['event_edit'].": ".$currentEv->getCodEvent() ; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=event&action=edit&id_evento=<?php echo $event; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
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
                    <div class="col-xs-12 col col-md-5">

                        <label for="divdatestart"><?= $strings['EVENTS_NAME']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                            <input required class="form-control" type="text" name="name" placeholder="<?php echo $strings['EVENTS_NAME'];?>">
                        </div>
                        <!--Campo nome-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['aforo']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                            <input required class="form-control" type="number" name="afor" placeholder="<?php echo $strings['aforo'];?>">
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['datestart']  ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="text" class="form-control" id="datestart" name="fecha"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                        <!--Campo fecha -->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['space_id']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
                            <!-- <input required class="form-control" type="number" name="id_espacio" placeholder="<?php //echo $strings['space_id'];?>">-->
                            <select name="id_espacio">
                                <?php
                                $s = new EventMapper();
                                $a = $s->selectSpaceId();
                                foreach ($a as $b){
                                    echo '<option value='.$b.'>'.$s->getNameSpace($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo id evento-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['initial_hour']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="time" name="hora_ini" placeholder="<?php echo $strings['hora_ini'];?>">
                        </div>
                        <!--Campo hora_ini-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['final_hour']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="time" name="hora_fin" placeholder="<?php echo $strings['hora_fin'];?>">
                        </div>
                        <!--Campo hora_fin-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['dni_p']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                            <select name="dni_p">
                                <?php
                                $s = new EventMapper();
                                $a = $s->selectIdP();
                                foreach ($a as $b){
                                    echo '<option value='.$b.'>'.$s->getNameProf($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo dni_prof-->
                    </div>
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

