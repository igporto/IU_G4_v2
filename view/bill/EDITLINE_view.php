<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../model/PAYMENT_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$id_linea = $_REQUEST["id_linea"];
$billMapper = new BillMapper();
$bill = $billMapper->viewline($id_linea);
?>

<div class="col-md-12">
    <h1 class="page-header"><?php echo $strings['line_modify'] . ': ' . $bill->getConcepto() ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=bill&action=editline&id_linea=<?php echo $bill->getIdLinea(); ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['concept'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="concepto" name="concepto"
                                   value='<?php echo $bill->getConcepto() ?>'
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo concepto-->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['price'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                            <input type="number" min="0.01" step="0.01" max="2500000" autofocus
                                   class="form-control" id="precio" name="precio"
                                   value=<?php echo $bill->getPrecio() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo precio-->
                    </div>

                </div>

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['quantity'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                            <input type="number" min="1" step="1" max="2500000" autofocus
                                   class="form-control" id="cantidad" name="cantidad"
                                   value=<?php echo $bill->getUnidades() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo cantidad-->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf">IVA</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-chevron-right fa-fw"></i></span>
                            <input type="number"
                                   class="form-control" id="iva" name="iva"
                                   value=<?php echo $bill->getIva() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo iva-->
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=bill&action=showlines&id_factura=<?php echo $bill->getIdFactura()?>&nombre_factura=<?php echo $_REQUEST["nombre_factura"]?>">
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
