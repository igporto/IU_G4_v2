<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>
<div class="col-md-12" style="margin-bottom: 30px">
    <h1 class="page-header"><?php echo $strings['search_domiciliation']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=domiciliation&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['search_domiciliation'] ?>
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
                                   placeholder= <?php echo $strings['total_quantity'] ?>>
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
                                   placeholder= <?php echo $strings['period'] ?>>
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
                                <option value=""><?php echo $strings["anyone"]?></option>
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
                        <!--Campo dni de cliente-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf">IBAN</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
                            <input type="text"
                                   class="form-control" id="iban" name="iban"
                                   placeholder="IBAN">
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
                        <i class="fa fa-search"></i>
                        <?php echo $strings['find'] ?></i></button>
                </div>
            </div>

        </div>
    </form>
    <!--fin formulario-->
</div>