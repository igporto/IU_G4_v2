<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$registrationMapper = new RegistrationMapper();
?>


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_registration']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=registration&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_registration'] ?>
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['inscription_type'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='tipo'  class='form-control icon-menu' onchange="tipoInscripcion()">
                                <option selected><?php echo $strings["activity"]?></option>
                                <option><?php echo $strings["event"]?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col col-md-5" id="actividad" style="display: block">
                        <label for="selectperf"><?php echo $strings['activity'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='reserve' name='activity' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $am = new ActivityMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $activities = $am->show();

                                echo "<option value='NULL'>" . $strings['without_activity'] . "</option>";
                                foreach ($activities as $a) {
                                    echo "<option value='" . $a->getCodactivity() . "'>" . $a->getActivityname() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                    <div class="col-xs-12 col col-md-5" id="evento" style="display: none">
                        <label for="selectperf"><?php echo $strings['event'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='event' name='event' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $em = new EventMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $events = $em->show();

                                echo "<option value='NULL'>" . $strings['without_event'] . "</option>";
                                foreach ($events as $e) {
                                    echo "<option value='" . $e->getCodevent() . "'>" . $e->getName() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                </div>
                <script>
                    function tipoInscripcion() {
                        var tipo = document.getElementById("tipo").selectedIndex;

                        if (tipo == 0) {
                            document.getElementById("actividad").style = "display: block";
                            document.getElementById("evento").style = "display: none";
                        } else {
                            document.getElementById("actividad").style = "display: none";
                            document.getElementById("evento").style = "display: block";
                        }
                    }
                </script>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['alumn'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <select id='payment' name='alumn' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por pago a escoller
                                $am = new AlumnMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $alumns = $am->show();
                                foreach ($alumns as $a) {
                                    echo "<option value='" . $a->getCodalumn() . "'>" . $a->getAlumnname() . " " . $a->getAlumnsurname() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo payment-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['periodad_de_pago'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input type="number" name="periodicidad" class="form-control" placeholder="<?php echo $strings['period']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=registration&action=show">
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
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>