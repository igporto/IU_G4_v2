<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');
?>


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_physio']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=physio&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_physio'] ?>
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
                        <label for="selectperf"><?php echo $strings['one_reserve'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='reserve' name='reserve' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $reserveMapper = new ReserveMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $reserves = $reserveMapper->show();
                                echo "<option value='NULL'>".$strings['no_reserve'] . "</option>";
                                foreach ($reserves as $reserve) {
                                    echo "<option value='" . $reserve->getCodReserve()."'>".$reserve->getCodReserve() . "</option>";
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
                            <input autofocus type="text" class="form-control" id="datestart" name="date"
                                   placeholder= <?php echo $strings['date'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo date-->
                    </div>
                        <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['startTime'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="startTime" name="startTime"
                                   placeholder= "<?php echo $strings['startTime'] ?>">
                            <div id="error"></div>
                        </div>
                        <!--Campo startTime-->
                    </div>
                        <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['endTime'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="time" class="form-control" id="endTime" name="endTime"
                                   placeholder= <?php echo $strings['endTime'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo endTime-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=physio&action=show">
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
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>