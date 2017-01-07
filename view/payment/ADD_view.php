<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");

$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-6" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['create_payment']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=payment&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_payment'] ?>
            </div>
            <div class="panel-body">

                <div class="row">

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['client_type'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="tipo_cliente" id="tipo_cliente"
                                    onchange="tipoCliente()">
                                <option value="student"><?php echo $strings['student'] ?></option>
                                <option value="external"><?php echo $strings['external_client'] ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Campo tipo de cliente-->
                    </div>

                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf" id="label1" style="display: block"><?php echo $strings['dni'] . " " . $strings["student"] ?></label>
                        <label for="selectperf" id="label2" style="display: none"><?php echo $strings['dni'] . " " . $strings["external_client"] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="dni" id="dni" style="display: block">
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
                            <input type="text" class=" form-control icon-menu" id="dni_external" name="dni_external" style="display: none">
                            <div id="error"></div>
                        </div>
                        <!--Campo dni de cliente-->
                    </div>

                </div>

                <script>
                    function tipoCliente() {
                        var tipo = document.getElementById("tipo_cliente").selectedIndex;

                        if (tipo == 0) {
                            document.getElementById("dni").style = "display: block";
                            document.getElementById("label1").style = "display: block";
                            document.getElementById("label2").style = "display: none";
                            document.getElementById("dni_external").style = "display: none";
                        } else {
                            document.getElementById("dni").style = "display: none";
                            document.getElementById("label1").style = "display: none";
                            document.getElementById("label2").style = "display: block";
                            document.getElementById("dni_external").style = "display: block";
                        }
                    }
                </script>

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
                            <select class=" form-control icon-menu" name="pagado" id="pagado" onchange="pagar()">
                                <option value="1"><?php echo $strings['si'] ?></option>
                                <option value="0"><?php echo $strings['no'] ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Pagado-->
                    </div>

                    <div class="col-xs-12 col col-md-5" id="div_metodo" style="display: block">
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
                    <script>
                        function pagar() {
                            var pagado = document.getElementById("pagado").selectedIndex;

                            if (pagado == 0) {
                                document.getElementById("div_metodo").style = "display: block";
                            } else {
                                document.getElementById("div_metodo").style = "display: none";
                            }
                        }
                    </script>
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