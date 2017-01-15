<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../controller/REGISTRATION_controller.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$registrationMapper = new RegistrationMapper();
$codRegistration = $_REQUEST["codRegistration"];
$registration = $registrationMapper->view($codRegistration);
?>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['registration_modify'].': '.$_GET['codRegistration']?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=registration&action=edit&codRegistration=<?php echo $codRegistration; ?>"
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['activity'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='reserve' name='activity' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $am = new ActivityMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $activities = $am->show();

                                echo "<option value='NULL'>".$strings['without_activity'] . "</option>";
                                foreach ($activities as $a) {
                                    echo '<option value=' . $a->getCodactivity();

                                    if($a->getCodactivity() == $registration->getActivity()->getCodactivity()){
                                        echo " selected ";
                                    }
                                    echo '>'.$a->getActivityname() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['event'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='event' name='event' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $em = new EventMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $events = $em->show();

                                echo '<option value="NULL">'.$strings['without_space'].'</option>';
                                foreach ($events as $event){
                                    echo '<option value='.$event->getCodevent();
                                    if($event->getCodevent() == $registration->getEvent()->getCodevent()){
                                        echo " selected ";
                                    }
                                    echo '>'. $event->getName() .'</option>';

                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                </div>
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
                                    echo "<option value=" . $a->getCodalumn();
                                    if($a->getCodalumn() == $registration->getAlumn()->getCodalumn()){
                                        echo " selected ";
                                    }
                                   echo ">".$a->getAlumnname()." ". $a->getAlumnsurname() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo payment-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['period'] ?></label>
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