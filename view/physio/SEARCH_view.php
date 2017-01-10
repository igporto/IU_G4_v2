<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
$reserveMapper = new ReserveMapper();
?>

<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['find']." ".$strings["PHYSIO"] ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=physio&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-info " style="margin-left: 10px">
                        <div class="row">
                            <?php echo $strings['no_white_spaces'] ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12  col-md-5 pull-left">
                        <label for="selectperf"><?php echo $strings['codPhysio'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus class="form-control" type="number" name="codPhysio" placeholder="<?php echo $strings['codPhysio'];?>" >
                        </div>
                    </div>
                    <!--Campo codigo-->
                <div class="row">
                    <!--Campo codigo-->
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_reserve'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <?php echo $strings['use_q'] ?>
                            </span>
                            <span  class="input-group-addon">
                                    <input id="useres" name="useres" type="checkbox">
                                </span>
                            <select id='reserve' name='reserve' class='form-control icon-menu'>
                            <?php
                            //Engadimos unha opcion por reserves a escoller
                            $reserveMapper = new ReserveMapper();
                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $reserves = $reserveMapper->show();
                            foreach ($reserves as $reserve) {
                                echo "<option value='" . $reserve->getCodReserve()."'>".$reserve->getCodReserve() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
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
                        <i class="fa fa-search"></i>
                        <?php echo $strings['find'] ?></i></button>
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