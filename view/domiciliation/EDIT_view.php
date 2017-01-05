<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../model/DOMICILIATION_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$id_domiciliacion = $_REQUEST["id_domiciliacion"];
$domiciliationMapper = new DomiciliationMapper();
$domiciliation = $domiciliationMapper->view($id_domiciliacion);
?>

<div class="col-md-6">
    <h1 class="page-header"><?php echo $strings['domiciliation_modify'] . ': ' . $domiciliation->getIdDomiciliacion() ?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=domiciliation&action=edit&id_domiciliacion=<?php echo $id_domiciliacion; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
                <?php echo $strings['management_info'] ?>
            </div>
            <div class="panel-body">

                <!-- avisos + nome -->
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['quantity'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                            <input type="number" min="0.01" step="0.01" max="2500000" autofocus
                                   class="form-control" id="total" name="total"
                                   value=<?php echo $domiciliation->getTotal() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo cantidad-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['period'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input type="number" min="1" step="1" max="250" autofocus
                                   class="form-control" id="periodo" name="periodo"
                                   value=<?php echo $domiciliation->getPeriodo() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo periodo-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['dni'] . " " . $strings["student"] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <select class=" form-control icon-menu" name="id_cliente" id="id_cliente">
                                <?php
                                //Engadimos unha opcion por categoria a escoller
                                $alumnMapper = new AlumnMapper();

                                //Recuperamos todos os posibles perfiles que se poden escoller para o usuario
                                $alumns = $alumnMapper->show();

                                foreach ($alumns as $alumn) {
                                    echo "<option value='" . $alumn->getDni() . "'";
                                    if ($domiciliation->getIdCliente() == $alumn->getDni()) {
                                        echo "selected";
                                    }
                                    echo ">" . $alumn->getDni() . "</option>";
                                }
                                ?>
                            </select>
                            <div id="error"></div>
                        </div>
                        <!--Campo dni de cliente-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf">IBAN</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <input type="text"
                                   class="form-control" id="iban" name="iban"
                                   value=<?php echo $domiciliation->getIban() ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo cantidad-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=domiciliation&action=show">
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
