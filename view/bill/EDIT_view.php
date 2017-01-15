<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../model/PAYMENT_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$id_factura = $_REQUEST["id_factura"];
$billMapper = new BillMapper();
$bill = $billMapper->view($id_factura);
?>

<div class="col-md-12">
    <h1 class="page-header"><?php echo $strings['bill_modify'] . ': ' . $bill->getIdFactura() ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=bill&action=edit&id_factura=<?php echo $id_factura; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                   value=<?php echo "'" . $bill->getNombre() . "'" ?>
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo nombre-->
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['bill_number'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                            <input type="number"
                                   class="form-control" id="number" name="number"
                                   value=<?php echo $bill->getNumero() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo numero-->
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=bill&action=show">
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
