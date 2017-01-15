<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-12 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_discount']; ?></h1>
    <form name="form" id="form" method="POST"
          action="index.php?controller=discount&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_discount'] ?>
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
                        <label><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="type" name="type"
                                   placeholder= <?php echo $strings['discount_type'] ?>
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo category-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['discount'] ?>% (100 - 0)</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input autofocus type="number" class="form-control" id="percent" name="percent"
                                   placeholder= <?php echo $strings['discount'] ?>
                                   required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo category-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label><?php echo $strings['description'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-dashcube fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="description" name="description"
                                   placeholder= <?php echo $strings['description'] ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo category-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=discount&action=show">
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