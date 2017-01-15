<!-- CONTIDO DA PAXINA -->
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

?>


<div class="col-md-12 " style="margin-top: 20px">
    <h1 class="page-header"><?php echo $strings['create_client']; ?></h1>
    <form name="form" id="form" method="POST" 
          action="index.php?controller=client&action=add"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $strings['create_client'] ?>
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
                    <div class="col-xs-12 col col-md-5">

                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder=<?php echo $strings['dni'] ?>
                            required="true" maxlength="9">
                            <div id="error"></div>
                        </div>
                        <!--Campo dni-->
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder=<?php echo $strings['name'] ?>
                            required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->

                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder=<?php echo $strings['surname'] ?>
                            required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo surname-->

                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder= <?php echo $strings['phone']?>
                            required="true" maxlength="9">
                            <div id="error"></div>
                        </div>
                        <!--Campo phone-->
                        <div class="form-group input-group">
                            <span autofocus required class="input-group-addon"><i class="fa fa-cog fa-fw"></i></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder= <?php echo $strings['email'] ?>
                            required="true" maxlength="25">
                            <div id="error"></div>
                        </div>
                        <!--Campo email-->


                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=client&action=show">
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