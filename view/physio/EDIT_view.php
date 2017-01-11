<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/PHYSIO_controller.php");
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$codPhysio = $_REQUEST["codPhysio"];
$physioMapper = new PhysioMapper();
$physio = $physioMapper->view($codPhysio);
?>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['physio_modify'].': '.$physio->getcodPhysio()?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=physio&action=edit&codPhysio=<?php echo $codPhysio; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_reserve'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='reserve' name='reserve' class='form-control icon-menu'>
                            <?php
                            //Engadimos unha opcion por reserve a escoller
                            $reserveMapper = new ReserveMapper();
                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $reserves = $reserveMapper->show();
                            echo "<option value='NULL'>".$strings['no_reserve'] . "</option>";
                            foreach ($reserves as $reserve) {
                                echo "<option value='" . $reserve->getCodReserve()."'";
                                if($physio->getReserve()->getCodReserve() == $reserve->getCodReserve()){
                                    echo " selected = 'selected' ";
                                }
                                echo ">".$reserve->getCodReserve() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['date'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="date" class="form-control" id="date" name="date"
                                   value="<?php echo $physio->getDate() ?>">
                        </div>
                        <!--Campo date-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['startTime'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="startTime" name="startTime"
                                   value="<?php echo $physio->getStartTime() ?>">
                        </div>
                        <!--Campo startTime-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['endTime'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="endTime" name="endTime"
                                   value="<?php echo $physio->getEndTime() ?>">
                        </div>
                        <!--Campo endTime-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=user&action=show">
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