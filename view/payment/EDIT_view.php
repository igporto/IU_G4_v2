<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../model/PAYMENT_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$id_pago = $_REQUEST["id_pago"];
$paymentMapper = new PaymentMapper();
$payment = $paymentMapper->view($id_pago);
?>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['payment_modify'] . ': ' . $payment->getIdPago() ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=payment&action=edit&id_pago=<?php echo $id_pago; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['client_type'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="tipo_cliente" id="tipo_cliente">
                                <option value="student"><?php echo $strings['student'] ?></option>
                                <option value="external"><?php echo $strings['external_client'] ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Campo tipo de cliente-->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['dni'] . " " . $strings["student"] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="dni" id="dni">
                                <?php
                                //Engadimos unha opcion por categoria a escoller
                                $alumnMapper = new AlumnMapper();

                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $alumns = $alumnMapper->show();

                                foreach ($alumns as $alumn) {
                                    echo "<option value='" . $alumn->getDni() . "'>" . $alumn->getDni() . "</option>";
                                }
                                ?>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Campo tipo de cliente-->
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['quantity'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                            <input type="number" min="0.01" step="0.01" max="2500000" autofocus
                                   class="form-control" id="cantidad" name="cantidad"
                                   placeholder= <?php echo $strings['quantity'] ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo cantidad-->
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['pagado'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="pagado" id="pagado">
                                <option value="1"><?php echo $strings['si'] ?></option>
                                <option value="0"><?php echo $strings['no'] ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Pagado-->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['payment_method'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-credit-card fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="metodo_pago" id="metodo_pago">
                                <option value="cash" selected><?php echo $strings['cash'] ?></option>
                                <option value="creditCard"><?php echo $strings['creditCard'] ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Campo metodo de pago-->
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=payment&action=show">
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
