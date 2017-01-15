<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../model/PAYMENT_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$id_pago = $_REQUEST["id_pago"];
$paymentMapper = new PaymentMapper();
$payment = $paymentMapper->view($id_pago);
?>

<div class="col-md-12">
    <h1 class="page-header"><?php echo $strings['pay'] . ': ' . $payment->getDniAlum() ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=payment&action=pay&id_pago=<?php echo $id_pago; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">

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
                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-usd"></i>
                        <?php echo $strings['pay'] ?></i></button>
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
