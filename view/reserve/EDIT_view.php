<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$reserveMapper = new ReserveMapper();
//Recuperamos o id do evento a editar
$reserve= $_REQUEST["codReserve"];
$currentRes = $reserveMapper->view($reserveMapper->getCodReserve($reserve));


?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['reserve_modify'].": ".$currentRes->getCodReserve() ; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=reserve&action=edit&codReserve=<?php echo $reserve; ?>"
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

                        <label for="divdatestart"><?= $strings['space']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
                            <!-- <input required class="form-control" type="number" name="id_espacio" placeholder="<?php //echo $strings['space_id'];?>">-->
                            <select name="id_espacio">
                                <?php
                                $s = new ReserveMapper();
                                $a = $s->selectSpaceId();
                                foreach ($a as $b){
                                    echo '<option value='.$b.'>'.$s->getNameSpace($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo id evento-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['alumn']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
                            <!-- <input required class="form-control" type="number" name="id_espacio" placeholder="<?php //echo $strings['space_id'];?>">-->
                            <select name="id_alumno">
                                <?php
                                $s = new ReserveMapper();
                                $a = $s->selectAlumnId();
                                foreach ($a as $b){
                                    echo '<option value='.$b.'>'.$s->getAlumnname($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo id alumno-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['date']  ?></label>
                        <div id="divdatestart" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="date" class="form-control" id="date" name="fecha_reserva"
                                   required="true" maxlength="10">
                            <div id="error"></div>
                        </div>
                        <!--Campo fecha -->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['service']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
                            <!-- <input required class="form-control" type="number" name="id_espacio" placeholder="<?php //echo $strings['space_id'];?>">-->
                            <select name="id_servicio">
                                <?php
                                $s = new ReserveMapper();
                                $a = $s->selectServiceId();
                                foreach ($a as $b){
                                    echo '<option value='.$b.'>'.$s->getNameService($b).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo id service-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['startTime']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="time" name="hora_inicio" placeholder="<?php echo $strings['hora_ini'];?>">
                        </div>
                        <!--Campo hora_ini-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['endTime']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="time" name="hora_fin" placeholder="<?php echo $strings['hora_fin'];?>">
                        </div>
                        <!--Campo hora_fin-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['place_price']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="int" name="spaceprice" placeholder="<?php echo $strings['place_price'];?>">
                        </div>
                        <!--Campo hora_ini-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['physio_price']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                            <input required class="form-control" type="int" name="physioprice" placeholder="<?php echo $strings['physio_price'];?>">
                        </div>
                        <!--Campo hora_fin-->
                    </div>
                </div>
            </div>



        </div>


        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=reserve&action=show">
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

