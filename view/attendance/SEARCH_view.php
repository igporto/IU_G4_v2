<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>



<div class="col-md-6 ">
    <h1 class="page-header"><?php echo $strings['search'].' '.$strings['ATTENDANCE'] ; ?></h1>
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=attendance&action=search"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['management_info'] ?>
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
                    <div class="col-xs-12 col-md-5 ">
                        <label for="selectperf"><?php echo $strings['alumn'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                            <select class="form-control" name="alumn">
                                <?php
                                $am = new AlumnMapper();
                                $alumns=  $am->show();
                                foreach ($alumns as $a){

                                ?>
                                <option value="<?php echo $a->getCodalumn() ?>"><?php echo $a->getAlumnname(). " ". $a->getAlumnsurname()?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=attendance&action=show">
                        <i class="fa fa-arrow-left"></i>
                        <?php echo $strings['back'] ?></i></a>
                </div>

                <div class="pull-right">
                    <button class="btn btn-outline btn-warning btn-md" name="reset" type="reset">
                        <?php echo $strings['clean'] ?></i></button>

                    <button class="btn btn-success btn-md" id="submit" name="submit" type="submit">
                        <i class="fa fa-search"></i>
                        <?php echo $strings['search'] ?></i></button>
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