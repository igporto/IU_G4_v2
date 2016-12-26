<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-6 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_action']; ?></h1>
    <form name="form" id="form" method="POST" onsubmit="return hasWhiteSpace()"
          action="index.php?controller=action&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_action'] ?>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="actionname" name="actionname"
                                   placeholder= <?php echo $strings['name'] ?>
                                   required="true">
                            <div id="error"></div>
                        </div>
                        <!--Campo action-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=action&action=show">
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