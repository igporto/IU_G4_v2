<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$alumnMapper = new AlumnMapper();
$injuryMapper = new InjuryMapper();
$phi = $alumnMapper->viewInjury($_GET['codinjuryalumn']);

?>

<!-- refresca o perfil do select -->
<script>
    function enviar() {
        var ruta = 'index.php?controller=event&action=add';
    }
</script>

<div class="col-md-12" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['create_injury']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=alumn&action=editinjury&codinjuryalumn=<?php echo $phi->getCod()?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['injury_edit'] ?>
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
                        <label for="divdatestart"><?= $strings['date_injury']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                            <input class="form-control" value="<?php echo $phi->getDateInjury(); ?>" type="date" name="dateI">
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>
                <div class="row" >
                    <div class="col-xs-12 col col-md-5">
                        <label for="divdatestart"><?= $strings['date_recovery']  ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                            <input class="form-control" type="date" name="dateR">
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=alumn&action=showinjury&codalumn<?php echo $phi->getPupil()->getCodalumn()?>">
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





<script>
    //Non deixar que o campo input teña espazos
    $("input").on("keydown", function (e) {
        return e.which !== 32;
    });
</script>
