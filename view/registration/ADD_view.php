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
                        <label for="selectperf"><?php echo $strings['one_reserve'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='reserve' name='reserve' class='form-control icon-menu'>
                                <?php
                                //Engadimos unha opcion por reserva a escoller
                                $rm = new ReserveMapper();
                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $reserves = $rm->show();
                                echo "<option value='NULL'>".$strings['without_reserve'] . "</option>";
                                foreach ($reserves as $r) {
                                    if($r->getSpace()->getCodspace() != NULL){
                                        echo "<option value='" . $r->getCodReserve()."'>".$r->getSpace()->getSpacename()."-".$r->getDate()."-->".$r->getStartTime()."-".$r->getEndTime() . "</option>";
                                    }
                                    elseif ($r->getService()->getId() != NULL){
                                        echo "<option value='" . $r->getCodReserve()."'>".$r->getService()->getDescipcion()."-".$r->getDate()."-->".$r->getStartTime()."-".$r->getEndTime() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!--Campo reserve-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['one_payment'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <select id='payment' name='payment' class='form-control icon-menu'>
                            <?php
                            //Engadimos unha opcion por pago a escoller
                            $pm = new PaymentMapper();
                            //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                            $payments = $pm->show();
                            foreach ($payments as $payment) {
                                echo "<option value='" . $payment->getIdPago()."'>".$payment->getIdPago() . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <!--Campo payment-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['date'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="date" class="form-control" id="date" name="date"
                                   placeholder= <?php echo $strings['date'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo date-->
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