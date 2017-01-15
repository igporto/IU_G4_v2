<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTION_controller.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$view = ViewManager::getInstance();

$activity = $view->getVariable("activity");
$employee = $view->getVariable("employee");
$schedules = $view->getVariable("schedules");

$actionname = $_REQUEST["actionName"];
$sm = new SessionMapper();
$sesion = $sm->view($actionname);
?>
<script>
    function enviar() {
        var ruta = 'index.php?controller=session&action=edit&actionName=';
        var nome = <?php echo '"' . $actionname . '"';?>;
        var query = '&perf_id=';
        var perfil = document.getElementById("perf_id").value;

        var parte1 = ruta.concat(nome);
        var parte2 = query.concat(perfil);
        window.location.href = parte1.concat(parte2);
    }
</script>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['action_modify'] . ': ' . $_GET['actionName'] ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=action&action=edit&actionName=<?php echo $actionname; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">


                <div class="row" style="margin-bottom: 10px">
                    <div class="col-xs-12 text-info float-left" style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>


                    </div>

                </div>
                <label for="asd"><?= $strings['activity'] ?></label>
                <div id="asd" class="row">

                    <div class="col-xs-12">
                        <div id="2" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <select class="form-control" id="selactivity" name="selactivity">

                                <?php
                                foreach ($activity as $ac) {
                                    echo "<option value='" . $ac->getCodactivity()."''";
                                    if ($sesion->getActivity()->getCodactivity() == $ac->getCodactivity()) {
                                        echo " selected";
                                    }
                                    echo ">" . $ac->getActivityname() . "</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>


                <label for="1"><?= $strings['SCHEDULE'] ?></label>
                <div id="1" class="well">

                    <div class="row">
                        <label for="dia"><?= $strings["schedule"] ?>:</label>
                        <div id="2" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <select class="form-control" name="schedule" id="asd">
                                <?php foreach ($schedules as $schedule): ?>
                                    <option value="<?= $schedule->getIdSchedule() ?>"><?= $schedule->getSchedulename() ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <label for="dia"><?= $strings["days"] ?>:</label>
                        <div id="2" class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
                            <select class="form-control" name="dayoweek" id="asd">
                                <option value="0"><?= $strings["day0"] ?></option>
                                <option value="1"><?= $strings["day1"] ?></option>
                                <option value="2"><?= $strings["day2"] ?></option>
                                <option value="3"><?= $strings["day3"] ?></option>
                                <option value="4"><?= $strings["day4"] ?></option>
                                <option value="5"><?= $strings["day5"] ?></option>
                                <option value="6"><?= $strings["day6"] ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="row">


                        <div class="col-xs-12">

                            <label for="4"><?= $strings['hourstart'] ?></label>
                            <div id="4" class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                                <input type="time" class="form-control" id="hourstart" name="hourstart"
                                       value="<?php echo $sesion->getHourstart()?>"
                                       required="true" maxlength="5">
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-xs-12">

                            <label for="4"><?= $strings['hourend'] ?></label>
                            <div id="4" class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                                <input type="time" class="form-control" id="hourend" name="hourend"
                                       value="<?php echo $sesion->getHourend()?>"
                                       required="true" maxlength="5">
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <label><?= $strings['monitor'] ?></label>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <select class="form-control" id="selemployee" name="selemployee">
                                <?php
                                foreach ($employee as $em) {
                                    echo "<option value='" . $em->getCodemployee() . "'>" . $em->getEmployeename() . "</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $am = new ActionMapper();
            //Recuperamos o id do usuario a editar
            $id_action = $am->getIdByName($_REQUEST["actionName"]);

            $action = $_REQUEST["actionName"];

            ?>

        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=action&action=show">
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
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>
