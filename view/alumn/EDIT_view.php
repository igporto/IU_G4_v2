<!-- CONTIDO DA PAXINA -->

<?php
require_once(__DIR__ . "/../../controller/ACTIVITY_controller.php");
require_once(__DIR__ . "/../../model/ALUMN_model.php");

include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php');

$codalumn = $_REQUEST["codalumn"];
$alumnMapper = new AlumnMapper();
$alumn = $alumnMapper->view($codalumn);
?>

<div class="col-md-12">
    <h1 class="page-header"><?php echo $strings['alumn_modify'].': '.$alumn->getAlumnname()?></h1>
    <form method="POST" name="editform" id="editform"
          action="index.php?controller=alumn&action=edit&codalumn=<?php echo $codalumn; ?>"
          enctype="multipart/form-data">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php include('core/language/strings/Strings_' . $_SESSION["idioma"] . '.php'); ?>
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
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['name'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                   value= <?php echo $alumn->getAlumnname() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo name-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['surname'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="surname" name="surname"
                                   value= <?php echo $alumn->getAlumnsurname() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo surname-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['dni'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user-secret fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="dni" name="dni"
                                   value= <?php echo $alumn->getDni() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo dni-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['birthdate'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                            <input autofocus type="date" class="form-control" id="birthdate" name="birthdate">
                            <div id="error"></div>
                        </div>
                        <!--Campo birthdate-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['address'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="address" name="address"
                                   value= <?php echo $alumn->getAddress() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo address-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['email'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
                            <input autofocus type="email" class="form-control" id="email" name="email"
                                   value= <?php echo $alumn->getEmail() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo email-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['job'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="job" name="job"
                                   value= <?php echo $alumn->getJob() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo hour_in-->
                    </div>
                    <div class="col-xs-12 col col-md-5">
                        <label for="selectperf"><?php echo $strings['personal_comment'] ?></label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-text-width fa-fw"></i></span>
                            <input autofocus type="text" class="form-control" id="comment" name="comment"
                                   value= <?php echo $alumn->getComment() ?>>
                            <div id="error"></div>
                        </div>
                        <!--Campo aforo-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                <div class="pull-left">
                    <a class="btn btn-default btn-md" href="index.php?controller=alumn&action=show">
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
<script>
    $( function() {
        $( "#birthdate" ).datepicker();
        $( "#birthdate" ).datepicker( "option", "dateFormat", "yy-mm-d" );
        $( "#birthdate" ).datepicker("setDate","<?php echo $alumn->getBirthdate()?>");
    } );
</script>